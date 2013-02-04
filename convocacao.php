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
<title>Convocação de Reciclagem</title>
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
			<h2><u>Convocação de Reciclagem</u></h2>
		</td>
	</tr>
	<tr>
		<td height=30></td>
	</tr>
	<tr>
		<td>
			<font size=2>
			<p align=justify>
			Data de Emissão: <?php echo date("d / m / Y"); ?><br>
			
			Nome: <b><?php echo $selec_colaborador['str_nome']; ?></b><br>
			
			DRT: <b><?php echo $selec_colaborador['num_drt']; ?></b> - Posto/Seção: 
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
			
			<!-- DEFENSE EM RIBEIRÃO PRETO -->
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIBEIRÃO") {?>Comparecer ao Escritório Regional, na cidade de Ribeirão Preto - Rua Hemínio Morandini, 400 - Jardim Mosteiro - Ribeirão
			Preto - Telefone (16) 3979-5575, no dia <b><?php echo SomarData(DataBr($selec_reciclagem['dt_in_nova']),-1,0,0); ?></b>, às <b>08:00h</b>.
			<br><?php }?>
			
			<!-- DEFENSE DE RIO PRETO -->
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIO PRETO") {?>Comparecer na Academia, na cidade de <b>São José do Rio Preto - Rua Capitão
			Faustino de Almeida, 262 - Parque Industrial - São José do Rio Preto/SP.</b><br>
			Telefone (17) 3235-6868, no dia <b><?php echo DataBr($selec_reciclagem['dt_in_nova']);?></b> &agrave;s <b>08:00h</b>.<br><?php }?>
			
			<!-- DEFENSE DE FRANCA -->
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE FRANCA") {?>Comparecer na Academia, na cidade de <b>Franca - Av. Alberto Publicano, 4463 - Distrito Industrial - 
			Franca/SP.</b><br>
			Telefone (16) 3701-6668, no dia <b><?php echo DataBr($selec_reciclagem['dt_in_nova']);?></b> &agrave;s <b>07:00h</b>.<br><?php }?>
			
			<!-- MARAJOX -->
			<?php if ($selec_reciclagem['str_academia'] == "MARAJOX BAURU") {?>Comparecer na Academia, na cidade de <b>Bauru - Rua Inconfidência, 6-38 - Jardim Santana 
			- Bauru</b>.<br>
			Telefone (14) 3232-7965, no dia <b><?php echo DataBr($selec_reciclagem['dt_in_nova']);?></b> às <b>07:00h</b>.<br><?php }?>
			
			O curso será realizado no período de <b><?php echo DataBr($selec_reciclagem['dt_in_nova']) . " &agrave; " . DataBr($selec_reciclagem['dt_fim_nova']);?></b>, na academia <b><?php echo $selec_reciclagem['str_academia'];?></b>.<br>
			
			<b><u>LEVAR ROUPA DE CAMA, POIS O ALOJAMENTO NÃO FORNECE.</u></b>
			
			<div align=center><h3><u>NÃO SERÁ MAIS REEMBOLSADO COMBUSTÍVEL, SOMENTE PASSAGEM DE ÔNIBUS.</u></h3></div>
			
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border=1 style="border: 1px solid #000; font-size:13px;">
				<tr>
					<td align=center>
						<b>DOCUMENTOS - CÓPIAS SIMPLES</b>
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
						Comprovante de Residência
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
						Título de Eleitor
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
						Certificado de Reservista ou de Dispensa de Incorporação
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
						Certificado de Formação (FRENTE E VERSO)
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
						Certificado da Última Reciclagem (FRENTE E VERSO)
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
						Carteira de Trabalho (Original para Atualização)
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
						Foto 3x4 (Confecção de Novo Crachá)
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
						Certidão de Quitação Eleitoral (Original) - www.tse.gov.br
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
						Certidão de Condenação Criminal Eleitoral (Original) - www.tse.gov.br
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
						Certidão Negativa Justiça Estadual Criminal (Fórum Local de Sua Residência)*
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
						Certidão Negativa Justiça Federal - www.jfsp.jus.br
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
						Certidão Negativa Justiça Militar da União - www.stm.jus.br
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
			<font size=1 color=red><b>Não haverá atendimento se a entrega da documentação estiver INCOMPLETA.</b></font><br><br>
			
			<div style="background-color: #ccc; border: 1px solid #000; text-align:center;">INFORMAÇÕES IMPORTANTES</div>
			
			<font size=1>
			- * <b>A Certidão Negativa Justiça Estadual Criminal (Fórum Local de Sua Residência) deve ser solicitada ao 
			Fórum com PELO MENOS 10 (dez) dias de antecedência da data prevista para a reciclagem.</b><br>
			- Trazer os Documentos Originais para Conferência.<br>
			- Esta convocação é irrevogável e condição imprescindível para que sua condição na empresa esteja regularizada.<br>
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIBEIRÃO") {?>- <b>Academia: Av. Bandeirantes, 1.700 – Vila Virgínia – Ribeirão Preto – SP – Fone (16) 3963-1626 / 3963-1679</b><br><?php }?>
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE RIO PRETO") {?>- <b>Academia: Rua Capitão Faustino de Almeida, 262 – Parque Industrial – São José do Rio Preto – SP – Fone (17) 3235-6868</b><br><?php }?>
			<?php if ($selec_reciclagem['str_academia'] == "DEFENSE FRANCA") {?>- <b>Academia: Av. Alberto Publicano, 4463 - Distrito Industrial - Franca - SP – Fone (16) 3701-6668</b><br><?php }?>
			<?php if ($selec_reciclagem['str_academia'] == "MARAJOX BAURU") {?>- <b>Academia: Rua Inconfidência, 6-38 – Jardim Santana – Bauru – SP – Fone (14) 3232-7965</b><br><?php }?>
			- Lembre-se: estar com sua reciclagem e CNV em dia é uma exigência legal, condição obrigatória para exercer a função 
			de Vigilante em todo o território Nacional. Caso esta convocação não seja atendida, nos reservamos no direito de tomar 
			medidas cabíveis.<br><br></font>
			
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