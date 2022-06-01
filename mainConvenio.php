<?php
include_once('conexao.php');
include_once('funcao_convenio.php');

extract($_REQUEST, EXTR_SKIP);
#Incluir registros para cada uma das quatro tabelas
if (isset($acao)) {
    if ($acao == "Incluir convenio") {
        if (isset($id_convenio) || isset($loja_conveniada) || isset($endereco) || isset($numero_residencial)) {
                $id_convenio = htmlspecialchars_decode(strip_tags($id_convenio));
                $loja_conveniada = htmlspecialchars_decode(strip_tags($loja_conveniada));
                $endereco = htmlspecialchars_decode(strip_tags($endereco));
                $numero_residencial = htmlspecialchars_decode(strip_tags($numero_residencial));
                if (inserir_convenio($id_convenio, $loja_conveniada, $endereco, $numero_residencial)) {
                    echo "<br/>" . "Convenio inserido com sucesso!!" . "<br>";
                }else {
                    echo "<br/>" . "Convenio não inserido com sucesso!!" . "<br>";
                }   
        }
    }
}

#Consultar todos os dados para cada uma das quatro tabelas
if (isset($acao)) {
    if ($acao == "Consultar") {
        $testaConsulta = consultar_convenio();
        $qtdLinhas = mysqli_num_rows($testaConsulta);
        if ($qtdLinhas == 0) {
            echo "<br />" . "Não há registros na tabela!!" . "<br/>";
        }else {
            for ($i=0; $i < $qtdLinhas; $i++) { 
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br/>" . "| Cógido convenio:" . $linha['id_convenio']
                . "| Loja conveniada:" . $linha['loja_conveniada'] 
                . "| Endereço:" . $linha['endereco']
                . "| Número residencial:" . $linha['numero_residencial'] . " | " . "<br>";
            }
        }
    }
}

#Consultar os dados de um registro mediante a informação para a chave para cada uma das quatro tabelas 
if (isset($acao)) {
    if ($acao == "Consultar convenio") {
        if (isset($id_convenio)) {
            $id_convenio = htmlspecialchars_decode(strip_tags($id_convenio));
            $testaConsulta = consultar_id_convenio($id_convenio);
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0) {
                echo "<br />" . "Não há registros na tabela!!" . "<br/>";
            }else {
                for ($i=0; $i < $qtdLinhas; $i++) { 
                    $linha = mysqli_fetch_assoc($testaConsulta);
                    echo "<br/>" . "| Cógido convenio:" . $linha['id_convenio']
                    . "| Loja conveniada:" . $linha['loja_conveniada'] 
                    . "| Endereço:" . $linha['endereco']
                    . "| Número residencial:" . $linha['numero_residencial'] . " | " . "<br>";
                }
            }
        }
    }
}

#Consultar todos os registros que possuam uma informação especifica em uma das três novas tabelas, que não seja a chave
if (isset($acao)) {
    if ($acao == "Consultar loja") {
        if (isset($loja_conveniada)) {
            $loja_conveniada = htmlspecialchars_decode(strip_tags($loja_conveniada));
            $testaConsulta = consultar_loja_convenio($loja_conveniada);
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0) {
                echo "<br />" . "Não há registros na tabela!!" . "<br/>";
            }else {
                for ($i=0; $i < $qtdLinhas; $i++) { 
                    $linha = mysqli_fetch_assoc($testaConsulta);
                    echo "<br/>" . "| Cógido convenio:" . $linha['id_convenio']
                    . "| Loja conveniada:" . $linha['loja_conveniada'] 
                    . "| Endereço:" . $linha['endereco']
                    . "| Número residencial:" . $linha['numero_residencial'] . " | " . "<br>";
                }
            }
        }
    }
}

#Alterar os dados de um registro de cada uma das quatro tabelas de uma determinada chave
if (isset($acao)) {
    if ($acao == "Alterar convenio") {
        if (isset($id_convenio) || isset($loja_conveniada) || isset($endereco) || isset($numero_residencial)) {
            $id_convenio = htmlspecialchars_decode(strip_tags($id_convenio));
            $loja_conveniada = htmlspecialchars_decode(strip_tags($loja_conveniada));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));
            $numero_residencial = htmlspecialchars_decode(strip_tags($numero_residencial));  
        }if (alterar_convenio($id_convenio, $loja_conveniada, $endereco, $numero_residencial)) {
            echo "Sucesso!!" . "<br>";
        }else {
            echo "Sem sucesso!!" . "<br>";
        }
    }
}

#Excluir um registro de cada uma das três novas tabelas de uma determinada chave
if (isset($acao)) {
    if ($acao == "Excluir convenio") {
        if (isset($id_convenio)) {
            $id_convenio = htmlspecialchars_decode(strip_tags($id_convenio));
        }if (deletar_convenio($id_convenio)) {
            echo "<br>" . "Convenio excluido com sucesso!!" . "<br>";
        }else {
            echo "<br>" . "Convenio não excluido com sucesso" . "<br>";
        }
    }
}

?>