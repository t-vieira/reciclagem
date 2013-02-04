<?php
Function SomarData($data, $dias, $meses, $ano) {

    $data = explode("/", $data);
    $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
    return $newData;
}

Function DataEn ($data) {

    $data = substr($data, 6,4) . "-" . substr($data, 3,2) . "-" . substr($data, 0,2);
    return $data;
}

Function DataBr ($data) {

    $data = substr($data,8,2) . "/" . substr($data,5,2) . "/" . substr($data,0,4);
    return $data;
}

Function Previsao ($data) {

    $data = explode("/", $data);

    switch ($data[1]) {

        case 1:
            $data[1] = "Jan";
            break;
        case 2:
            $data[1] = "Fev";
            break;
        case 3:
            $data[1] = "Mar";
            break;
        case 4:
            $data[1] = "Abr";
            break;
        case 5:
            $data[1] = "Mai";
            break;
        case 6:
            $data[1] = "Jun";
            break;
        case 7:
            $data[1] = "Jul";
            break;
        case 8:
            $data[1] = "Ago";
            break;
        case 9:
            $data[1] = "Set";
            break;
        case 10:
            $data[1] = "Out";
            break;
        case 11:
            $data[1] = "Nov";
            break;
        case 12:
            $data[1] = "Dez";
            break;
    }

    return $data[1] . "/" . $data[2];
}

$fundo1 = "#F5F5F5"; //primeira cor de fundo da tabela
$fundo2 = "#F9F9F9"; //segunda cor de fundo da tabela
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Controle de Reciclagens</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
	
	<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
	<!--<script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/validate/jquery.validate.js"></script>-->

    <script language="JavaScript">
        function DataHora (evento, objeto){
            var keypress=(window.event)?event.keyCode:evento.which;
            campo = eval (objeto);
            if (campo.value == '00/00/0000')
            {
                campo.value=""
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;
            if ((caracteres.search(String.fromCharCode (keypress)) != -1) && campo.value.length < (19))
            {
                if (campo.value.length == conjunto1)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
            }
            else
                event.returnValue = false;
        }

</script>
  <body>
      <div id="container">

          <div id="menu">
            <h4 class="cadastro">Cadastros</h4>
            <a href="cad_cidade.php">Cidade</a><br>
            <a href="cad_posto.php"">Postos</a><br>
            <a href="cad_colaborador.php">Colaborador</a>

            <h4 class="controle">Controles</h4>
            <a href="reciclagens.php">Reciclagens para Marcar</a><br>
            <a href="rec_marcadas.php">Reciclagens Marcadas</a><br>
			<a href="certificados.php">Entrega de Certificados</a>

            <h4 class="relatorio">Relat&oacute;rios</h4>
            <a href="rel_reciclagens.php">Reciclagens Marcadas</a><br>
			<a href="rel_reciclagens_ano.php">Reciclagens Anual</a>

            <h4 class="editar">Editar e/ou Excluir</h4>
            <a href="edit_cidade.php">Cidade</a><br>
            <a href="edit_posto.php">Postos</a><br>
            <a href="edit_colaborador.php">Colaborador</a>

            <h4 class="inativo">Inativos</h4>
            <a href="inat_colaborador.php">Colaboradores</a>
        </div>