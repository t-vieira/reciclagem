<?php
include 'menu.php';
include 'conexao.php';

//$marcar = $_GET['marcar'];

//if ($marcar != "") {

//    $marcar_reciclagem = "UPDATE tab_colaborador SET num_marcada = '1' WHERE id_colaborador = '$marcar'";

//    mysql_query($marcar_reciclagem);

//    $marcar_rec = "ok";
//}

//$inativo = $_GET['inativo'];

//if ($inativo != "") {

//    $inativar = "UPDATE tab_colaborador SET num_ativo = '0' WHERE id_colaborador = '$inativo'";

//    mysql_query($inativar);

//    $inativado = "ok";
//}
?>
<div id="conteudo">
<table cellpadding="0" cellspacing="0" border="0" width="885">
    <legend>Relat&oacute;rio de Reciclagens Anual</legend>
        </td>
    </tr>
    <br>
    <tr>
        <td align="center" colspan="6">
            <form action="rel_reciclagens_ano.php" method="post">
            <p class="texto">Escolha o M&ecirc;s e o Ano:
                <input type="text" name="data_relatorio_inicio" size="7">&nbsp;
                de&nbsp;
				<input type="text" name="data_relatorio_fim" size="7">&nbsp;
                (ex. mm/aaaa)&nbsp;
                <input type="hidden" name="exibir_relatorio_anual" value="1">
                <input type="submit" value="Visualizar">
            </form>
        </td>
    </tr>
    <?php
    $exibir_relatorio_anual = $_POST['exibir_relatorio_anual'];
    if ($exibir_relatorio_anual != "") {

        $data_relatorio_inicio = $_POST['data_relatorio_inicio'];
		$data_relatorio_fim = $_POST['data_relatorio_fim'];
		
		//$data_relatorio_en = substr($data_relatorio, 6,4) . "-" . substr($data_relatorio, 3,2);

        $ex_data_relatorio_inicio = explode("/", $data_relatorio_inicio);
		$ex_data_relatorio_fim = explode("/", $data_relatorio_fim);

        $data_consultar_inicio = $ex_data_relatorio_inicio[1] . "-" . $ex_data_relatorio_inicio[0] . "-" . "01";

        $data_consultar_fim = $ex_data_relatorio_fim[1] . "-" . $ex_data_relatorio_fim[0] . "-" . "31";
		
		$consultar_data = "SELECT * FROM tab_colaborador WHERE dt_previsao BETWEEN '$data_consultar_inicio' AND '$data_consultar_fim' AND num_ativo = '1' ORDER BY dt_previsao";
        $exec_consultar_data = mysql_query($consultar_data);

        if (mysql_num_rows($exec_consultar_data) > 0) {
    ?>
    <tr>
		<th align="center">
			N.
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
			Previsão
		</th>
    </tr>
    <?php
    $i = "1";
    while ($consultar_data = mysql_fetch_array($exec_consultar_data)) {
        
        if (($i % 2) == 1) { $fundo = $fundo1; } else { $fundo = $fundo2; }
    ?>
    <tr>
		<td bgcolor="<?php echo $fundo; ?>" align="center">
			<b><p class="texto"><?php echo $i;?></p></b>
		</td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto">&nbsp;<?php echo $consultar_data['str_nome']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <?php
            $numero_cidade = $consultar_data['num_id_cidade'];
            $rec_cidade = "SELECT * FROM tab_cidade WHERE id_cidade = '$numero_cidade'";
            $exec_rec_cidade = mysql_query($rec_cidade);
            $rec_cidade = mysql_fetch_array($exec_rec_cidade);
            ?>
            <p class="texto"><?php echo $rec_cidade['str_cidade']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <?php
            $numero_posto = $consultar_data['num_id_posto'];
            $rec_numero_posto = "SELECT * FROM tab_posto WHERE id_posto = $numero_posto";
            $exec_numero_posto = mysql_query($rec_numero_posto);
            $rec_numero_posto = mysql_fetch_array($exec_numero_posto);
            ?>
            <p class="texto"><?php echo $rec_numero_posto['str_posto']; ?></p>
        </td>
		<td bgcolor="<?php echo $fundo; ?>" align="center">
			<p class="texto"><?php echo Previsao(DataBr($consultar_data['dt_previsao']))?></p>
		</td>
    </tr>
    <?php
    $i++;
    }
		}else{

     
        }
    }
    ?>
</table>
</div>
<?php
include 'footer.php';
?>