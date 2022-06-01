<?php

function inserir_cadastro ($id_cadastro,$placa,$nome,$cpf)
{
    if (is_numeric($id_cadastro) && is_string($placa) && is_string($nome) && is_string($cpf)){
        $c = conectar_estacionamento();
        $sql="INSERT INTO cadastro (id_cadastro, placa, nome, cpf)
        VALUES ($id_cadastro, '$placa', '$nome', '$cpf');";
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

function consultar_cadastro()
{
    $c = conectar_estacionamento();
    $sql="SELECT * FROM cadastro;";
    $consulta=mysqli_query($c,$sql);
    return $consulta;
}

function consultar_id_cadastro($id_cadastro){

if(is_numeric($id_cadastro)){

    $c = conectar_estacionamento();

    $sql = "SELECT * FROM cadastro WHERE id_cadastro = $id_cadastro;";

    $consulta = mysqli_query($c, $sql);

    return $consulta;

}
else{

    echo "\n" . "Parametros invalidos";

}
}

function consultar_placa($placa)
{
    if (is_string($placa)) {
        $c = conectar_estacionamento();
        $sql = "SELECT * FROM cadastro WHERE placa = '$placa';";
        $consulta = mysqli_query($c, $sql);
        return $consulta;
    }else {
        echo "\n" . "Parametros invalidos";
    }
}


function alterar_cadastro($id_cadastro, $placa, $nome, $cpf)
{
    if (is_numeric($id_cadastro) || is_string($placa) || is_string($nome) || is_string($cpf)) {
        $c=conectar_estacionamento();
        $sql="UPDATE cadastro SET placa='$placa', nome='$nome', cpf='$cpf' WHERE id_cadastro = '$id_cadastro';";
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

function excluir_cadastro($id_cadastro)
{
    if (is_numeric($id_cadastro)) {
        $c = conectar_estacionamento();
        $sql = "DELETE FROM cadastro WHERE id_cadastro = $id_cadastro;";
        $result = mysqli_query($c,$sql);
        if (mysqli_affected_rows($c) == 0) {
            return false;
        }else {
            return true;
        }
    }else {
        echo "\n"."Paramentros invalidos";
        return false;
    }
}

function logar_cadastro($id_cadastro,$cpf)
{
if (is_numeric($id_cadastro) && is_string($cpf)){
        $c=conectar_estacionamento();
        $sql = "SELECT * FROM cadastro WHERE id_cadastro = $id_cadastro AND cpf = '$cpf';";
        $consulta=mysqli_query($c,$sql);
        if (mysqli_num_rows($consulta)==0) {
            #usuario e senha não existe, retorna falso
            return false;
        }else {
            #achou então retorna verdadeiro
            return true;
        }
    }else {
        echo "\n"."Parametros invalidos";
        return false;
    }
}

function alterar_id_cadastro($id_cadastro, $cpf)
{
    if ( is_numeric($id_cadastro)  || is_string($cpf)) {
        $c = conectar_estacionamento();
        $sql = "UPDATE cadastro SET  id_cadastro = $id_cadastro WHERE cpf = '$cpf';";
        $result = mysqli_query($c, $sql);
        if ($result == true) {
        # exclusã bem sucedida
            echo "\n" . " Alteração ok" . "<br>";
            return true;
        } else {
            echo "\n" .  " Alteração not ok";
            return false;
        }
    } else {
        echo "\n" . "Parametros informados inválidos" . "<br>";
        return false;
    }
}

?>