<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $ciudad="Miami";
    $edad = 33;
    $vec = compact("ciudad","edad");
    print_r($vec);
    echo $ciudad  . "<br>" . $edad;
    foreach ($vec as $k=>$v){
        echo "El elemento $k vale $v <br>";
    }
    ?>
</body>
</html>