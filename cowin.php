<?php

require_once './vendor/autoload.php';
$config = json_decode(file_get_contents('./config.json'));
use Twilio\Rest\Client as TwilioClient;

$options = getopt("", ['pc:', 'phone:', 'district::', 'age::', 'vax::', 'dose::', 'test::', 'name::']);
$pincode = $options['pc'] ?? '';
$alertPhn = $options['phone'] ?? '';
$minAge = intval($options['age'] ?? '18');
$vaxName = $options['vax'] ?? '';
$doseNo = intval($options['dose'] ?? '1');
$testIntegration = $options['test'] ?? 'false';
$runningFor = $options['name'] ?? '';
$districtId = $options['district'] ?? '';

if (!$pincode || !$alertPhn) {
	die("please run the script: php cowin.php --pc {pincode} --phone {alertPhn}\n");
}
if ($vaxName && !in_array($vaxName, ['COVAXIN', 'COVISHIELD'])) {
	die('Invalid vax name supplied!');
}

function triggerCallAlert($message, $alertPhn, $config) {
	$sid = $config->twilio->sid;
	$token = $config->twilio->token;
	$client = new TwilioClient($sid, $token);

	echo "calling phone : $alertPhn\n";
	echo "message: $message\n";
	$message = urlencode($message);
	$url = "https://handler.twilio.com/twiml/EHc053310a3b5f94231d932f570870d3c2?message=${message}";

	$call = $client->calls->create(
		$alertPhn,
		$config->twilio->phone, // From a valid Twilio number
		[ 'url' => $url ]
	);

	echo $call->sid;
}

$client = new \GuzzleHttp\Client(['timeout' => 5]);
$ua1 = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36';
$ua2 = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chromium/90.0.4430.212 Safari/537.36";
$ua3 = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.3 Safari/605.1.15';
$ua4 = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36';
$ua5 = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36';
$failures = 0;
while (true) {
	$date = date('d-m-Y');
	try {
		if ($districtId) {
			$uri = "https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByDistrict?district_id={$districtId}&date={$date}";
		} else {
			$uri = "https://cdn-api.co-vin.in/api/v2/appointment/sessions/calendarByPin?pincode={$pincode}&date={$date}";
		}
		$resp = $client->request('GET', $uri, [
			'curl' => [
			        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
			    ],
			'headers' => [
				'User-Agent' => array_rand([$ua1, $ua2, $ua3, $ua4, $ua5], 1),
			]
		]);
		$json = json_decode((string) $resp->getBody());
		foreach ($json->centers as $center) {
			foreach ($center->sessions as $sess) {
				$doseCapacity = ($doseNo == 2 ? $sess->available_capacity_dose2 : $sess->available_capacity_dose1);
				$conditions = $sess->available_capacity > 0 && ($doseCapacity > 0) && $minAge == $sess->min_age_limit && ($vaxName ? $sess->vaccine == $vaxName : true);
				if ($conditions || $testIntegration == 'true') {
					$msg = sprintf('Vax dose %s available for %d in center: %s', $sess->vaccine, $doseCapacity, $center->name);
					$cmd = sprintf("/usr/bin/osascript -e 'display notification \"%s\" with title \"%s %s\"'", $msg, $runningFor, $center->name);
					exec($cmd);
					triggerCallAlert($msg, $alertPhn, $config);
					die();	// exit the script
				}
			}
		}
		echo sprintf('[%s]: No slots found for %s+ checking for: %s', date('Y-m-d H:i:s'), $minAge, $runningFor) . "\n";
		$failures = 0;
	} catch (\Exception $e) {
		echo sprintf("[%s] %s", date('Y-m-d H:i:s'), $e->getMessage());
		$failures++;
		var_dump("sleeping for {$failures} s");
		sleep($failures);
	}
	sleep(10);
}