<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style.css" />
</HEAD>
<BODY>
<?php
include "conexao.php";

Function DataBr ($data) {

    $data = substr($data,8,2) . "/" . substr($data,5,2) . "/" . substr($data,0,4);
    return $data;
}

$exibir_relatorio = $_GET['data'];

if ($exibir_relatorio != "") {

	$data_relatorio = $exibir_relatorio;

	$ex_data_relatorio = explode("/", $data_relatorio);

	$data_consultar_1 = $ex_data_relatorio[1] . "-" . $ex_data_relatorio[0] . "-" . "01";

	$data_consultar_2 = $ex_data_relatorio[1] . "-" . $ex_data_relatorio[0] . "-" . "31";

	$consultar_data = "SELECT * FROM tab_reciclagens WHERE dt_in_nova BETWEEN '$data_consultar_1' AND '$data_consultar_2' ORDER BY dt_in_nova";
	$exec_consultar_data = mysql_query($consultar_data);
	
	$contador = mysql_num_rows($exec_consultar_data);
	
	if (mysql_num_rows($exec_consultar_data) > 0) {
?>
<table width="100%">
	<legend>Coberturas de Reciclagens do Mês <?php echo $exibir_relatorio; ?></legend>
	<br>
	<?php echo "<font face=verdana size=1>&nbsp;&nbsp;Total de <b>" . $contador . "</b> vigilantes.<br><br>"; ?>
    <tr>
        <th align="center">
            DRT
        </th>
        <th align="center">
            Nome
        </th>
        <th align="center">
            Cidade
        </th>
        <th align="center">
            Posto
        </th>
        <th align="center">
            Data da Reciclagem
        </th>
        <th align="center">
            Academia
        </th>
		<th align="center">
			Valor
		</th>
    </tr>
    <?php
    $i = "1";
	$valor_total_reciclagem = 0;
    while ($consultar_data = mysql_fetch_array($exec_consultar_data)) {
        
        $id_consulta_rec = $consultar_data['num_id_colaborador'];

        $id_consulta = "SELECT * FROM tab_colaborador WHERE id_colaborador = $id_consulta_rec";
        $exec_id_consulta = mysql_query($id_consulta);
        $id_consulta = mysql_fetch_array($exec_id_consulta);

        if (($i % 2) == 1) { $fundo = $fundo1; } else { $fundo = $fundo2; }
    ?>
    <tr>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto"><?php echo $id_consulta['num_drt']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto">&nbsp;<?php echo $id_consulta['str_nome']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <?php
            $numero_cidade = $id_consulta['num_id_cidade'];
            $rec_cidade = "SELECT * FROM tab_cidade WHERE id_cidade = '$numero_cidade'";
            $exec_rec_cidade = mysql_query($rec_cidade);
            $rec_cidade = mysql_fetch_array($exec_rec_cidade);
            ?>
            <p class="texto"><?php echo $rec_cidade['str_cidade']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <?php
            $numero_posto = $id_consulta['num_id_posto'];
            $rec_numero_posto = "SELECT * FROM tab_posto WHERE id_posto = $numero_posto";
            $exec_numero_posto = mysql_query($rec_numero_posto);
            $rec_numero_posto = mysql_fetch_array($exec_numero_posto);
            ?>
            <p class="texto"><?php echo $rec_numero_posto['str_posto']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <?php
            $data_rec_marcada = "SELECT * FROM tab_reciclagens WHERE num_id_colaborador = $id_consulta_rec";
            $exec_data_rec_marcada = mysql_query($data_rec_marcada);
            $data_rec_marcada = mysql_fetch_array($exec_data_rec_marcada);
            ?>
            <p class="texto"><?php echo DataBr($data_rec_marcada['dt_in_nova']) . "&nbsp;&agrave;&nbsp;" . DataBr($data_rec_marcada['dt_fim_nova']); ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto">
            <?php echo $numero_academia = $consultar_data['str_academia']; ?></p>
        </td>
		<td bgcolor="<?php echo $fundo; ?>" align="center">
			<?php
			$str_academia = $consultar_data['str_academia'];
			$rs_valor_reciclagem = mysql_query("SELECT * FROM tab_academia WHERE str_academia = '$str_academia'");
			$valor_reciclagem = mysql_fetch_array($rs_valor_reciclagem);
			$valor_cidade = $rec_cidade['str_cidade'];
			if ($valor_cidade == "RIBEIRÃO PRETO" OR $valor_cidade == "FRANCA") {
				echo "<p class=texto>" . $valor_reciclagem['dec_valor_s_alojamento'] . ",00</p>";
				$valor_total_reciclagem += $valor_reciclagem['dec_valor_s_alojamento'];
			} else {
				echo "<p class=texto>" . $valor_reciclagem['dec_valor_c_alojamento'] . ",00</p>";
				$valor_total_reciclagem += $valor_reciclagem['dec_valor_c_alojamento'];
			}
			?>
		</td>
    </tr>
    <?php
    $i++;
    }
	?>
	<tr>
		<th colspan=7>
			VALOR TOTAL
		</th>
	</tr>
	<tr>
		<td colspan=7 align="center">
			<font size="5">R$ <?php echo number_format($valor_total_reciclagem, 2, ',', '.'); ?></font>
		</td>
	</tr>
	<tr>
		<td colspan=7 align=center>
			<a href="rel_reciclagens.php">Voltar</a>
		</td>
	</tr>
	<?php
        }else{

     
        }
    }
    ?>
</table>
</BODY>