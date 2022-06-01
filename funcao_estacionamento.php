<?php

function inserir_estacionamento($id_carro, $data_hora_entrada, $valor, $data_hora_saida, $tipo_cliente, $ultimo_pagamento){

    if(is_numeric($id_carro) && validar_data_hora($data_hora_entrada) && is_numeric($valor) && validar_data_hora($data_hora_saida) && is_string($tipo_cliente)
    && validar_data($ultimo_pagamento)){

        $c = conectar_estacionamento();
        $data_hora_entrada = formatar_data_hora_banco($data_hora_entrada);
        $data_hora_saida = formatar_data_hora_banco($data_hora_saida);   
        $ultimo_pagamento = formatardataBancoEnvio($ultimo_pagamento);

        $sql = "INSERT INTO estacionamento (id_carro, data_hora_entrada, valor, data_hora_saida, tipo_cliente, ultimo_pagamento) VALUES
        ($id_carro, '$data_hora_entrada', $valor, '$data_hora_saida', '$tipo_cliente', '$ultimo_pagamento');";

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

function consultar_estacionamento(){

    $c = conectar_estacionamento();

    $sql = "SELECT * FROM estacionamento;";

    $consulta = mysqli_query($c, $sql);

    return $consulta;

}

function consultar_id_estacionamento($id_carro){

    if(is_numeric($id_carro)){

        $c = conectar_estacionamento();

        $sql = "SELECT * FROM estacionamento WHERE id_carro = $id_carro;";

        $consulta = mysqli_query($c, $sql);

        return $consulta;

    }
    else{

        echo "Parametros invalidos </br>";

        return false;

    }
}

function alterar_estacionamento($ultimo_pagamento, $id_carro){

    if(validar_data($ultimo_pagamento) && is_numeric($id_carro)){

        $c = conectar_estacionamento();

        $ultimo_pagamento = formatardataBancoEnvio($ultimo_pagamento);

        $sql = "UPDATE estacionamento SET ultimo_pagamento = '$ultimo_pagamento' WHERE id_carro = $id_carro;";

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

function deletar_estacionamento($id_carro){

    if(is_numeric($id_carro)){

        $c = conectar_estacionamento();

        $sql = "DELETE FROM estacionamento WHERE id_carro = $id_carro;";

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

        echo "Paramentros invalidos </br>";

        return false;

    }
}

?>
