<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios voluntarios</title>
    <style>
        .container, #ejer1, #ejer2{
            width: 50%;
            margin: 0 auto;
        }
        #ejer1{
            padding:50px   ;
            border: 1px dotted black;
        }
        #ejer2{
            padding:50px   ;
            border: 1px dotted navy;
        }
        #ejer2 label{

            width: 50%;
        }
        #ejer2 input[type="submit"]{

         margin-top: 30px;
        }
        .resultado{
            width: 50%;
            margin: 0 auto;
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <select name="ejercicio" id="ejercicio">
            <option value="0">Elije</option>
            <option value="1">Ejercicio 1 Oeraciones con enteros</option>
            <option value="2">Ejercicio 2 Formulario recogida de datos</option>
            <option value="3">Ejercicio 3</option>

        </select>
    </div>
    <br>
    <br>
    <hr>
    <br>
    <div id="ejer1">
        <form id="ejercicio1" method="post">
            <label for="num1">Número 1</label>
            <input type="number" name="num1" id="num1"> <br/>
            <label for="num2">Número 2</label>
            <input type="number" name="num2" id="num2"><br/>

            <label for="operacion"> Operación: </label><select name="operacion" id="operacion">
                <option value="suma">Suma</option>
                <option value="resta">Resta</option>
                <option value="multiplicacion">Multiplicación</option>
            </select>
            <input type="submit" value="Enviar" hidden><br/>
        </form>
        <div id="resultado"></div> 

    </div>
    <div id="ejer2">
        <!-- 
            Escriba un formulario de recogida de datos personales que conste 
de dos páginas. 
a. En la primera página se solicitan el sexo y las aficiones. 
b. En la segunda página se muestran el sexo y las aficiones 
indicados por el usuario o se informa de los errores 
cometidos. 
c. Notas: 
i. En la segunda página se mostrará un aviso si no se 
selecciona uno de los sexos. 
ii. En la segunda página se mostrará un aviso si en los 
controles se reciben valores no vacíos distintos de los 
que establece el formulario. 
iii. En la segunda página, si no se indica ninguna afición, el 
programa debe indicarlo. 
        -->
        <form name="aficiones" id="aficiones">
            <h1> Indique su sexo y aficiones</h1>
            <label for="sexo">Sexo</label>
            <input name="sexo" id="sexo" type="radio" value="hombre">Hombre</input>
            <input name="sexo" id="sexo" type="radio" value="mujer">Mujer</input><br/>
            <label for="aficiones">Aficiones</label>
            <input name="aficiones[]" id="aficiones" type="checkbox" value="cine">Cine</input>
            <input name="aficiones[]" id="aficiones" type="checkbox" value="literatura">Literatura</input>
            <input name="aficiones[]" id="aficiones" type="checkbox" value="musica">Música</input><br/>
            <input name="aficiones[]" id="aficiones" type="checkbox" value="tauramaquia">Toros</input><br/>

            <input type="submit" value="Enviar"><input type="reset" value="Borrar">
        </form>
        <div id="resultado2"></div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#ejer1,#ejer2").hide();


        $("#aficiones").submit(function(e){
   
            e.preventDefault();
            var sexo = $("#sexo:checked").val();
            
            var aficiones  = $('#aficiones:checked').map(function() {
    return this.value;
}).get();
            $.ajax({
                type: "POST",
                url: "ejer1ajax.php",
                data: {action:"ejercicio2",sexo:sexo, aficiones:aficiones},
                success: function (response) {
                    $("#resultado2").html(response);
                },
                error: function (response) {
                    $("#resultado2").html("Error");
                }
            });
        });
        $("#ejercicio").change(function(){
            var ejercicio = $("#ejercicio").val();
            switch (ejercicio) {
                case "0":
                    $("#ejer1,#ejer2").hide();
                    break;
                case "1":
                    $("#ejer1").show();
                    $("#ejer2").hide();
                    break;
                case "2":
                    $("#ejer1").hide();
                    $("#ejer2").show();
                    break;
                case "3":
                    $("#ejer1").hide();
                    break;
            }
        });
        $("#operacion").change(function(e){
            e.preventDefault();
            var num1 = $("#num1").val();
            var num2 = $("#num2").val();
            var operacion = $("#operacion").val();
            $.ajax({
                type: "POST",
                url: "ejer1ajax.php",
                data: {action:"ejercicio1",num1:num1, num2:num2, operacion:operacion},
                success: function (response) {
                    $("#resultado").html(response);
                },
                error: function (response) {
                    $("#resultado").html("Error");
                }
            });
        });
    });
    </script>
</html>