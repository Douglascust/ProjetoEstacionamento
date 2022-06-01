<?php

include_once('conexao.php');
include_once('funcao_cadastro.php');
include_once('funcao_carro_cliente.php');
include_once('funcao_tarifa.php');
include_once('funcao_convenio.php');
include_once('funcao_estacionamento.php');
include_once('data.php');

extract($_REQUEST, EXTR_SKIP);

// ---------- insert ---------- 


if (isset($acao)) {
    if ($acao == "Incluir cadastro") {
        if (isset($id_cadastro) || isset($placa) || isset($nome) || isset($cpf)) {
                $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
                $placa = htmlspecialchars_decode(strip_tags($placa));
                $nome = htmlspecialchars_decode(strip_tags($nome));
                $cpf = htmlspecialchars_decode(strip_tags($cpf));
                if (inserir_cadastro($id_cadastro, $placa, $nome, $cpf)) {
                    echo "<br/>" . "Cadastro inserido!!" . "<br>";
                }else {
                    echo "<br/>" . "Cadastro não inserido!!" . "<br>";
                }   
        }
    }
}

if(isset($carro_cliente)){

    if($carro_cliente == "Inserir"){

        if(isset($id_carro) && isset($id_cadastro) && isset($placa) && isset($cor) && isset($modelo) && isset($marca)){

            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));
            $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
            $placa = htmlspecialchars_decode(strip_tags($placa));
            $cor = htmlspecialchars_decode(strip_tags($cor));
            $modelo = htmlspecialchars_decode(strip_tags($modelo));
            $marca = htmlspecialchars_decode(strip_tags($marca));

            if(inserir_carro_cliente($id_carro, $id_cadastro, $placa, $cor, $modelo, $marca)){

                echo "Usuario Incluido!! </br>";

            }
            else{

                echo "Usuario não foi Incluido!! </br>";

            }
        }
    }
}

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

if(isset($estacionamento)){

    if($estacionamento == "Inserir"){

        if(isset($id_carro) && isset($data_hora_entrada) && isset($valor) && isset($data_hora_saida)
         && isset($tipo_cliente) && isset($ultimo_pagamento)){

            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));
            $data_hora_entrada = htmlspecialchars_decode(strip_tags($data_hora_entrada));
            $valor = htmlspecialchars_decode(strip_tags($valor));
            $data_hora_saida = htmlspecialchars_decode(strip_tags($data_hora_saida));
            $tipo_cliente = htmlspecialchars_decode(strip_tags($tipo_cliente));
            $ultimo_pagamento = htmlspecialchars_decode(strip_tags($ultimo_pagamento));

            if(validar_data_hora($data_hora_entrada) && validar_data_hora($data_hora_saida)
            && validar_data($ultimo_pagamento)){

                if(inserir_estacionamento($id_carro, $data_hora_entrada, $valor, $data_hora_saida,
                $tipo_cliente, $ultimo_pagamento)){

                    echo "Usuario Incluido </br>";

                }
                else{

                    echo "Usuario não foi Incluido </br>";

                }
            }
            else{

                echo "Data invalida </br>";

            }
        }
    }
}


// ---------- Testes tabela cadastro ----------


if (isset($acao)) {
    if ($acao == "Consultar cadastro") {
        $testaConsulta = consultar_cadastro();
        $qtdLinhas = mysqli_num_rows($testaConsulta);
        if ($qtdLinhas == 0) {
            echo "Não existe registroa na tabela" . "<br>";
        }else {
            for ($i=0; $i < $qtdLinhas; $i++) { 
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "| Cadastro: " . $linha['id_cadastro'] 
                . "| Placa: " . $linha['placa']
                . "| Nome: " . $linha['nome'] 
                . "| CPF: " . $linha['cpf'] . " | " . "<br>";
            }
        }
    }
}

if (isset($acao)) {
    if ($acao == "Consultar id cadastro") {
        if (isset($id_cadastro)) {
            $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
            $testaConsulta = consultar_id_cadastro($id_cadastro);
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0) {
                echo "<br />" . "Não há registros na tabela!!" . "<br/>";
            }else {
                for ($i=0; $i < $qtdLinhas; $i++) { 
                    $linha = mysqli_fetch_assoc($testaConsulta);
                    echo "<br>" . "| Cadastro: " . $linha['id_cadastro'] 
                    . "| Placa: " . $linha['placa']
                    . "| Nome: " . $linha['nome'] 
                    . "| CPF: " . $linha['cpf'] . " | " . "<br>";
                }
            }
        }
    }
}


if (isset($acao)) {
    if ($acao == "Consultar placa") {
        if (isset($placa)) {
            $placa = htmlspecialchars_decode(strip_tags($placa));
            $testaConsulta = consultar_placa($placa);
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0) {
                echo "<br />" . "Não há registros na tabela!!" . "<br/>";
            }else {
                for ($i=0; $i < $qtdLinhas; $i++) { 
                    $linha = mysqli_fetch_assoc($testaConsulta);
                    echo "<br/>" . "| Cógido do cadastro:" . $linha['id_cadastro']
                    . "| Placa:" . $linha['placa'] 
                    . "| Nome:" . $linha['nome']
                    . "| CPF:" . $linha['cpf'] . " | " . "<br>";
                }
            }
        }
    }
}

