<?php


$leches = '[
    {
        "id": 1,
        "nombre": "Pascual",
        "descripcion": "Experimenta la fusión de tradición e innovación con la leche Pascual, un deleite desde 1969. Frescura, calidad y variedad en cada sorbo.",
        "precio": 2.99,
        "imagen": "img/pascual.jpg"
    },
    {
        "id": 2,
        "nombre": "Central Lechera Asturiana",
        "descripcion": "Sumérgete en la autenticidad láctea asturiana desde 1978. Con calidad y sostenibilidad, ofrecemos leche rica y nutritiva.",
        "precio": 3.49,
        "imagen": "img/centralLechera.jpg"
    },
    {
        "id": 3,
        "nombre": "RIO",
        "descripcion": "Descubre la esencia única de la leche RIO, capturando la autenticidad desde 1978. Variedades frescas que respetan la tradición y el medio ambiente.",
        "precio": 2.79,
        "imagen": "img/rio.jpg"
    },
    {
        "id": 4,
        "nombre": "Lauki",
        "descripcion": "Desde 1978, Lauki ofrece leche pura y saludable. Explora nuestra gama para encontrar la opción perfecta que se adapte a tu estilo de vida.",
        "precio": 3.19,
        "imagen": "img/lauki.jpg"
    },
    {
        "id": 5,
        "nombre": "GAZA (Ganaderos de Zamora)",
        "descripcion": "La esencia láctea de Zamora desde 1985. GAZA, de los Ganaderos de Zamora, garantiza frescura y autenticidad en cada sorbo.",
        "precio": 2.89,
        "imagen": "img/gaza.jpg"
    }
]';
// Convierte la cadena JSON a un array de PHP
$lechesArray = json_decode($leches, true);


function addCarrito($id){

    if (!isset($_SESSION['carrito'])){
        $_SESSION['carrito']=[$id=>1];
    }else{

        //buscamos si ya tenemos algún elemento
        if($_SESSION['carrito'][$id]){
            
            $_SESSION['carrito'][$id]++;
        }else{
            $_SESSION['carrito'][$id]=1;
        }
    }
}
if (isset($_REQUEST) && isset($_REQUEST['addCarrito'])){

    addCarrito($_REQUEST['addCarrito']);
}
if (isset($_REQUEST) && isset($_REQUEST['borrarCarrito']) && $_REQUEST['borrarCarrito']=='yes'){
    unset($_SESSION['carrito']);
    session_destroy();
    header("location")
}
// Muestra el contenido en una tabla creada con DIVs
echo '<div style="display: flex; flex-wrap: wrap;">';
foreach ($lechesArray as $leche) {
    echo '<div class="productos">';
    echo '<img src="' . $leche['imagen'] . '" alt="' . $leche['nombre'] . '" style="max-width: 100px; max-height: 100px;"><br>';
    echo '<strong>' . $leche['nombre'] . '</strong><br>';
    ?><br><input type="button" value="comprar" onclick='addCarrito(<?=$leche['id']?>)'> <?php
    echo 'Descripción: ' . $leche['descripcion'] . '<br>';
    echo 'Precio: $' . $leche['precio'] . '<br>';
    echo '</div>';
}
echo '</div>';

?>

