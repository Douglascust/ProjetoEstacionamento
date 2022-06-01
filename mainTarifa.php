<?php
include_once('funcao_tarifa.php');
include_once('conexao.php');
extract($_REQUEST, EXTR_SKIP);
if (isset($acao)) {
    if ($acao == "Incluir Tarifa") {
        if (isset($tipo_tarifa) && isset($tipo_cliente) && isset($dia_da_semana) && isset($horario)) {
            $tarifa = htmlspecialchars_decode(strip_tags($tipo_tarifa));
            $cliente = htmlspecialchars_decode(strip_tags($tipo_cliente));
            $semana = htmlspecialchars_decode(strip_tags($dia_da_semana));
            $horario = htmlspecialchars_decode(strip_tags($horario));   
            if (inserir_tarifa($tipo_tarifa, $tipo_cliente, $dia_da_semana, $horario)) {
                echo "<br>"."Tarifa incluido com sucesso !!";
            } else {
                echo "<br>"."Tarifa nao foi incluido !!";
            }
        }
    }
}

if (isset($acao)) {
    if ($acao == "consultar") {
        $testaConsulta = consultar_tarifa();
        $qtdLinhas = mysqli_num_rows($testaConsulta);
        if ($qtdLinhas == 0) {
            echo "Não existe registroa na tabela" . "<br>";
        }else {
            for ($i=0; $i < $qtdLinhas; $i++) { 
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "| Tarifa: " . $linha['tipo_tarifa'] . "| Cliente: " . $linha['tipo_cliente']
                . "| Dia da semana: " . $linha['dia_da_semana'] . "| Horário: " . $linha['horario'] . " | " . "<br>";
            }
        }
    }
}

if (isset($acao)) {
    if ($acao == "Consultar tarifa") {
        if (isset($tipo_tarifa)) {
            $tipo_tarifa = htmlspecialchars_decode(strip_tags($tipo_tarifa));
            $testaConsulta = consultar_id_tarifa($tipo_tarifa);
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0) {
                echo "<br />" . "Não há registros na tabela!!" . "<br/>";
            }else {
                for ($i=0; $i < $qtdLinhas; $i++) { 
                    $linha = mysqli_fetch_assoc($testaConsulta);
                    echo "<br/>" . "| Tipo tarifa:" . $linha['tipo_tarifa'] . "| Cliente:" . $linha['tipo_cliente']
                    . "| Dia da semana: " . $linha['dia_da_semana'] . "| Horário: " . $linha['horario'] . " | " . "<br>";
                }
            }
        }
    }
}

if (isset($acao)) {
    if ($acao == "Consultar cliente") {
        if (isset($tipo_cliente)) {
            $tipo_tarifa = htmlspecialchars_decode(strip_tags($tipo_cliente));
            $testaConsulta = consultar_tipo_cliente($tipo_cliente);
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0) {
                echo "<br />" . "Não há registros na tabela!!" . "<br/>";
            }else {
                for ($i=0; $i < $qtdLinhas; $i++) { 
                    $linha = mysqli_fetch_assoc($testaConsulta);
                    echo "<br/>" . "| Tipo tarifa:" . $linha['tipo_tarifa'] . "| Cliente:" . $linha['tipo_cliente']
                    . "| Dia da semana: " . $linha['dia_da_semana'] . "| Horário: " . $linha['horario'] . " | " . "<br>";
                }
            }
        }
    }
}

if (isset($acao)) {
    if ($acao == "Alterar tarifa") {
        if (isset($horario) || isset($tipo_tarifa)  || isset($tipo_cliente) || isset($dia_da_semana)) {
            $horario = htmlspecialchars_decode(strip_tags($horario));
            $tipo_tarifa = htmlspecialchars_decode(strip_tags($tipo_tarifa));
            $tipo_cliente = htmlspecialchars_decode(strip_tags($tipo_cliente));
            $dia_da_semana = htmlspecialchars_decode(strip_tags($dia_da_semana));
        }if (alterar_tarifa($horario, $tipo_tarifa, $tipo_cliente, $dia_da_semana)) {
            echo "Usuário alterado com sucesso !!" . "<br>";
        }else {
            echo "Usuário não foi alterado" . "<br>";
        }
    }
}

if (isset($acao)) {
    if ($acao == "Excluir tarifa") {
        if (isset($tipo_tarifa)) {
            $tipo_tarifa = htmlspecialchars_decode(strip_tags($tipo_tarifa));
        }if (excluir_tarifa($tipo_tarifa)) {
            echo "Tarifa excluido com sucesso!!" . "<br>";
        }else {
            echo "Tarifa não excluido com sucesso" . "<br>";
        }
    }
}

?>