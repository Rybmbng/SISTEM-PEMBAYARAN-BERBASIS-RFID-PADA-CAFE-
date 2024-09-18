void waktu(){  
 jam = millis() / 3600000;  // Satu jam = 3600000 ms
  menit = (millis() / 60000) % 60;  // Satu menit = 60000 ms
  detik = (millis() / 1000) % 60;  // Satu detik = 1000 ms
 lcd.setCursor(4, 0);
  if (jam < 10) {
    lcd.print("0");
  }
  lcd.print(jam);
  lcd.print(":");
  if (menit < 10) {
    lcd.print("0");
  }
  lcd.print(menit);
  lcd.print(":");
  if (detik < 10) {
    lcd.print("0");
  }
  lcd.print(detik);

 }
