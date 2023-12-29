<?php
/*
EJERCICIO CLASE ABSTRACTA 
1º. Vamos a crear una clase denominada Figura de la cual no se podrán crear 
objetos. Esta clase debe tener lo siguiente: 
- 2 variables de tipo double denominadas x e y. 
- Constructor con argumentos que inicialicen x e y 
- Método abstracto denominado área que retorne un double. */
abstract class Figura{
    protected $x;
    protected $y;
    public function __construct($x,$y){
        $this->x=$x;
        $this->y=$y;

    }
     abstract public function area():doubleval;
}

class Cuadrado extends Figura{

private $lado;

public function __construct($lado){
parent::__construct($lado, $lado);
$this->lado=$lado;
}
public function area():doubleval{
    return $this->lado * $this->lado;
}

}
class Circulo extends Figura{
    private $radio;
    const PI =3.141592654;
    public function __construct($radio){
        parent::__construct($radio,0);
        $this->radio=$radio;
    }
    public function area():doubleval{
        return self::PI * pow($this->radio,2);
    }
}

$cuadrado = new Cuadrado(2);
echo "El área de un cuadrado de lado ". $cuadrado->lado . " es = " . $cuadrado->area();

$circulo = new Circulo (15);
echo "El área de un círculo de radio " . $circulo->radio . " es = " . $circulo->area();
?>