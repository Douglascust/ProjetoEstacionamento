<?php

function inserir_tarifa($tipo_tarifa, $tipo_cliente, $dia_da_semana, $horario)
{
    if (is_numeric($tipo_tarifa) && is_string($tipo_cliente) && is_string($dia_da_semana) && is_string($horario)){
        $c = conectar_estacionamento();
        $sql="INSERT INTO tarifa (tipo_tarifa, tipo_cliente, dia_da_semana, horario)
        VALUES ($tipo_tarifa, '$tipo_cliente', '$dia_da_semana', '$horario');";
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


function consultar_tarifa()
{
    $c = conectar_estacionamento();
    $sql="SELECT * FROM tarifa;";
    $consulta=mysqli_query($c,$sql);
    return $consulta;
}

function consultar_id_tarifa($tipo_tarifa)
{
    if(is_numeric($tipo_tarifa)){
        $c = conectar_estacionamento();   
        $sql = "SELECT * FROM tarifa WHERE tipo_tarifa = $tipo_tarifa;";    
        $consulta = mysqli_query($c, $sql);    
        return $consulta;    
    }else{
        echo "\n" . "Parametros invalidos";    
    }
}

function consultar_tipo_cliente($tipo_cliente)
{
    if (is_string($tipo_cliente)) {
        $c = conectar_estacionamento();
        $sql = "SELECT * FROM tarifa WHERE tipo_cliente = '$tipo_cliente';";
        $consulta = mysqli_query($c, $sql);
        return $consulta;
    }else {
        echo "\n" . "Parametros invalidos";
    }
}

function alterar_tarifa($horario, $tipo_tarifa, $tipo_cliente, $dia_da_semana)
{
    if (is_string($horario) || is_numeric($tipo_tarifa) || is_string($tipo_cliente) || is_string($dia_da_semana)) {
        $c=conectar_estacionamento();
        $sql="UPDATE tarifa SET horario='$horario', tipo_cliente='$tipo_cliente', dia_da_semana='$dia_da_semana' WHERE tipo_tarifa=$tipo_tarifa;";
        $result = mysqli_query($c,$sql);
        if ($result == true) {
            echo"\n"."Deu certo";
            return true;
        }else {
            $msg = mysqli_error($c);
            echo"\n". "Não funcionou";
            return false;
        }
    }else {
        echo "\n"."Parametros invalidos";
        return false;
    }
}

function excluir_tarifa($tipo_tarifa)
{
    if (is_numeric($tipo_tarifa)) {
        $c = conectar_estacionamento();
        $sql = "DELETE FROM tarifa WHERE tipo_tarifa = $tipo_tarifa;";
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

?>