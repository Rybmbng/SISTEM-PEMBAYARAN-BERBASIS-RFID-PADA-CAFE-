void getdata(){
  WiFiClient client;
  HTTPClient http;
  String url = "http://192.168.43.135/controller/getdata.php";
  http.begin(client, url);
  int httpResponseCode = http.GET();
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println(response);
    if (response.toInt() == 1) {
      delay(500);
     Serial.println("LED MENYALA");
     digitalWrite(led, HIGH);
     digitalWrite(buzzer, HIGH);
     delay(100);
     digitalWrite(led, LOW);
     digitalWrite(buzzer, LOW);
     delay(100);
     digitalWrite(led, HIGH);
     digitalWrite(buzzer, HIGH);
     delay(100);
     digitalWrite(led, LOW);
     digitalWrite(buzzer, LOW);
     delay(100);
     digitalWrite(led, HIGH);
     digitalWrite(buzzer, HIGH);
     delay(100);
     digitalWrite(led, LOW);
     digitalWrite(buzzer, LOW);
     delay(100);
     delay(1000);
     client.print(String("GET ") + "/controller/postdata.php" + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
    }else{
      Serial.println("LED OFF");
    }
  } else {
    
    Serial.print("Error on HTTP request: ");
    Serial.println(httpResponseCode);
  }

kirim_rfid(); 
http.end();
}
