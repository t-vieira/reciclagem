<?php
include "menu.php";
include "conexao.php";

$id_inativo = $_GET['id'];

if ($id_inativo != "") {
	
	$edit_inativo = "UPDATE tab_colaborador SET num_ativo = 1 WHERE id_colaborador = '$id_inativo'";
	mysql_query($edit_inativo);
	
	$reativar = "reativado";
}
?>
<div id="conteudo">
<?php
if ($reativar == "reativado") {
?>
<div id="aviso_ok">
	Colaborador Reativado (Admitido) com Sucesso!
</div>
<br><br>
<?php
}
?>
<table width="100%">
	<legend>Colaboradores Inativos</legend>
	<br>
	<tr>
		<th>
			Colaborador
		</th>
		<th>
			A&ccedil;&otilde;es
		</th>
	</tr>
	<?php
	$buscar_inativos = "SELECT * FROM tab_colaborador WHERE num_ativo = 0 ORDER BY str_nome ASC";
	$ex_buscar_inativos = mysql_query($buscar_inativos);
	while ($buscar_inativos = mysql_fetch_array($ex_buscar_inativos)) {
	?>
	<tr>
		<td>
			&nbsp;<?php echo $buscar_inativos['str_nome']; ?>
		</td>
		<td align=center>
			<a href="?id=<?php echo $buscar_inativos['id_colaborador']; ?>"><img src="img/ico_small_reativar.png" border=0 title="Reativar Colaborador"></a>
		</td>
	</tr>
	<?php
	}
	?>
</table>
</div>