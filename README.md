# readme

## deps
```bash
composer require guzzlehttp/guzzle
composer require twilio/sdk
cp sample.config.json config.json
```

## examples

```bash
php cowin.php --pc='121004' --phone='+91999xxxxxxx' --name='your name'
php cowin.php --pc='700014' --district='725' --phone='+91999xxxxxxx' --name='your name' --age='45'
php cowin.php --pc='{pincode}' --phone='+91999xxxxxxx' --dose='2'
```

```bash
curl 'https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode=700014&date=21-05-2021' \
  -H 'authority: cdn-api.co-vin.in' \
  -H 'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="90", "Google Chrome";v="90"' \
  -H 'accept: application/json, text/plain, */*' \
  -H 'dnt: 1' \
  -H 'sec-ch-ua-mobile: ?0' \
  -H 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36' \
  -H 'origin: https://www.cowin.gov.in' \
  -H 'sec-fetch-site: cross-site' \
  -H 'sec-fetch-mode: cors' \
  -H 'sec-fetch-dest: empty' \
  -H 'referer: https://www.cowin.gov.in/' \
  -H 'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,es-ES;q=0.6,es;q=0.5,de-DE;q=0.4,de;q=0.3' \
  -H 'if-none-match: W/"2420-v9pYgc/mDpoIfpirnnJTlGJ18fs"' \
  --compressed
```

### sample response

```json
{
  "centers": [
    {
      "center_id": 10907,
      "name": "Civil Hospital 18 Plus",
      "address": "Civil Hospital Subash Road Rohtak",
      "state_name": "Haryana",
      "district_name": "Rohtak",
      "block_name": "Rohtak",
      "pincode": 124001,
      "lat": 28,
      "long": 76,
      "from": "09:00:00",
      "to": "15:30:00",
      "fee_type": "Free",
      "sessions": [
        {
          "session_id": "447ba5d5-ee6c-4179-b8a2-2ce1823362d7",
          "date": "21-05-2021",
          "available_capacity": 0,
          "min_age_limit": 18,
          "vaccine": "COVISHIELD",
          "slots": [
            "09:00AM-10:00AM",
            "10:00AM-11:00AM",
            "11:00AM-12:00PM",
            "12:00PM-03:30PM"
          ],
          "available_capacity_dose1": 0,
          "available_capacity_dose2": 0
        }
      ]
    },
    {
      "center_id": 564532,
      "name": "PGIMS-Site-1-Plus18",
      "address": "PGIMS AUDITORIUM",
      "state_name": "Haryana",
      "district_name": "Rohtak",
      "block_name": "Rohtak",
      "pincode": 124001,
      "lat": 28,
      "long": 76,
      "from": "09:00:00",
      "to": "14:00:00",
      "fee_type": "Free",
      "sessions": [
        {
          "session_id": "4a2f15ef-8e64-4b73-8dfd-4ceeeea12ddb",
          "date": "21-05-2021",
          "available_capacity": 0,
          "min_age_limit": 18,
          "vaccine": "COVAXIN",
          "slots": [
            "09:00AM-10:00AM",
            "10:00AM-11:00AM",
            "11:00AM-12:00PM",
            "12:00PM-02:00PM"
          ],
          "available_capacity_dose1": 0,
          "available_capacity_dose2": 0
        }
      ]
    },
    {
      "center_id": 566224,
      "name": "Polyclinic Sector 3",
      "address": "Polyclinic Sector 3 Rohtak",
      "state_name": "Haryana",
      "district_name": "Rohtak",
      "block_name": "Rohtak",
      "pincode": 124001,
      "lat": 28,
      "long": 76,
      "from": "09:00:00",
      "to": "14:30:00",
      "fee_type": "Free",
      "sessions": [
        {
          "session_id": "4b96a515-0f25-493b-938b-5af1c19c41fa",
          "date": "21-05-2021",
          "available_capacity": 0,
          "min_age_limit": 45,
          "vaccine": "COVAXIN",
          "slots": [
            "09:00AM-10:00AM",
            "10:00AM-11:00AM",
            "11:00AM-12:00PM",
            "12:00PM-02:30PM"
          ],
          "available_capacity_dose1": 0,
          "available_capacity_dose2": 0
        }
      ]
    },
    {
      "center_id": 564695,
      "name": "Gaukaran UPHC",
      "address": "Behaind Gaur College Gaukaran Rohtak",
      "state_name": "Haryana",
      "district_name": "Rohtak",
      "block_name": "Rohtak",
      "pincode": 124001,
      "lat": 28,
      "long": 76,
      "from": "10:00:00",
      "to": "14:00:00",
      "fee_type": "Free",
      "sessions": [
        {
          "session_id": "4d0a8423-9da1-404c-b267-e44614f0f327",
          "date": "21-05-2021",
          "available_capacity": 0,
          "min_age_limit": 18,
          "vaccine": "COVISHIELD",
          "slots": [
            "10:00AM-11:00AM",
            "11:00AM-12:00PM",
            "12:00PM-01:00PM",
            "01:00PM-02:00PM"
          ],
          "available_capacity_dose1": 0,
          "available_capacity_dose2": 0
        }
      ]
    },
    {
      "center_id": 563924,
      "name": "Civil Hospital 45 Plus",
      "address": "Civil Hospital Subash Road Rohtak",
      "state_name": "Haryana",
      "district_name": "Rohtak",
      "block_name": "Rohtak",
      "pincode": 124001,
      "lat": 28,
      "long": 76,
      "from": "09:00:00",
      "to": "15:30:00",
      "fee_type": "Free",
      "sessions": [
        {
          "session_id": "258aadbc-c346-437b-9e8e-8b910ef4f595",
          "date": "21-05-2021",
          "available_capacity": 31,
          "min_age_limit": 45,
          "vaccine": "COVISHIELD",
          "slots": [
            "09:00AM-10:00AM",
            "10:00AM-11:00AM",
            "11:00AM-12:00PM",
            "12:00PM-03:30PM"
          ],
          "available_capacity_dose1": 31,
          "available_capacity_dose2": 0
        }
      ]
    }
  ]
}
```