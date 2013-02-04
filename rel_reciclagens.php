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
    <legend>Relat&oacute;rio de Reciclagens Marcadas</legend>
        </td>
    </tr>
    <br>
    <tr>
        <td align="center" colspan="6">
            <form action="rel_reciclagens.php" method="post">
            <p class="texto">Escolha o M&ecirc;s e o Ano:
                <input type="text" name="data_relatorio" size="7">&nbsp;
                (ex. mm/aaaa)&nbsp;
                <input type="hidden" name="exibir_relatorio" value="1">
                <input type="submit" value="Visualizar">
            </form>
        </td>
    </tr>
    <?php
    $exibir_relatorio = $_POST['exibir_relatorio'];
    if ($exibir_relatorio != "") {

        $data_relatorio = $_POST['data_relatorio'];

        //$data_relatorio_en = substr($data_relatorio, 6,4) . "-" . substr($data_relatorio, 3,2);

        $ex_data_relatorio = explode("/", $data_relatorio);

        $data_consultar_1 = $ex_data_relatorio[1] . "-" . $ex_data_relatorio[0] . "-" . "01";
		
		$data_consultar_2 = $ex_data_relatorio[1] . "-" . $ex_data_relatorio[0] . "-" . "31";

        $consultar_data = "SELECT * FROM tab_reciclagens WHERE dt_in_nova BETWEEN '$data_consultar_1' AND '$data_consultar_2' ORDER BY dt_in_nova";
        $exec_consultar_data = mysql_query($consultar_data);
		
		if (mysql_num_rows($exec_consultar_data) > 0) {
    ?>
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
    </tr>
    <?php
    $i = "1";
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
    </tr>
    <?php
    $i++;
    }
	?>
	<tr>
		<td colspan=6 align=center>
			<a href="rel_cobertura.php?data=<?php echo $data_relatorio; ?>">Imprimir Cobertura</a>
		</td>
	</tr>
	<?php
        }else{

     
        }
    }
    ?>
</table>
</div>
<?php
include 'footer.php';
?>