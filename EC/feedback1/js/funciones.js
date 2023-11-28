
    var errores= [];
var meses= {
    1:31,
    2:28,
    3:31,
    4:30,
    5:31,
    6:30,
    7:31,
    8:31,
    9:30,
    10:31,
    11:30,
    12:31
};
var literalMeses = Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
function validate(objeto){
    if (objeto.value<1 || objeto.value>12){
        errores[errores.length]="El número debe de estar entre 1 y 12";
        return false;
    }else{
        return true;
    }
}
function cuantosdias(){
    let mes = document.getElementById('mes').value;
    if (mes==null || mes==''){
        errores[errores.length]='El número es incorrecto';
    }
    var destino=document.getElementById('destino');
    let br = document.createElement("br");
    if (errores.length>0){
        for (let i=0;i<errores.length;i++){
            let item=document.createElement("b");
            item.classList.add("error");
            let mensaje=document.createTextNode(errores[i]);
            item.appendChild(mensaje);
            destino.appendChild(item);
            destino.appendChild(br);
            
        }
    }else{
        let elementoP= document.createElement("p");
        let mensajedeTexto = document.createTextNode("El mes de " +literalMeses[mes-1] + " tiene " + meses[mes] + " días");
        elementoP.appendChild(mensajedeTexto);
        destino.appendChild(elementoP);
        }
        errores=[];
}
function muestra(id){
    let elemento=document.getElementById(id);
    elemento.classList.remove('oculto');
    oculta(id);
}
function oculta(excepto){
    const paneles = ["operaciones","meses","colores"];
    for (let i=0;i<paneles.length;i++){
        if (paneles[i]!=excepto){
            (document.getElementById(paneles[i])).classList.add("oculto");
        }
    }
}
function ponColor(color){
    let colores={
        "rojo":"red",
        "verde":"green",
        "azul":"blue"
    }
    var parrafo=document.getElementById('parrafo');
    parrafo.style.color=colores[color];
}

//operaciones

function calcular(operacion){
let n1=Number(document.getElementById('num1').value);
let n2=Number(document.getElementById('num2').value);
let n3=0;
let oper='';
switch (operacion){
case "sumar":
    n3=n1+n2;
    oper='+';
    break;
case "restar":
    n3=n1-n2;
    oper='-';
    break;
case "multiplicar":
    n3=n1*n2;
    oper='*';
    break;
case "potencia":
    oper='^';
    n3=Math.pow(n1,n2);
}
let destino=document.getElementById('resultado');
//destino.innerHTML="";
var texto=n1 + ' ' + oper + ' ' + n2 + ' = ' + n3;
destino.value=texto;

}

