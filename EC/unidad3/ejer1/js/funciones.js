const diasDeLaSemana = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"]
let numeros = [];
const MAYOR="mayores";
const MENOR="menores";
function pintaArray(donde,elementos){

    var o = document.getElementById(donde);
    
    for (let i=0;i<elementos.length;i++){
        let t=document.createTextNode(elementos[i] );
        var br=document.createElement("br");
        o.appendChild(t);
        o.appendChild(br);
    }
}

function inicializaNumeros(maxNumeros=10,valorMaximo=101){
    for (let i=0;i<maxNumeros;i++){
        numeros[i]=Math.floor(Math.random() * valorMaximo);
    }
    numeros.sort();
}
function muestra(tipo="mayores"){
    let valor = document.getElementById('numero').value;
    var donde=document.getElementsByTagName('body')[0];
    let mensaje=document.createTextNode('Mostrando los números ' + tipo +' del grupo de números ' + numeros);
    donde.appendChild(mensaje);
    let br=document.createElement("BR");
    donde.appendChild(br);
    console.log('logeando ' + valor + '\r' + tipo);
    donde.appendChild(br);
    for (let i=0;i<numeros.length;i++){
        if (tipo==MAYOR && numeros[i]>valor ){
            showNumber(donde,numeros[i]);
        }else if (tipo==MENOR && numeros[i]<valor){
            showNumber(donde,numeros[i]);
        }

    }
}
function showNumber(w,v){
console.log('Recibiendo l os valroes ' + w );
console.log('El valor de v es = ' + v);
    w.appendChild(document.createTextNode(v));
    w.appendChild(document.createElement("BR"));
}