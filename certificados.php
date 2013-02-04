<?php
include 'menu.php';
include 'conexao.php';
?>
<table cellpadding="0" cellspacing="0" border="0" width="885">
     <legend>Protocolo de Entrega de Certificado</legend>
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
            A&ccedil;&atilde;o
        </th>
    </tr>
    <?php
    $sel_colab = "SELECT * FROM tab_colaborador WHERE num_ativo = '1' AND num_certificado = '1' ORDER BY str_nome ASC";
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
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <a href="protocolo_certificado.php?protocolo=<?php echo $sel_colab['id_colaborador']; ?>"><img src="img/ico_small_convocacao.png" border="0" title="Protocolo de Entrega de Certificado"></a>
        </td>
    </tr>
    <?php
    $i++;
    }
    ?>
</table>
</div>
<?php
include 'footer.php';
?>