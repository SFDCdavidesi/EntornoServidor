<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
.body{
grid-template-columns: 1fr 1fr 1fr;


}</style>
</head>

<body>
    <?php
    function imprime($nombres)
    {
        echo "<ol>";
        foreach ($nombres as $n) {
            echo "<li>$n</li>\n";
        }
        echo "</ol>";
        foreach ($nombres as $k=>$v){
            echo "El elemento $k vale $v <br>";
        }
    }
    $nombres = ["pepe", "juan", "maria", "luis"];
    echo "El array tiene " . count($nombres) . " elementos <br>";
    imprime($nombres);
    echo "añadiendo pedro <br>";
    array_push($nombres, "pedro");
    imprime($nombres);
    echo "quitando un elemento (3) <br>";

    unset($nombres[2]);
    imprime($nombres);

    $nombres[10] = "ana";
    imprime($nombres);
    //echo "<br> haciendo un unset <br>";
   // unset($nombres[10]);
    array_push($nombres,"federico");
    imprime($nombres);
    ?>
</body>

</html>