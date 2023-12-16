<?php
$pathfile=str_ends_with(dirname($_SERVER['PHP_SELF']),"/php")?"../":"./";
$config = parse_ini_file($pathfile. 'config/database.ini');


?>