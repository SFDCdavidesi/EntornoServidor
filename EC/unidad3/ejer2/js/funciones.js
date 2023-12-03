function valida(destino='destino'){
    var correo=document.getElementById('email').value ;
    console.log(correo);
    var expresionRegularCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let dondeVaElMensaje=document.getElementById(destino);
    dondeVaElMensaje.appendChild(document.createTextNode(' El correo ' + correo + ' es ' + expresionRegularCorreo.test(correo)));
    dondeVaElMensaje.appendChild(document.createElement('br'));
}
function validaNum()
{
    var num=document.getElementById('numeroDNI').value ;
    if (num<0 || num> 99999999){
        document.getElementsByTagName('body')[0].appendChild(document.createTextNode('El número introducido es incorrecto')).appendChild(document.createElement('br'));
        return false;
    }else{
        return true;
    }
}
function validaLetra(){
    var letra=document.getElementById('letra').value;
    letra=letra.toUpperCase();
    document.getElementById('letra').value=letra;
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 
    'V', 'H', 'L', 'C', 'K', 'E', 'T'];
    if (validaNum()){
        let numerodni = document.getElementById('numeroDNI').value;
        let resto=numerodni%23;
        console.log('El resto es ' + resto);
        let cc =letras[resto];
        console.log('La letra es ' + cc);
        if (letra==cc){
            document.getElementsByTagName('body')[0].appendChild(document.createTextNode('La letra es correcta'));
            console.log('La letra ' + letra + ' es correcta'             );
        }else{
            document.getElementsByTagName('body')[0].appendChild(document.createTextNode('La letra NO es correcta'));
            console.log('La letra ' + letra + ' NO es correcta'             );  
        }
    }

}