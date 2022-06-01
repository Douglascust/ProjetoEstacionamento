<?php

//////////////// data ////////////////

function validar_data($data)
{
    $v = explode("/", $data);
    if (count($v) == 3) {
        $result = checkdate($v[1], $v[0], $v[2]);
        return $result;
    }
}

function formatardataBancoEnvio($data)
{
    $v = explode("/", $data);
    $dataBanco = $v[2] . '-' . $v[1] . '-' . $v[0];
    return $dataBanco;
}

function formatardataTela($data)
{
    $v = explode('-', $data);
    $dataTela = $v[2] . '/' . $v[1] . '/' . $v[0];
    return $dataTela;
}

//////////////// hora ////////////////

function validar_hora($hora, $formato = 'H:i:s'){

    $d = DateTime::createFromFormat($formato, $hora);
    return $d && $d->format($formato) == $hora;

}

//////////////// data e hora ////////////////

function validar_data_hora($data, $formato = 'd/m/Y H:i:s'){

    $d = DateTime::createFromFormat($formato, $data);
    return $d && $d->format($formato) == $data;

}
	
function formatar_data_hora_banco($data) {
 
    $v = str_replace('/', '-', $data);  
    $data_hora_banco = date("Y-m-d H:i:s", strtotime($v));
    return $data_hora_banco;
}

function formatar_data_hora_tela($data) {
 
    $v = str_replace('-', '/', $data);  
    $data_hora_banco = date("d/m/Y H:i:s", strtotime($v));
    return $data_hora_banco;
}