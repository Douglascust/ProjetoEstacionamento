<?php
include_once('funcao_cadastro.php');
include_once('conexao.php');
extract($_REQUEST, EXTR_SKIP);
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

if (isset($acao)) {
    if ($acao == "consultar cadastro") {
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

?>