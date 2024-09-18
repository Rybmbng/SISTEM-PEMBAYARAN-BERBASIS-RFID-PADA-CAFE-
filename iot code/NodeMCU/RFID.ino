void kirim_rfid(){
   if (!rfid.PICC_IsNewCardPresent()) {
    return;
  }
  if (!rfid.PICC_ReadCardSerial()) {
    return;
  }

  // Mendapatkan ID kartu RFID
  String strID = "";
  for (byte i = 0; i < rfid.uid.size; i++) {
    strID += String(rfid.uid.uidByte[i], DEC);
  }
 
strID.toUpperCase();
Serial.print("Tap card key: ");
Serial.println(strID);

if (!client.connect(host,80)) {
Serial.println("Not Connected");
return;
}
request_string = "/controller/card.php?data=";
request_string += strID;
Serial.print("requesting URL: ");
Serial.println(request_string);
client.print(String("GET ") + request_string + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
unsigned long timeout = millis();
while (client.available() == 0) {
if (millis() - timeout > 5000) {
Serial.println(">>> Client Timeout !");
client.stop();
return;
}
}
delay(1000);
}
