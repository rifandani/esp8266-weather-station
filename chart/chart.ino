#ifdef ESP32
#include <WiFi.h>
#include <HTTPClient.h>
#else
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#endif

//#include "DHT.h"
#include <DHT.h>
#include <DHT_U.h>
#include <BH1750.h>
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BMP280.h>

#define SEALEVELPRESSURE_HPA (1013.25)
#define DHTPIN 2
#define DHTTYPE DHT11

const char *ssid = "MAX 7C9F";
const char *password = "12345678";

const char *serverName = "http://rifandani2505.000webhostapp.com/post-data.php";

String apiKeyValue = "tPmAT5Ab3j7F9";

Adafruit_BMP280 bmp;

DHT dht(DHTPIN, DHTTYPE);

BH1750 ukurLuxCahaya(0x5C); //connect ADDR ke 3.3V, defaultnya 0x23

const int flame = D5; //set konstan variabel flame di pin D5

void setup()
{
  pinMode(flame, INPUT); //set sensor api sebagai INPUT
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Terhubung ke jaringan WiFi dengan IP Address: ");
  Serial.println(WiFi.localIP());

  Wire.begin();
  ukurLuxCahaya.begin(); //mulai sensor BH

  bool status = bmp.begin(0x76);
  if (!status)
  {
    Serial.println("Tidak dapat menemukan sensor BMP280 yang valid, cek ulang rangkaian atau ganti I2C address!");
    while (1);
  }

  bmp.setSampling(Adafruit_BMP280::MODE_NORMAL,
                  Adafruit_BMP280::SAMPLING_X2,
                  Adafruit_BMP280::SAMPLING_X16,
                  Adafruit_BMP280::FILTER_X16,
                  Adafruit_BMP280::STANDBY_MS_500);

  dht.begin(); //mulai sensor DHT
}

void loop()
{
  if (WiFi.status() == WL_CONNECTED)
  {
    HTTPClient http;
    http.begin(serverName);

    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    float h = dht.readHumidity();
    float t = dht.readTemperature();
    // bisa tambah dew point => float DewPoint = (t - (100 - h) / 5);
    
    String httpRequestData = "api_key=" + apiKeyValue 
                                        + " & value1=" + String(bmp.readTemperature()) 
                                        + " & value2=" + String(bmp.readAltitude(1013)) 
                                        + " & value3=" + String(bmp.readPressure() / 100.0F) 
                                        + " & value4=" + String(dht.computeHeatIndex(t, h, false)) 
                                        + " & value5=" + String(h)
                                        + " & value6=" + String(t)
                                        + " & value7=" + String(ukurLuxCahaya.readLightLevel()) 
                                        + " & value8=" + String(digitalRead(flame)) + "";
    
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);

    int httpResponseCode = http.POST(httpRequestData); // mengirimkan HTTP POST request

    // bisa di comment httpRequestData variabel diatas lalu gunakan variabel dibawah ini untuk mengetes
    //String httpRequestData = "api_key=tPmAT5Ab3j7F9&value1=24.75&value2=49.54&value3=1005.14";

    // kalau membutuhkan HTTP request dengan tipe content: text/plain
    //http.addHeader("Content-Type", "text/plain");
    //int httpResponseCode = http.POST("Hello, World!");

    // kalau membutuhkan HTTP request dengan tipe content: application/json, gunakan:
    //http.addHeader("Content-Type", "application/json");
    //int httpResponseCode = http.POST("{\"value1\":\"19\",\"value2\":\"67\",\"value3\":\"78\"}");

    if (httpResponseCode > 0)
    {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else
    {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }

    http.end(); // Free resources
  }
  else
  {
    Serial.println("WiFi Disconnected");
  }

  delay(10000); //Mengirim HTTP POST request setiap 10 detik
}
