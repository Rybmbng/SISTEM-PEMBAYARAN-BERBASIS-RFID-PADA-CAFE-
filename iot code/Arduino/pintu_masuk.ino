void pintu(){
  int ir1 = digitalRead(6); //(DALAM)
  int ir2 = digitalRead(7); //(LUAR)
  
  if(ir2 == LOW  && Status == "" ){
  statusUS = "baca";
  digitalWrite(4,HIGH);
  delay(300);
  digitalWrite(4,LOW);
  lcd.clear();
  lcd.setCursor(1,0);
  lcd.print("SELAMAT DATANG");
  digitalWrite(MotorA1, HIGH);
  digitalWrite(MotorA2, LOW);
  analogWrite(APWM, PWMSET); 
  delay(2300);  
  analogWrite(APWM, 0);
  delay(1000);
  Serial.println("TERBUKA");
  Status = "terbuka";
  lcd.clear();
  }else
  if(ir2 == LOW  && Status == "terbuka" ){
  analogWrite(APWM, 0);
  delay(1000);
  Serial.println("MASIH TERBUKA");
  }else 
  if(ir2 == HIGH && Status == "terbuka"){
  delay(1000);
  digitalWrite(MotorA1, LOW);
  digitalWrite(MotorA2, HIGH);
  analogWrite(APWM, PWMSET); 
  delay(2500);  
  analogWrite(APWM, 0);
  delay(1000);
  digitalWrite(4,HIGH);
  delay(300);
  digitalWrite(4,LOW);
  Status = "";
  Serial.println("TERTUTUP");
  }else    if(ir1 == LOW && Status == "" ){
  digitalWrite(4,HIGH);
  delay(300);
  digitalWrite(4,LOW);
  lcd.clear();
  lcd.setCursor(2,0);
  lcd.print("SELAMAT JALAN");
  digitalWrite(MotorA1, HIGH);
  digitalWrite(MotorA2, LOW);
  analogWrite(APWM, PWMSET); 
  delay(2300);  
  analogWrite(APWM, 0);
  delay(1000);
  Serial.println("TERBUKA");
  Status = "terbuka";
  lcd.clear();
  }else
  if( ir1 == LOW && Status == "terbuka" ){
  analogWrite(APWM, 0);
  delay(1000);
  Serial.println("MASIH TERBUKA");
  }else 
  if(ir1 == HIGH && Status == "terbuka" ){
  delay(1000);
  digitalWrite(MotorA1, LOW);
  digitalWrite(MotorA2, HIGH);
  analogWrite(APWM, PWMSET); 
  delay(2500);  
  analogWrite(APWM, 0);
  delay(1000);
  digitalWrite(4,HIGH);
  delay(300);
  digitalWrite(4,LOW);
  Status = "";
  Serial.println("TERTUTUP");
  }
  if(Status == "terbuka" && ir1 == LOW || ir2 == LOW){
      analogWrite(APWM, 0);
  }
}
