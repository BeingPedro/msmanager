//INCLUSION DE LAS LIBRERIAS A UTILIZAR
#include "max6675.h"    // LIBRERIA DEL CONVERTIDOR A-D
#include <Ethernet.h>   // LIBERIA SHIELD ETHERNET
#include <SPI.h>        // LIBRERIA COMUNICACION SERIAL
#include <Wire.h>       // COMUNICACION I2C
#include <SD.h>         // LIBRERIA SD PARA DATALOGGER
#include <TimeLib.h>    // LIBRERIA DE CRONOMETRAJE
#include <DS1307RTC.h>  // LIBRERIA DS1307 TINY RTC
#include <Sleep_n0m1.h> // LIBRERIA SLEEP MODE / STAND-BY


//DEFINICION DE CONSTANTES
#define thermoDO 3
#define thermoCS 5  
#define thermoCLK 6
#define vccPin 3
#define gndPin 2
#define ChipSelect 4

//DEFINICION DE VARIABLES
MAX6675 thermocouple(thermoCLK, thermoCS, thermoDO);
int valor; //Variable para almacenar lecturas
String temp; //Variable de lectura tipo string
String datastring; //Variable a almacenar en SD
unsigned long sleepTime; //Variable para tiempo Stand-by

//DIRECCION MAC ARDUINO
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
// IP DE ARDUINO
//IPAddress ip(192, 168, 0, XXX); Depende de la cantidad de dispositivos

//SERVIDOR
//char server[] = "localhost";    // Nombre del servidor
IPAddress server(192, 168, 1, 100);  // IP del servidor
EthernetClient client; //Asignacion de nombre al cliente
Sleep sleep; //Declaracion de la funcion de reposo o stand-by


void setup() {
//CONFIGURACION DE PUERTOS PARA EL CONVERSOR (ASEGURA VALORES REQUERIDOS EN LOS PINES)
  pinMode(3, OUTPUT); digitalWrite(3, HIGH);
  pinMode(2, OUTPUT); digitalWrite(2, LOW);
//CONFIGURACION CHIP SELECT PARA COMUNICACION CON MEMORIA MICROSD  
  pinMode(4, OUTPUT);
//INICIO DE LA COMUNICACION SERIAL
  Serial.begin(9600);
  while (!Serial) {
    ;
   }
//INICIO CONEXION ETHERNET MEDIANTE MAC
  if (Ethernet.begin(mac) == 0) {
    Ethernet.begin(mac);
  //Ethernet.begin(ip);
  }
//VERIFICACION CONEXION MICROSD
  if (!SD.begin(4)){
 Serial.println("Comunicacion con la SD fallida");
    }else{
  Serial.println("SD OK");
    }
// SINCRONIZACION CON EL RTC
  setSyncProvider(RTC.get);
// ESTABLECIMIENTO DEL TIEMPO DE REPOSO / STAND-BY
sleepTime = 10000; 
}

void loop() {
//LECTURA DE LA TERMOCUPLA COMO VALOR ENTERO, PUEDE MODIFICARSE A FLOAT O DOUBLE
valor = thermocouple.readCelsius(); //Captura de valor leido por la termocupla
delay(3000);

// CONVERSION DE VALOR A STRING, DENTRO DE LA VARIABLE TEMP
datastring = "";  //Se vacia la variable para evitar errores
temp=String(valor); //Conversion de dato a tipo string
datastring += temp; //Almacenamiento del valor captado en la variable a guardar en SD

//APERTURA DE ARCHIVO EN SD
File datafile=SD.open("datalog.txt" , FILE_WRITE); 

// IMPRESION EN EL MONITOR DE LA VARIABLE LEIDA
Serial.println(temp);
// Retardo de inicio de comunicacion 
 delay(3000);

// ESCRITURA DE DATOS EN EL ARCHIVO DATALOG.TXT
if (datafile) {  
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
 datafile.close();    //Se cierra el archivo para poder almacenar los datos
  Serial.println(F("Almacenado en SD"));
  }else{
  Serial.println(F("Error abriendo archivo TEXT"));
  }


//REPORTE DE CONEXION EXITOSA CON EL SERVIDOR
    Serial.println(F("Conectando..."));
    delay(3000);
  if (client.connect(server, 8080)) {
    Serial.println(F("conectado"));
    delay(3000);
    
//PETICION HTTP  
// ENVIO DE DATOS A TRAVES DE GET EN LA URL
    client.println("GET /tesis/TESTmysql.php?valor="+temp+"&id=1");//Envio de datos
    client.println(" HTTP/1.1"); //Version del protocolo HTTP
    client.println(); //Cierre de la peticion
     
  } else {
    // Reporte de conexion Fallida
    Serial.println(F("conexion fallida"));
  }
   
  delay(3000);
//INDICA VIA SERIAL SI ARDUINO NO ESTA CONECTADO
  if (!client.connected()) {
    Serial.println(F("desconectado"));
    }
//CIERRE DE LA CONEXION CON EL SERVIDOR
client.stop(); //Se desconecta al cliente del servidor
client.flush(); //Espera hasta que se hayan enviado todos los caracteres salientes del buffer

//COMIENZO DE MODO DE REPOSO / STAND-BY
  sleep.pwrDownMode(); //Se activa el modo de ahorro de energía
  sleep.sleepDelay(sleepTime); //Comienza el modo Stand-by segun el tiempo establecido
}  
