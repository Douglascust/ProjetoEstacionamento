<?php

function inserir_carro_cliente($id_carro, $id_cadastro, $placa, $cor, $modelo, $marca){

    if(is_numeric($id_carro) && is_numeric($id_cadastro) && is_string($placa) && is_string($cor) && is_string($modelo) && is_string($marca)){

        $c = conectar_estacionamento();

        $sql = "INSERT INTO carro_cliente (id_carro, id_cadastro, placa, cor, modelo, marca) VALUES ($id_carro, $id_cadastro, '$placa', '$cor', '$modelo', '$marca');";

        $result = mysqli_query($c, $sql);

        if($result){

            return true;

        }
        else{

            $msg = mysqli_error($c);

            echo "</br>" . $msg;

            return false;

        }
    }
    else{

        echo "Parametros invalidos </br>";

        return false;

    }
}

function consultar_carro_cliente(){

    $c = conectar_estacionamento();

    $sql = "SELECT * FROM carro_cliente;";

    $consulta = mysqli_query($c, $sql);

    return $consulta;

}

function consultar_id_carro_cliente($id_carro){

    if(is_numeric($id_carro)){

        $c = conectar_estacionamento();

        $sql = "SELECT * FROM carro_cliente WHERE id_carro = $id_carro;";

        $consulta = mysqli_query($c, $sql);

        return $consulta;

    }
    else{

        echo "Parametros invalidos </br>";

    }
}

function alterar_carro_cliente($placa, $id_carro){

    if(is_string($placa) && is_numeric($id_carro)){

        $c = conectar_estacionamento();

        $sql = "UPDATE carro_cliente SET placa = '$placa' WHERE id_carro = $id_carro;";

        $result = mysqli_query($c, $sql);

        if($result){

            return true;

        }
        else{

            $msg = mysqli_error($c);

            echo "</br>" . $msg;

            return false;

        }
    }
    else{

        echo "Parametros invalidos </br>";

        return false;

    }
}

function consultar_placa_carro_cliente($placa){

    if(is_string($placa)){

        $c = conectar_estacionamento();

        $sql = "SELECT * FROM carro_cliente WHERE placa = '$placa';";

        $consulta = mysqli_query($c, $sql);

        if($consulta){

            return $consulta;

        }
        else{

            $msg = mysqli_error($c);

            echo "</br>" . $msg;

            return false;

        }
    }
    else{

        echo "Parametros invalidos </br>";

        return false;

    }
}

function deletar_carro_cliente($modelo, $id_carro){

    if(is_string($modelo) && is_numeric($id_carro)){

        $c = conectar_estacionamento();

        $sql = "DELETE FROM carro_cliente WHERE modelo = '$modelo' and id_carro = $id_carro;";

        $result = mysqli_query($c, $sql);

        if($result){

            return true;

        }
        else{

            $msg = mysqli_error($c);

            echo "</br>" . $msg;

            return false;

        }
    }
    else{

        echo "\n" . "Parametros invalidos </br>";

        return false;

    }
}

?>