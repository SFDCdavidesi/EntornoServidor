<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><?php
            session_start();

//session_destroy();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            var_dump(isset($_SESSION['a']));
            if($_POST['opciones'] === "1"){
                $_SESSION['a']++;
            }else if($_POST['opciones'] === "-1"){
                $_SESSION['a']--;
            }
            else if($_POST['opciones'] === "2"){
                $_SESSION['b']--;
            }
            else if($_POST['opciones'] === "-2"){
                $_SESSION['b']--;
            }
        }else{
            $_SESSION['a'] = 0;
            $_SESSION['b'] = 1;
            echo 'joder'.$_SESSION['b'];
        }
        $a= isset($_SESSION['a']) ? $_SESSION['a']:0;
        $b= isset($_SESSION['b']) ? $_SESSION['b']:0;
        echo '<form method = "Post">';

        echo '<label>a</label><label>'.$a.'</label><br> 
                <label>b</label><label>'.$b.'</label><br>'; 
        echo '<select name="opciones" id="opciones">
        <option value="1">Sumar uno a A</option>
        <option value="-1">Restar uno a A</option>
        <option value="2">Sumar uno a B</option>
        <option value="-2">Restar uno a B</option>
      </select> <input type="submit" value="OK"></form>'
        ?>