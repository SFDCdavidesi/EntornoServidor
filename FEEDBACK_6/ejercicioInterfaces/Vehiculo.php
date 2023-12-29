<?php
/*Creamos un proyecto llamado EjercicioInterfaces crearemos una interface llamada 
Vehiculo que deberán implementar nuestras clases y que contendrá: 
 Dos métodos que retornarán un String llamados frenar y acelerar. Cada uno de los 
métodos tendrá un argumento de tipo entero llamado distancia. 
Después crearemos dos clases llamadas Coche y Moto que implementaran la interfaz 
creada. 
Las clases se describen a continuación: 
Clase Coche 
Esta clase implementará la interfaz Vehiculo y contará con una propiead de clase 
denominada velocidad, de tipo entero, inicializada a cero. 
El método frenar tiene que retornarnos un mensaje como este return "El coche ha 
frenado ya y va a "+velocidad+"km/hora"; 
El método acelerar tiene que comprobar que no superamos la velocidad máxima fijada en 
la interfaz y nos tiene que retornar al final el siguiente mensaje return "El coche ha 
acelerado y va a "+velocidad+"km/hora";  */
interface Vehiculo{
    public function frenar( $distancia):String;
    public function acelerar( $distancia):String;
}
class Coche implements Vehiculo{

    protected $velocidad=0;
    protected $velocidadMaxima=120;
    public function frenar ( $distancia):string{   
        $this->velocidad-=$distancia;
        if ($this->velocidad<0)
        $this->velocidad=0;
        return "El coche ha frenado ya y va a " . $this->velocidad . " km / h";

    }
    public function acelerar (  $distancia):String{
        $this->velocidad+=$distancia;
        if ($this->velocidad>$this->velocidadMaxima){
            $this->velocidad=$this->velocidadMaxima;
        }
        return "El coche ha acelerado ya y va a " . $this->velocidad . " km / h";

    }
}
class Moto implements Vehiculo{
    /*
    *Clase Moto 
Esta clase implementará la interfaz Vehiculo y contará con una variable de clase 
denominada velocidad, de tipo entero, inicializada a cero. 
El método frenar tiene que retornarnos un mensaje como este return "La moto ha 
frenado ya y va a " + velocidad + "km/hora"; 
El método acelerar tiene que comprobar que no superamos la velocidad máxima fijada en 
la interfaz y nos tiene que retornar al final el siguiente mensaje return "La moto ha 
acelerado y va a " + velocidad + "km/hora"; 
En el método main haremos lo siguiente: 
Creamos una matriz de tipo Vehiculo con dos cajones. 
En cada cajón metemos un objeto (Coche y Moto) 
Recorremos la matriz de tipo Vehiculo mostrando por consola los datos de los métodos 
frenar y acelerar que hemos introducido a mano */
protected $velocidad=0;
protected $velocidadMaxima=120;
public function frenar ( $distancia):String{   
    $this->velocidad-=$distancia;
    if ($this->velocidad<0)
    $this->velocidad=0;
    return "La moto ha frenado ya y va a " . $this->velocidad . " km / h";

}
public function acelerar ( $distancia):String{
    $this->velocidad+=$distancia;
    if ($this->velocidad>$this->velocidadMaxima){
        $this->velocidad=$this->velocidadMaxima;
    }
    return "La moto ha acelerado y va a " . $this->velocidad . " km / h";

}

}
?>