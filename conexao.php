<?php

function conectar_estacionamento(){
    $c = mysqli_connect("localhost", "root", "", "estacionamento");
    if (mysqli_connect_errno() <> 0) {
        $msg = mysqli_connect_error($c);
        echo "\n" . "Erro na conexão SQL! ".$msg;
    }
    else{
        echo "\n" . "Conexão ok, podemos continuar!";
    }
    return $c;
}

?>