if (isset($acao)) {
    if ($acao == "Alterar cadastro") {
        if (isset($id_cadastro) || isset($placa)  || isset($nome) || isset($cpf)) {
            $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
            $placa = htmlspecialchars_decode(strip_tags($placa));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
        }if (alterar_cadastro($id_cadastro, $placa, $nome, $cpf)) {
            echo "Cadastro alterado!!" . "<br>";
        }else {
            echo "Cadastro não foi alterado!!" . "<br>";
        }
    }
}

if (isset($acao)) {
    if ($acao == "Excluir cadastro") {
        if (isset($id_cadastro)) {
            $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
        }if (excluir_cadastro($id_cadastro)) {
            echo "Cadastro excluido!!" . "<br>";
        }else {
            echo "Cadastro não excluido" . "<br>";
        }
    }
}

if (isset($acao)) {
    if ($acao == "Logar cadastro") {
        if (isset($id_cadastro) || isset($cpf)) {
            $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            if (logar_cadastro($id_cadastro, $cpf)) {
                echo "<br>" . "Cadastro e cpf ok";
            }else {
                echo "<br>" . "Cadastro e cpf inexistente";
            }
        }
        
    }
}

if (isset($acao)) {
    if ($acao == "Alterar id cadastro") {
        if (isset($id_cadastro) || isset($cpf)) {
            $id_cadastro = htmlspecialchars_decode(strip_tags($id_cadastro));
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
        }if (alterar_id_cadastro($id_cadastro, $cpf)) {
            echo "<br>" . "ID cadastro alterado!!" . "<br>";
        }else {
            echo "<br>" . "ID cadastro não foi alterado!!" . "<br>";
        }
    }
}


// ---------- Testes tabela carro_cliente ----------

if(isset($carro_cliente)){

    if($carro_cliente == "ConsultarTudo"){

        if(consultar_carro_cliente()){    

            $testeconsultar = consultar_carro_cliente();

            $qtdlinhas = mysqli_num_rows($testeconsultar);

            if($qtdlinhas == 0){

                echo "\n" . "Não existem registros na tabela";

            }
            else{

                for($i = 0; $i < $qtdlinhas; $i++){

                    $linha = mysqli_fetch_assoc($testeconsultar);
                    
                    echo "</br>" . "Tabela carro_cliente" . "</br>" . "ID carro = " . $linha['id_carro']
                        . "</br>" . "ID cadastro = " . $linha['id_cadastro'] . "</br>" . "Placa = " . $linha['placa']
                    . "</br>" . "Cor = " . $linha['cor'] . "</br>" . "Modelo = " . $linha['modelo']
                    . "</br>" . "Marca = " . $linha['marca'] . "</br>";
                    
                }

            }
        }
    }
}

if(isset($carro_cliente)){

    if($carro_cliente == "ConsultarId"){

        if(isset($id_carro)){

            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));

            if(consultar_id_carro_cliente($id_carro)){

                $testeconsultar = consultar_id_carro_cliente($id_carro);

                $qtdlinhas = mysqli_num_rows($testeconsultar);

                if($qtdlinhas == 0){

                    echo "\n" . "Não existe o dado na tabela";

                }
                else{

                    for($i = 0; $i < $qtdlinhas; $i++){

                        $linha = mysqli_fetch_assoc($testeconsultar);

                        echo "</br>" . "Tabela carro_cliente" . "</br>" . "ID carro = " . $linha['id_carro']
                        . "</br>" . "ID cadastro = " . $linha['id_cadastro'] . "</br>" . "Placa = " . $linha['placa']
                        . "</br>" . "Cor = " . $linha['cor'] . "</br>" . "Modelo = " . $linha['modelo']
                        . "</br>" . "Marca = " . $linha['marca'] . "</br>";
                    

                    }
                }
            }
        }
    }
} 

if(isset($carro_cliente)){

    if($carro_cliente == "Alterar"){

        if(isset($placa) && isset($id_carro)){

            $placa = htmlspecialchars_decode(strip_tags($placa));
            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));

            if(alterar_carro_cliente($placa, $id_carro)){

                echo "</br>" . "Alteração bem sucedida";

            }
            else{

                echo "</br>" . "Alteração mal sucedida";

            }
        }
    }
}

