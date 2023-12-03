var estas=[];
function calculaOcurrencias(){
let texto=document.getElementById('razones').value.trim() ;
var estadisticas=document.getElementById('estadisticas');
for (let i=0;i<texto.length;i++){
    let c=texto.charAt(i).toUpperCase();
    if (estas[c]==null){
        console.log('no existe, lo creo');
        estas[c]=1;
    }else{
estas[c]++;
console.log('Sí existe, lo incremento');
    }
}
let estaOrdenado=ordenarObjetoAlfabeticamente(estas);
let str="";
for (let k in estaOrdenado){
    str+=k + ' => ' + estaOrdenado[k] + ' ocurrencias \r';
}
document.getElementById('resultadoOcurrencias').innerText=str;
}


  
  function ordenarObjetoAlfabeticamente(objeto) {
    // Convertir el objeto en una matriz de pares clave-valor y ordenar por la clave
    const arrayOrdenado = Object.entries(objeto).sort(([claveA], [claveB]) => claveA.localeCompare(claveB));
  
    // Convertir la matriz ordenada de nuevo a un objeto
    const objetoOrdenado = Object.fromEntries(arrayOrdenado);
  
    return objetoOrdenado;
  }

