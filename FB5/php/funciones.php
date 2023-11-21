<?php
function hashContrasenia($contrasenia)
{
return password_hash($contrasenia, PASSWORD_BCRYPT);
}
function coincidenContrasenias ($contra, $contraBD){
    return password_verify($contra,$contraBD);
}
?>