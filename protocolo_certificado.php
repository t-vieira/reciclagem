<?php
include "conexao.php";

Function SomarData($data, $dias, $meses, $ano) {

    $data = explode("/", $data);
    $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
    return $newData;
}

Function DataBr ($data) {

    $data = substr($data,8,2) . "/" . substr($data,5,2) . "/" . substr($data,0,4);
    return $data;
}

$id = $_GET['protocolo'];

$selec_colaborador = "SELECT * FROM tab_colaborador WHERE id_colaborador = $id";
$ex_selec_colaborador = mysql_query($selec_colaborador);
$selec_colaborador = mysql_fetch_array($ex_selec_colaborador);

$selec_reciclagem = "SELECT * FROM tab_reciclagens WHERE num_id_colaborador = $id";
$ex_selec_reciclagem = mysql_query($selec_reciclagem);
$selec_reciclagem = mysql_fetch_array($ex_selec_reciclagem);

$protocolo = "UPDATE tab_colaborador SET num_certificado = '0' WHERE id_colaborador = $id";
mysql_query($protocolo);
?>
<HTML>
<HEAD>
<title>Protocolo de Certificado de Reciclagem</title>
<style>
body {
	font-family: Tahoma, Arial, Verdana;
}

</style>
</HEAD>
<BODY>
<table cellpadding=0 cellspacing=0 border=0 width=720>
	<tr>
		<td align=right>
			<img src="img/logotipo.jpg" border=0><br>
		</td>
	</tr>
	<tr>
		<td height=100></td>
	</tr>
	<tr>
		<td align=center>
			<h2><u>NOME DA EMPRESA DE VIGILANCIA LTDA</u></h2>
		</td>
	</tr>
	<tr>
		<td height=80></td>
	</tr>
	<tr>
		<td>
			<font size=3>
			<p align=justify>
			<?php
			$num_id_cidade = $selec_colaborador['num_id_cidade'];
			
			$selec_cidade = "SELECT * FROM tab_cidade WHERE id_cidade = $num_id_cidade";
			$ex_selec_cidade = mysql_query($selec_cidade);
			$selec_cidade = mysql_fetch_array($ex_selec_cidade);
			
			echo "<b>" . $selec_cidade['str_cidade'] . ", _______ de _______________________ de _________.</b>";
			?>
			
			<br><br><br><br><br>
			
			Eu <b><?php echo $selec_colaborador['str_nome']; ?></b>, DRT <b><?php echo $selec_colaborador['num_drt']; ?></b>, 
			funcionário da empresa <b>EMPRESA TAL DE SERGURANÇA DE VIGILANCIA LTDA</b>, declaro ter recebido neste ato o original do Certificado
			de Reciclagem do Curso de Formação de Vigilante realizado pela <b>DEFENSE - Centro de Forma&ccedil;&atilde;o e Reciclagem 
			de Vigilantes Ltda.</b>, no período de <b><?php echo DataBr($selec_colaborador['dt_inicial']); ?></b> à <b><?php echo DataBr($selec_colaborador['dt_final']); ?></b>.<br><br>
			
			Outrossim, estou ciente que conforme cláusula 26a./1998 da Convenção Coletiva do Trabalho, caso venha a desligar-me
			espontaneamente da empresa antes de completar 06 (seis) meses, terei que reembolsar o valor proporcional ao tempo 
			complementar em referência.
			
			<br><br><br><br><br><br><br><br>
			Sem mais,
			<br><br><br><br><br><br><br><br>
			
			
			________________________________________<br>
			<b><?php echo $selec_colaborador['str_nome']; ?></b><br>
			DRT: <b><?php echo $selec_colaborador['num_drt']; ?></b>
			
		</td>
	</tr>
	<tr>
		<td>
			<a href="certificados.php" style="color:#fff;">Voltar</a>
		</td>
	</tr>
</table>
</BODY>
</HTML>