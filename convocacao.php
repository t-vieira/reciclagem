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

$id = $_GET['id'];

$selec_colaborador = "SELECT * FROM tab_colaborador WHERE id_colaborador = $id";
$ex_selec_colaborador = mysql_query($selec_colaborador);
$selec_colaborador = mysql_fetch_array($ex_selec_colaborador);

$selec_reciclagem = "SELECT * FROM tab_reciclagens WHERE num_id_colaborador = $id";
$ex_selec_reciclagem = mysql_query($selec_reciclagem);
$selec_reciclagem = mysql_fetch_array($ex_selec_reciclagem);

$convocacao = "UPDATE tab_reciclagens SET num_convocacao = 1 WHERE num_id_colaborador = $id";
mysql_query($convocacao);
?>
<HTML>
<HEAD>
<title>Convoca��o de Reciclagem</title>
<style>
body {
	font-family: Arial, Tahoma, Verdana;
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
		<td height=40></td>
	</tr>
	<tr>
		<td align=center>
			<h2><u>Convoca��o de Reciclagem</u></h2>
		</td>
	</tr>
	<tr>
		<td height=30></td>
	</tr>
	<tr>
		<td>
			<font size=2>
			<p align=justify>
			Data de Emiss�o: <?php echo date("d / m / Y"); ?><br>
			
			Nome: <b><?php echo $selec_colaborador['str_nome']; ?></b><br>
			
			DRT: <b><?php echo $selec_colaborador['num_drt']; ?></b> - Posto/Se��o: 
			<?php
			$num_id_posto = $selec_colaborador['num_id_posto'];
			$num_id_cidade = $selec_colaborador['num_id_cidade'];
			
			$selec_posto = "SELECT * FROM tab_posto WHERE id_posto = $num_id_posto";
			$ex_selec_posto = mysql_query($selec_posto);
			$selec_posto = mysql_fetch_array($ex_selec_posto);
			
			$selec_cidade = "SELECT * FROM tab_cidade WHERE id_cidade = $num_id_cidade";
			$ex_selec_cidade = mysql_query($selec_cidade);
			$selec_cidade = mysql_fetch_array($ex_selec_cidade);
			
			echo "<b>" . $selec_posto['str_posto'] . " - " . $selec_cidade['str_cidade'] . "</b>";
			?>
			<br>
			
			<!-- DEFENSE EM RIBEIR�O PRETO -->
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIBEIR�O") {?>Comparecer ao Escrit�rio Regional, na cidade de Ribeir�o Preto - Rua Hem�nio Morandini, 400 - Jardim Mosteiro - Ribeir�o
			Preto - Telefone (16) 3979-5575, no dia <b><?php echo SomarData(DataBr($selec_reciclagem['dt_in_nova']),-1,0,0); ?></b>, �s <b>08:00h</b>.
			<br><?php }?>
			
			<!-- DEFENSE DE RIO PRETO -->
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIO PRETO") {?>Comparecer na Academia, na cidade de <b>S�o Jos� do Rio Preto - Rua Capit�o
			Faustino de Almeida, 262 - Parque Industrial - S�o Jos� do Rio Preto/SP.</b><br>
			Telefone (17) 3235-6868, no dia <b><?php echo DataBr($selec_reciclagem['dt_in_nova']);?></b> &agrave;s <b>08:00h</b>.<br><?php }?>
			
			<!-- DEFENSE DE FRANCA -->
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE FRANCA") {?>Comparecer na Academia, na cidade de <b>Franca - Av. Alberto Publicano, 4463 - Distrito Industrial - 
			Franca/SP.</b><br>
			Telefone (16) 3701-6668, no dia <b><?php echo DataBr($selec_reciclagem['dt_in_nova']);?></b> &agrave;s <b>07:00h</b>.<br><?php }?>
			
			<!-- MARAJOX -->
			<?php if ($selec_reciclagem['str_academia'] == "MARAJOX BAURU") {?>Comparecer na Academia, na cidade de <b>Bauru - Rua Inconfid�ncia, 6-38 - Jardim Santana 
			- Bauru</b>.<br>
			Telefone (14) 3232-7965, no dia <b><?php echo DataBr($selec_reciclagem['dt_in_nova']);?></b> �s <b>07:00h</b>.<br><?php }?>
			
			O curso ser� realizado no per�odo de <b><?php echo DataBr($selec_reciclagem['dt_in_nova']) . " &agrave; " . DataBr($selec_reciclagem['dt_fim_nova']);?></b>, na academia <b><?php echo $selec_reciclagem['str_academia'];?></b>.<br>
			
			<b><u>LEVAR ROUPA DE CAMA, POIS O ALOJAMENTO N�O FORNECE.</u></b>
			
			<div align=center><h3><u>N�O SER� MAIS REEMBOLSADO COMBUST�VEL, SOMENTE PASSAGEM DE �NIBUS.</u></h3></div>
			
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border=1 style="border: 1px solid #000; font-size:13px;">
				<tr>
					<td align=center>
						<b>DOCUMENTOS - C�PIAS SIMPLES</b>
					</td>
					<td align=center>
						<b>ACADEMIA</b>
					</td>
					<td align=center>
						<b>ESCRIT.</b>
					</td>
				</tr>
				<tr>
					<td>
						RG
					</td>
					<td align=center>
						02
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						CPF
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Comprovante de Resid�ncia
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						T�tulo de Eleitor
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certificado de Reservista ou de Dispensa de Incorpora��o
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certificado de Forma��o (FRENTE E VERSO)
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certificado da �ltima Reciclagem (FRENTE E VERSO)
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						CNV Original (Carteira Nacional de Vigilante)
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Carteira de Trabalho (Original para Atualiza��o)
					</td>
					<td align=center>
						-
					</td>
					<td align=center>
						X
					</td>
				</tr>
				<tr>
					<td>
						Foto 3x4 (Confec��o de Novo Crach�)
					</td>
					<td align=center>
						-
					</td>
					<td align=center>
						01
					</td>
				</tr>
				<tr>
					<td>
						Antecedentes Criminais (Original) - Poupatempo ou www.ssp.sp.gov.br
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certid�o de Quita��o Eleitoral (Original) - www.tse.gov.br
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certid�o de Condena��o Criminal Eleitoral (Original) - www.tse.gov.br
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certid�o Negativa Justi�a Estadual Criminal (F�rum Local de Sua Resid�ncia)*
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certid�o Negativa Justi�a Federal - www.jfsp.jus.br
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
				<tr>
					<td>
						Certid�o Negativa Justi�a Militar da Uni�o - www.stm.jus.br
					</td>
					<td align=center>
						01
					</td>
					<td align=center>
						-
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<font size=1 color=red><b>N�o haver� atendimento se a entrega da documenta��o estiver INCOMPLETA.</b></font><br><br>
			
			<div style="background-color: #ccc; border: 1px solid #000; text-align:center;">INFORMA��ES IMPORTANTES</div>
			
			<font size=1>
			- * <b>A Certid�o Negativa Justi�a Estadual Criminal (F�rum Local de Sua Resid�ncia) deve ser solicitada ao 
			F�rum com PELO MENOS 10 (dez) dias de anteced�ncia da data prevista para a reciclagem.</b><br>
			- Trazer os Documentos Originais para Confer�ncia.<br>
			- Esta convoca��o � irrevog�vel e condi��o imprescind�vel para que sua condi��o na empresa esteja regularizada.<br>
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIBEIR�O") {?>- <b>Academia: Av. Bandeirantes, 1.700 � Vila Virg�nia � Ribeir�o Preto � SP � Fone (16) 3963-1626 / 3963-1679</b><br><?php }?>
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIO PRETO") {?>- <b>Academia: Rua Capit�o Faustino de Almeida, 262 � Parque Industrial � S�o Jos� do Rio Preto � SP � Fone (17) 3235-6868</b><br><?php }?>
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE FRANCA") {?>- <b>Academia: Av. Alberto Publicano, 4463 - Distrito Industrial - Franca - SP � Fone (16) 3701-6668</b><br><?php }?>
			<?php if ($selec_reciclagem['str_academia'] == "MARAJOX BAURU") {?>- <b>Academia: Rua Inconfid�ncia, 6-38 � Jardim Santana � Bauru � SP � Fone (14) 3232-7965</b><br><?php }?>
			- Lembre-se: estar com sua reciclagem e CNV em dia � uma exig�ncia legal, condi��o obrigat�ria para exercer a fun��o 
			de Vigilante em todo o territ�rio Nacional. Caso esta convoca��o n�o seja atendida, nos reservamos no direito de tomar 
			medidas cab�veis.<br><br></font>
			
			<hr>
			<br>
			<font size=2>Atenciosamente<br><br><br><br><br>
			
			Tiago Esteves Vieira
		</td>
	</tr>
	<tr>
		<td>
			<a href="rec_marcadas.php" style="color:#fff;">Voltar</a>
		</td>
	</tr>
</table>
</BODY>
</HTML>