#include "max6675.h"  // LIBRER+89IA DEL CONVERTIDOR A-D
#include <Ethernet.h> // LIBERIA SHIELD ETHERNET
#include <SPI.h>      // LIBRERIA COMUNICACION SERIAL
#include <SD.h>       // LIBRERIA SD PARA DATALOGGER
#include <String.h>   // LIBRERIAS VAR TIPO STRING
//#include <stdlib.h>
//#include <stdio.h>
#include <TimeLib.h>
#include <Wire.h>
#include <DS1307RTC.h> 
#include <Sleep_n0m1.h>


//DEFINICION DE VARIABLES

String temp; 
#define thermoDO 3
#define thermoCS 5  
#define thermoCLK 6
#define vccPin 3
#define gndPin 2
#define ChipSelect 4

MAX6675 thermocouple(thermoCLK, thermoCS, thermoDO);
int valor;

//direccion mac del dispositivo
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

//IPAddress server(31,220,16,122);  // IP del servidor
char server[] = "tesis-prueba.hol.es";    // Nombre del servidor

// IP de ARDUINO
//IPAddress ip(192, 168, 0, 178);
EthernetClient client;
Sleep sleep;
unsigned long sleepTime;

void setup() {

sleepTime = 10000; // TIEMPO DE DORMIDO
// CONFIGURACION DE PUERTOS PARA EL CONVERSOR (ASEGURA VALORES REQUERIDOS EN LOS PINES)
   
  pinMode(3, OUTPUT); digitalWrite(3, HIGH);
  pinMode(2, OUTPUT); digitalWrite(2, LOW);
  pinMode(4, OUTPUT);
  
  // iniciando comunicacion serial 
  Serial.begin(9600);
  while (!Serial) {
    ; 
  }

  // Inicio de la conexion Ethernet
  if (Ethernet.begin(mac) == 0) {
    //Serial.println("Fallo al configurar Ethernet Shield Usando DHCP");
    //Probando utilizando IP
    Ethernet.begin(mac);
  }

  if (!SD.begin(4)){
    //Serial.println("Comunicacion con la SD fallida");
    }else{
  //Serial.println("SD OK");
    }
  setSyncProvider(RTC.get);   // SINCRONIZACION CON EL RTC
}

void loop() {

String datastring = ""; // Se vacia para evitar errores

File datafile=SD.open("datalog.txt" , FILE_WRITE);

//LECTURA DE LA TERMOCUPLA COMO VALOR ENTERO, PUEDE MODIFICARSE A FLOAT O DOUBLE

valor = thermocouple.readCelsius();
 delay(3000);
// CONVERSION DEL DATO A STRING, DENTRO DE LA VARIABLE TEMP, PARA PODERLO INCLUIR EN LA URL 
temp=String(valor);

datastring += temp;

// IMPRESION EN EL MONITOR DE LA VARIABLE LEIDA
Serial.println(temp);
  
  // Retardo de inicio de comunicacion 
  delay(3000);

if (datafile) {  // ESCRIBIENDO EN EL ARCHIVO DATALOGGER 
 //OPCIONAL, NECESITAMOS UN CURRENT STAMP......
 datafile.print(datastring);
 datafile.print(", C,");
 datafile.print(hour());
 datafile.print(":");
 datafile.print(minute());
 datafile.print(":");
 datafile.print(second());
 datafile.print(" "); 
 datafile.print(day());
 datafile.print("-");
 datafile.print(month());
 datafile.print("-");
 datafile.println(year());
 datafile.close();    //si no se cierra no se guarda

  Serial.println(F("Almacenado en SD"));
  }else{
    Serial.println(F("Error abriendo archivo TEXT"));
    }
  Serial.println(F("Conectando..."));

  // Reporte de conexion exitosa
  
  char cadena[40];
    delay(3000);
  if (client.connect(server, 80)) {
    Serial.println(F("conectado"));
    delay(3000);
  // PETICION HTTP
 
    //client.println("GET /proyecto-tesis-NUBE/TESTmysql.php/"+temp+"/1");   //  ----SLIM 
    sprintf(cadena, "GET /proyecto-tesis-NUBE/TESTmysql.php/");   //  ----SLIM 
    client.print(cadena);
    client.print(temp);
    client.print("/1");
    client.print(" HTTP/1.1\r\n");
    client.print("Host: ");
    client.print(server);
    client.print("\r\n\r\n");
    client.print("Connection: close");
    client.println();
    
  } else {
    // Reporte de conexion Fallida
    Serial.println(F("conexion fallida"));
  }
  
  // Si exiten bytes entrantes disponibles
  // desde el servidor, se leen y se imprimen.
  delay(3000);
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }
delay(3000);
  // Desconecta al cliente si se cierra la conexion.
  if (!client.connected()) {
    //Serial.println(F(""));
    Serial.println(F("desconectado"));
    }
   
   client.stop();
   client.flush();
  
  sleep.pwrDownMode(); //set sleep mode
  sleep.sleepDelay(sleepTime); //sleep for: sleepTime
}  
