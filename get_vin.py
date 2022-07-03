#!/usr/bin/env python3
import requests
import re
car_number = "NA25"
req = requests.get("https://uzzinivin.lv/?rn=" + car_number)
p = re.compile("window.location.href=\"https://uzzinivin.lv/v/(.*)\";")
m = p.search(req.text)

print(m.group())
code= m.group(1)
req2 = requests.get("https://uzzinivin.lv/v/" + code)
p = re.compile("https://www.autodna.lv/vin/(.*)\"")
m = p.search(req2.text)
print(f"VIN Number for the plate {car_number} is " + m.group(1).split('"')[0])