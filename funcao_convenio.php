<?php

function inserir_convenio($id_convenio, $loja_conveniada, $endereco, $numero_residencial)
{
    if (is_string($id_convenio || $loja_conveniada) || is_string($endereco) || is_numeric($numero_residencial)) {
        $c=conectar_estacionamento();
        $sql="INSERT INTO convenio (id_convenio, loja_conveniada, endereco, numero_residencial)
        VALUES ($id_convenio, '$loja_conveniada', '$endereco', $numero_residencial);";
        $result = mysqli_query($c,$sql);
        if (mysqli_affected_rows($c) == 0) {
            return false;
        }else {
            return true;
        }
    }else {
        echo "\n"."Parametros invalidos";
        return false;
    }
}


function consultar_convenio(){
    $c = conectar_estacionamento();
    $sql = "SELECT * FROM convenio;";
    $consulta = mysqli_query($c, $sql);
    return $consulta;

}

function consultar_id_convenio($id_convenio)
{
    if(is_numeric($id_convenio)){
        $c = conectar_estacionamento();   
        $sql = "SELECT * FROM convenio WHERE id_convenio = $id_convenio;";    
        $consulta = mysqli_query($c, $sql);    
        return $consulta;    
    }else{
        echo "\n" . "Parametros invalidos";    
    }
}

function consultar_loja_convenio($loja_conveniada){
    if(is_string($loja_conveniada)){
        $c = conectar_estacionamento();
        $sql = "SELECT * FROM convenio WHERE loja_conveniada = '$loja_conveniada';";
        $consulta = mysqli_query($c, $sql);
        return $consulta;
    }else {
        echo "\n" . "Parametros invalidos";
    }
}


function alterar_convenio($id_convenio, $loja_conveniada, $endereco, $numero_residencial){
    if(is_numeric($id_convenio) || is_string($loja_conveniada) || is_string($endereco) || is_numeric($numero_residencial)){
        $c = conectar_estacionamento();
        $sql = "UPDATE convenio SET loja_conveniada = '$loja_conveniada', endereco = '$endereco', numero_residencial = $numero_residencial WHERE id_convenio = '$id_convenio';";
        $result = mysqli_query($c, $sql);
        if($result == true){
            echo "\n" . "Deu certo";
            return true;
        }else {
            echo "\n" . "Não funcionou";
            return false;
        }
    }else {
        echo "\n" . "Parametros invalidos";
        return false;
    }
}

function deletar_convenio($id_convenio){
    if(is_numeric($id_convenio)){
        $c = conectar_estacionamento();
        $sql = "DELETE FROM convenio WHERE id_convenio = $id_convenio;";
        $result = mysqli_query($c, $sql);
        if(mysqli_affected_rows($c) == 0){
            return false;
        }else {
            return true;
        }
    }else {
        echo "\n" . "Paramentros invalidos";
        return false;
    }
}

?>