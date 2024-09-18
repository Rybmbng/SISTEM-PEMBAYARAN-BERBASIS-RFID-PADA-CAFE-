void ultrasonic(){
int button_led = digitalRead(button);
digitalWrite(trigPin, HIGH);// aktifkan sensor ultrasonic
delayMicroseconds(10); // selama 10 microseconds
digitalWrite(trigPin, LOW); // matikan sensor ultrasonic
duration = pulseIn(echoPin, HIGH); // baca rentan waktu dari trigPin High sampai echoPin high
distance= duration*0.034/2; //konversi selang waktu ke CM
if(distance <= 15){
  count +=1;
}
if (count >= 1 && statusUS == "baca"){
  analogWrite(lampu, 255);
  digitalWrite(MotorB1, HIGH);
  digitalWrite(MotorB2, LOW);
  analogWrite(BPWM, 80);
}else{
  analogWrite(lampu, 0);
  digitalWrite(MotorB1, HIGH);
  digitalWrite(MotorB2, LOW);
  analogWrite(BPWM, 0);
}

if(button_led == LOW){
  count = 0;
  statusUS = "";

}
  Serial.println((String)"ULTRASONIC : "+distance);

}
