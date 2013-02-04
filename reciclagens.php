<?php
include 'menu.php';
include 'conexao.php';

$marcar = $_GET['marcar'];

if ($marcar != "") {

    $marcar_reciclagem = "UPDATE tab_colaborador SET num_marcada = '1' WHERE id_colaborador = '$marcar'";

    mysql_query($marcar_reciclagem);

    $marcar_rec = "ok";
}

$inativo = $_GET['inativo'];

if ($inativo != "") {

    $inativar = "UPDATE tab_colaborador SET num_ativo = '0' WHERE id_colaborador = '$inativo'";

    mysql_query($inativar);

    $inativado = "ok";
}
?>
<table cellpadding="0" cellspacing="0" border="0" width="885">
     <?php
     if ($marcar_rec == "ok") {
     ?>
    <div id="aviso_ok">
        Reciclagem Enviada para os Marcados!
    </div>
    <br><br>
    <?php
    }
   if ($inativado == "ok") {
     ?>
    <div id="aviso_ok">
        Colaborador está no Inativos (Demitidos) Agora!
    </div>
    <br><br>
    <?php
    }
    ?>
    <legend>Controle de Reciclagens</legend>
    <br>
    <tr>
        <th align="center">
            Nome
        </th>
        <th align="center">
            Cidade
        </th>
        <th align="center">
            Dt. In. Reciclagem
        </th>
        <th align="center">
            Dt. Fin. Reciclagem
        </th>
        <th align="center">
            Previs&atilde;o
        </th>
        <th align="center">
            A&ccedil;&otilde;es
        </th>
    </tr>
	<tbody>
    <?php
    $sel_colab = "SELECT * FROM tab_colaborador WHERE num_marcada = '0' AND num_ativo = '1' ORDER BY dt_previsao ASC";
    $rec_sel_colab = mysql_query($sel_colab);
	
	$contador = mysql_num_rows($rec_sel_colab);
	
	echo "<font face=verdana size=1>&nbsp;&nbsp;Total de <b>" . $contador . "</b> vigilantes.<br><br>";

    $i = "1";
    while ($sel_colab = mysql_fetch_array($rec_sel_colab)) {

        if (($i % 2) == 1) { $fundo = $fundo1; } else { $fundo = $fundo2; }
    ?>
    <tr>
        <td bgcolor="<?php echo $fundo; ?>">
            <p class="texto">&nbsp;<?php echo $sel_colab['str_nome']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <?php
            $numero_cidade = $sel_colab['num_id_cidade'];
            $rec_cidade = "SELECT * FROM tab_cidade WHERE id_cidade = '$numero_cidade'";
            $exec_rec_cidade = mysql_query($rec_cidade);
            $rec_cidade = mysql_fetch_array($exec_rec_cidade);
            ?>
            <p class="texto"><?php echo $rec_cidade['str_cidade']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto"><?php echo DataBr($sel_colab['dt_inicial']); ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto"><?php echo DataBr($sel_colab['dt_final']); ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <b><?php echo Previsao(DataBr($sel_colab['dt_previsao'])); ?></b>
        </td>
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <a href="reciclagens.php?marcar=<?php echo $sel_colab['id_colaborador']; ?>"><img src="img/ico_small_marcar.png" border="0" title="Marcar Data de Reciclagem"></a>
            <a href="reciclagens.php?inativo=<?php echo $sel_colab['id_colaborador']; ?>"><img src="img/ico_small_inativo.png" border="0" title="Inativar Colaborador"></a>
        </td>
    </tr>
    <?php
    $i++;
    }
    ?>
	</tbody>
</table>
</div>
<?php
include 'footer.php';
?>