if(isset($carro_cliente)){

    if($carro_cliente == "ConsultarPlaca"){

        if(isset($placa)){

            $placa = htmlspecialchars_decode(strip_tags($placa));

            if(consultar_placa_carro_cliente($placa)){

                $testeconsultar = consultar_placa_carro_cliente($placa);

                $qtdlinhas = mysqli_num_rows($testeconsultar);

                if($qtdlinhas == 0){

                    echo "</br>" . "Não existe o dado na tabela";

                }
                else{

                    for($i = 0; $i < $qtdlinhas; $i++){

                        $linha = mysqli_fetch_assoc($testeconsultar);

                        echo "</br>" . "Tabela carro_cliente" . "</br>" . "ID carro = " . $linha['id_carro']
                        . "</br>" . "ID cadastro = " . $linha['id_cadastro'] . "</br>" . "Placa = " . $linha['placa']
                        . "</br>" . "Cor = " . $linha['cor'] . "</br>" . "Modelo = " . $linha['modelo']
                        . "</br>" . "Marca = " . $linha['marca'] . "</br>";
                    

                    }
                }
            }
        }
    }
}

if(isset($carro_cliente)){

    if($carro_cliente == "Deletar"){

        if(isset($modelo) && isset($id_carro)){

            $modelo = htmlspecialchars_decode(strip_tags($modelo));
            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));

            if(deletar_carro_cliente($modelo, $id_carro)){

                echo "</br>" . "O registro foi deletado";

            }
            else{

                echo "</br>" . "O registro não foi deletado";

            }
        }
    }
} 


// ---------- Testes tabela tarifa ----------


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


// ---------- Testes tabela convenio ----------


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


// ---------- Testes tabela estacionamento ----------


if(isset($estacionamento)){

    if($estacionamento == "ConsultarTudo"){

        if(consultar_estacionamento()){    

            $testeconsultar = consultar_estacionamento();

            $qtdlinhas = mysqli_num_rows($testeconsultar);

            if($qtdlinhas == 0){

                echo "</br>" . "Não existem registros na tabela";

            }
            else{

                for($i = 0; $i < $qtdlinhas; $i++){

                    $linha = mysqli_fetch_assoc($testeconsultar);
                    
                    echo "</br>" . "ID carro = " . $linha['id_carro'] . "</br>"
                    . "Data e hora de entrada = " . formatar_data_hora_tela($linha['data_hora_entrada']) . "</br>" . "Tipo de tarifa = "
                    . $linha['tipo_tarifa'] . "</br>" . "Id da loja convêniada = " . $linha['id_convenio'] . "</br>" . "Valor = "
                    . $linha['valor'] . "</br>" . "Data e hora de saida = " . formatar_data_hora_tela($linha['data_hora_saida']) . "</br>" . "Tipo de cliente = "
                    . $linha['tipo_cliente'] . "</br>" . "Ultimo pagamento = " . formatardataTela($linha['ultimo_pagamento']) . "</br>";
                    
                }

            }
        }
    }
}

if(isset($estacionamento)){

    if($estacionamento == "ConsultarId"){

        if(isset($id_carro)){

            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));

            if(consultar_id_estacionamento($id_carro)){

                $testeconsultar = consultar_id_carro_cliente($id_carro);

                $qtdlinhas = mysqli_num_rows($testeconsultar);

                if($qtdlinhas == 0){

                    echo "</br>" . "Não existe o dado na tabela";

                }
                else{

                    for($i = 0; $i < $qtdlinhas; $i++){

                        $linha = mysqli_fetch_assoc($testeconsultar);

                        echo "</br>" . "ID carro = " . $linha['id_carro'] . "</br>"
                        . "Data e hora de entrada = " . formatar_data_hora_tela($linha['data_hora_entrada']) . "</br>" . "Tipo de tarifa = "
                        . $linha['tipo_tarifa'] . "</br>" . "Id da loja convêniada = " . $linha['id_convenio'] . "</br>" . "Valor = "
                        . $linha['valor'] . "</br>" . "Data e hora de saida = " . formatar_data_hora_tela($linha['data_hora_saida']) . "</br>" . "Tipo de cliente = "
                        . $linha['tipo_cliente'] . "</br>" . "Ultimo pagamento = " . formatardataTela($linha['ultimo_pagamento']) . "</br>";
                        
                    }
                }
            }
        }
    }
}

if(isset($estacionamento)){

    if($estacionamento == "Alterar"){

        if(isset($id_carro) && isset($ultimo_pagamento)){

            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));
            $ultimo_pagamento = htmlspecialchars_decode(strip_tags($ultimo_pagamento));

            if(validar_data($ultimo_pagamento)){

                if(alterar_estacionamento($ultimo_pagamento, $id_carro)){

                    echo "</br>" . "Alteração bem sucedida";

                }
                else{

                    echo "</br>" . "Alteração mal sucedida";

                }
            }
            else{

                echo "</br>" . "Data invalida";

            }
        }
    }
}

if(isset($estacionamento)){

    if($estacionamento == "Deletar"){

        if(isset($id_carro)){

            $id_carro = htmlspecialchars_decode(strip_tags($id_carro));

            if(deletar_estacionamento($id_carro)){

                echo "</br>" . "O registro foi deletado";

            }
            else{

                echo "</br>" . "O registro não foi deletado";

            }
        }
    }
}

?>