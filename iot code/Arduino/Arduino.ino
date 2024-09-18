#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd (0x3f,16,2);


unsigned long interval=1000; // the time we need to wait
unsigned long previousMillis=0; // millis() returns an unsigned long.
  
// Variabel waktu
int jam = 0;
int menit = 0;
int detik = 0;

int APWM =  11; 
int MotorA1 = 13;     
int MotorA2 =  8;   
int Buzzer = 4;     // PIN Buzzer
int PWMSET = 255;   // SET Speed Motor  Test 50% = 128 and Test 100% = 255
String Status = "";

int BPWM =  10; 
int MotorB1 = 12;     
int MotorB2 =  3;   
int count = 0;

int button = 9;
int lampu = A0;
String statusUS = "";
#define trigPin 2 
#define echoPin 5 

long duration;
int distance = 0;

void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
lcd.init();
lcd.backlight();
pinMode(trigPin, OUTPUT);
pinMode(echoPin, INPUT); 
pinMode(6, INPUT);
pinMode(7, INPUT);
pinMode(12, OUTPUT);  
pinMode(3, OUTPUT);    
pinMode(10, OUTPUT);   
pinMode(4, OUTPUT);   
pinMode(lampu, OUTPUT);
pinMode(button, INPUT_PULLUP);
}

void loop() {
  int btn_lampu = digitalRead(button);
  unsigned long currentMillis = millis(); // grab current time
  int ir1 = digitalRead(6); //(DALAM)
  int ir2 = digitalRead(7); //(LUAR)
  Serial.println(String("IR1 : ")+ir1);
  Serial.println(String("IR2 : ")+ir2);
  delay(50);
  pintu();
  ultrasonic();
  if ((unsigned long)(currentMillis - previousMillis) >= interval) {
  lcd.setCursor(0,0);
  lcd.print(" REYVANS PAHLEVI");
  lcd.setCursor(2,1);
  lcd.print("RUMAH SINGGAH");
  previousMillis = millis();
  }
}
