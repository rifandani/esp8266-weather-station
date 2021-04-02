# ESP8266 Weather Station

_Tri Rizeki Rifandani_
_Pendidikan Teknik Mekatronika_
_Universitas Negeri Yogyakarta_

> Project ini adalah projek akhir Skripsi berbasis Internet Of Things. Hasil output data dari sensor dikirimkan ke database MySQL yang berfungsi sebagai warehouse. Data sensor tersebut kemudian digunakan sebagai input untuk penelitian skripsi saya tentang Machine Learning for Internet of Things.

## Input

NodeMCU v3 / bisa juga Wemos D1 Mini dengan sensor BMP280, BH1750, DHT11 and Infrared untuk mendeteksi api

## Output

Hasil pembacaan sensor akan dikirimkan ke website dengan script PHP + AJAX

## Display

Chart, menggunakan library dari [Highcharts.js](https://highcharts.com/)
Table, menggunakan library dari [DataTables](https://datatables.com/)

## Fitur

- Dilengkapi timestamp setiap pembacaan sensor
- Data update dengan interval 10 detik
- Weather Forecast dari [DarkSky](https://darksky.net/) sebagai rujukan akurasi sensor
- Terdapat fitur Search di Table untuk mencari data nilai tertentu dalam database
- Terdapat fitur Sort untuk setiap Column di Table untuk menyortir data Ascending/Descending
- Terdapat fitur Export ke CSV, Excel, PDF di Table
- Terdapat fitur Copy di Table untuk menyalin semua data yang ada di Table

## Links

Hosting Website: [000webhostapp](https://rifandani2505.000webhostapp.com/)

---

Coming Soon: Screenshot project, RapidMiner Studio saved file
Thanks for coming

---
