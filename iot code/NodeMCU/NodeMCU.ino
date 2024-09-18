#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
WiFiClient client;
#include <SPI.h>
#include <MFRC522.h>
#define SS_PIN D2
#define RST_PIN D1
MFRC522 rfid(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;
String request_string;
const char* host = "192.168.43.135";
HTTPClient http;
String val;

int led = 3;
int buzzer = 15;
unsigned long interval=500; // the time we need to wait
unsigned long previousMillis=0; // millis() returns an unsigned long.
  
void setup() {
WiFi.disconnect();
WiFi.begin("Rey","12345678900");
while ((!(WiFi.status() == WL_CONNECTED))){
delay(300);
}
Serial.begin(115200);
SPI.begin();
rfid.PCD_Init();
pinMode(led, OUTPUT);
pinMode(buzzer, OUTPUT);
pinMode(BUILTIN_LED, OUTPUT);
}


void loop() {
 getdata();
}
