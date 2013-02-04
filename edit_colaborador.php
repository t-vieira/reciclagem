<?php
include "menu.php";
/*
 * @author tiago
 */
include ("conexao.php");

$edit_colaborador_ok = $_POST['edit_colaborador_ok'];

if ($edit_colaborador_ok != ""){

    $drt = $_POST['drt'];
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];
    $posto = $_POST['posto'];
    $dt_in_rec = $_POST['dt_in_rec'];
    $dt_fin_rec = $_POST['dt_fin_rec'];
    $dt_previsao = SomarData($dt_fin_rec, 0, -2, 2);

    $dt_in_rec_en = DataEn($dt_in_rec);
    $dt_fin_rec_en = DataEn($dt_fin_rec);
    $dt_previsao_en = DataEn($dt_previsao);

    $edit_colab = "UPDATE tab_colaborador SET num_drt = '$drt', str_nome = '$nome', num_id_cidade = '$cidade', num_id_posto = '$posto', dt_inicial = '$dt_in_rec_en', dt_final = '$dt_fin_rec_en', dt_previsao = '$dt_previsao_en' WHERE id_colaborador = $edit_colaborador_ok";
	mysql_query($edit_colab);

    $edit_colab = "editado";

}
?>
<div id="conteudo">
<fieldset>
    <legend>Editar Colaborador</legend>
<?php
$id_colaborador = $_GET['id'];

if ($id_colaborador != "") {
	$selecionar_colab = "SELECT * FROM tab_colaborador WHERE id_colaborador = $id_colaborador";
	$ex_selecionar_colab = mysql_query($selecionar_colab);
	$selecionar_colab = mysql_fetch_array($ex_selecionar_colab);
?>
        <form action="edit_colaborador.php" method="POST" id="cad_colaborador">
            <ol>
                <li>
                    <label name="drt">DRT:&nbsp;</label>
                    <input type="text" name="drt" size="9" onkeyup="this.value = this.value.toUpperCase();" id="drt" maxlength="7" value="<?php echo $selecionar_colab['num_drt']; ?>">
                </li>
                <li>
                    <label name="nome">NOME:&nbsp;</label>
                    <input type="text" name="nome" size="50" onkeyup="this.value = this.value.toUpperCase();" value="<?php echo $selecionar_colab['str_nome']; ?>">
                </li>
                <li>
                    <label name="cidade">CIDADE:&nbsp;</label>
                    <select name="cidade">
                        <option value="">Selecione uma Cidade</option>
                        <?php
                        $buscar_cidade = "SELECT * FROM tab_cidade ORDER BY str_cidade ASC";
                        $ex_buscar_cidade = mysql_query($buscar_cidade);
                        while ($buscar_cidade = mysql_fetch_array($ex_buscar_cidade)){
                        ?>
                        <option value="<?php echo $buscar_cidade['id_cidade']; ?>" <?php if ($selecionar_colab['num_id_cidade'] == $buscar_cidade['id_cidade']) { echo "selected"; }?>><?php echo $buscar_cidade['str_cidade']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label name="posto">POSTO SERVIÇO:&nbsp;</label>
                    <select name="posto">
                        <option value="">Selecione uma Posto</option>
                        <?php
                        $buscar_posto = "SELECT * FROM tab_posto ORDER BY str_posto ASC";
                        $ex_buscar_posto = mysql_query($buscar_posto);
                        while ($buscar_posto = mysql_fetch_array($ex_buscar_posto)){
                        ?>
                        <option value="<?php echo $buscar_posto['id_posto']; ?>" <?php if ($selecionar_colab['num_id_posto'] == $buscar_posto['id_posto']) { echo "selected"; }?>><?php echo $buscar_posto['str_posto']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label name="data_rec_inicial">DATA REC. INICIAL:</label>
                    <input type="text" name="dt_in_rec" size="10" maxlength="10" onKeyPress="DataHora(event, this)" value="<?php echo DataBr($selecionar_colab['dt_inicial']); ?>" />
                </li>
                <li>
                    <label name="data_rec_final">DATA REC. FINAL:</label>
                    <input type="text" name="dt_fin_rec" size="10" maxlength="10" onKeyPress="DataHora(event, this)" value="<?php echo DataBr($selecionar_colab['dt_final']); ?>"/>
                </li>
            </ol>
</fieldset>
<div align="center">
    <input type="hidden" name="edit_colaborador_ok" value="<?php echo $selecionar_colab['id_colaborador']; ?>">
    <input type="submit" value="EDITAR COLABORADOR">
</div>
</form>
<?php
}
?>
<?php
if ($edit_colab == "editado") {
?>
<div id="aviso_ok">
    Colaborador Editado com Sucesso!
</div>
<?php
}
?>
<HR>
<table width=100%>
	<tr>
		<th>
			Nome do Colaborador
		</th>
		<th>
			A&ccedil;&otilde;es
		</th>
	</tr>
	<?php
	$editar_colab = "SELECT * FROM tab_colaborador WHERE num_ativo = 1 ORDER BY str_nome ASC";
	$ex_editar_colab = mysql_query($editar_colab);
	
	while ($editar_colab = mysql_fetch_array($ex_editar_colab)) {
	?>
	<tr>
		<td>
			&nbsp;<?php echo $editar_colab['str_nome']; ?>
		</td>
		<td align=center>
			<a href="edit_colaborador.php?id=<?php echo $editar_colab['id_colaborador']; ?>"><img src="img/ico_small_editcolab.png" border=0 title="Editar Colaborador"></a>
		</td>
	</tr>
	<?php
	}
	?>
</table>
</div>
<?php
include ("footer.php");
?>