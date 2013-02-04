<?php
include 'menu.php';
include 'conexao.php';

$alterar_marcada= $_GET['alterar_marcada'];

if ($alterar_marcada != "") {

    $alterar_dt_marcada = "DELETE FROM tab_reciclagens WHERE num_id_colaborador = $alterar_marcada";

    mysql_query($alterar_dt_marcada);

    $dt_marcada_alterar = "ok";
}

$desmarcar = $_GET['desmarcar'];

if ($desmarcar != "") {

    $desmarcar_marcada = "DELETE FROM tab_reciclagens WHERE num_id_colaborador = $desmarcar";

    mysql_query($desmarcar_marcada);

    $desmarcar_rec = "UPDATE tab_colaborador SET num_marcada = '0' WHERE id_colaborador = $desmarcar";

    mysql_query($desmarcar_rec);

    $desmarcado = "ok";
}

$data_marcada = $_POST['data_marcada'];

if ($data_marcada != "") {

    $dt_in_nova = $_POST['dt_in_nova'];
    $dt_fin_nova = $_POST['dt_fin_nova'];
    $academia = $_POST['academia'];

    $dt_in_nova_en = DataEn($dt_in_nova);
    $dt_fin_nova_en = DataEn($dt_fin_nova);

    $inserir_marcada = "INSERT INTO tab_reciclagens (num_id_colaborador, dt_in_nova, dt_fim_nova, str_academia) VALUES ('$data_marcada', '$dt_in_nova_en',
    '$dt_fin_nova_en', '$academia')";

    mysql_query($inserir_marcada);
}

$alterardata_rec = $_POST['alterardata_rec'];

if ($alterardata_rec != ""){

    $dt_in_nova_rec = $_POST['dt_in_nova_rec'];
    $dt_fin_nova_rec = $_POST['dt_fin_nova_rec'];
    $dt_previsao_rec = SomarData($dt_fin_nova_rec, 0, -2, 2);

    $dt_in_nova_rec_en = DataEn($dt_in_nova_rec);
    $dt_fin_nova_rec_en = DataEn($dt_fin_nova_rec);
    $dt_previsao_rec_en = DataEn($dt_previsao_rec);

    $update_alterardatarec = "UPDATE tab_colaborador SET dt_inicial = '$dt_in_nova_rec_en', dt_final = '$dt_fin_nova_rec_en', dt_previsao = '$dt_previsao_rec_en', num_marcada = '0', num_certificado = '1' WHERE id_colaborador = $alterardata_rec";
    mysql_query($update_alterardatarec);

    $delete_alterardatarec = "DELETE FROM tab_reciclagens WHERE num_id_colaborador = $alterardata_rec";
    mysql_query($delete_alterardatarec);

    $alteradodata_rec = "ok";
}
?>
<div id="conteudo">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
     <?php
     if ($dt_marcada_alterar == "ok") {
     ?>
    <div id="aviso_ok">
        Você pode Alterar a Data da Reciclagens Agora!
    </div>
    <br><br>
    <?php
    }
   if ($desmarcado == "ok") {
     ?>
    <div id="aviso_ok">
        Reciclagem do Colaborador foi Desmarcada!
    </div>
    <br><br>
    <?php
    }
    if ($alteradodata_rec == "ok") {
    ?>
    <div id="aviso_ok">
        Colaborador já fez a Reciclagem, Data Atualizada!
    </div>
    <br><br>
    <?php
    }
    ?>
    <legend>Reciclagens Marcadas</legend>
    <br>
    <tr>
        <th align="center">
            Nome
        </th>
        <th align="center">
            Cidade
        </th>
        <th align="center">
            Dt. Fin. Reciclagem
        </th>
        <th align="center">
            Previs&atilde;o
        </th>
        <th align="center">
            Data Marcada
        </th>
        <th align="center">
            Academia
        </th>
        <th align="center">
            A&ccedil;&otilde;es
        </th>
    </tr>
    
    <?php
    $sel_colab = "SELECT * FROM tab_colaborador WHERE num_marcada = '1' AND num_ativo = '1' ORDER BY dt_previsao ASC";
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
            <?php
            $alterardatarec = $_GET['alterardatarec'];
            if ($alterardatarec != $sel_colab['id_colaborador']) {
            ?>
            <p class="texto"><?php echo DataBr($sel_colab['dt_final']); ?></p>
            <?php
            }else{
            ?>
            <form action="rec_marcadas.php" method="POST">
            <p class="texto">
            <input type="text" name="dt_in_nova_rec" size="9" maxlength="10" onKeyPress="DataHora(event, this);">&nbsp;
            <input type="text" name="dt_fin_nova_rec" size="9" maxlength="10" onKeyPress="DataHora(event, this);">
            <input type="hidden" name="alterardata_rec" value="<?php echo $sel_colab['id_colaborador']; ?>">
            <input type="submit" value="OK">
            </p>
            </form>
            <?php
            }
            ?>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <p class="texto"><?php echo Previsao(DataBr($sel_colab['dt_previsao'])); ?></p>
        </td>
        <?php

        $id_colaborador = $sel_colab['id_colaborador'];
        
        $verif_marcada = "SELECT num_id_colaborador FROM tab_reciclagens WHERE num_id_colaborador = $id_colaborador";
        $ex_verif_marcada = mysql_query($verif_marcada);

        if (mysql_num_rows($ex_verif_marcada) > 0) {
            
            $sel_reciclagens = "SELECT * FROM tab_reciclagens WHERE num_id_colaborador = $id_colaborador";
            $ex_sel_reciclagens = mysql_query($sel_reciclagens);
            $sel_reciclagens = mysql_fetch_array($ex_sel_reciclagens);
        ?>
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <font size="1" color="blue"><b><?php echo DataBr($sel_reciclagens['dt_in_nova']) . "&nbsp;&agrave;&nbsp;" . DataBr($sel_reciclagens['dt_fim_nova']); ?></b></font>
        </td>
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <p class="texto"><?php echo $sel_reciclagens['str_academia']; ?>
        </td>
        <?php

        }
        else
        {
        ?>
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <form action="rec_marcadas.php" method="POST">
            <p class="texto">
                <input type="text" name="dt_in_nova" size="9" maxlength="10" onKeyPress="DataHora(event, this);">&nbsp;&agrave;&nbsp;
            <input type="text" name="dt_fin_nova" size="9" maxlength="10" onKeyPress="DataHora(event, this);">
            </p>
        </td>
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <select name="academia">
                <option value="">Selecione Academia</option>
				<option value="DEFENSE FRANCA">DEFENSE FRANCA</option>
                <option value="DEFENSE RIBEIR&Atilde;O">DEFENSE RIBEIR&Atilde;O</option>
                <option value="DEFENSE RIO PRETO">DEFENSE RIO PRETO</option>
                <option value="MARAJOX BAURU">MARAJOX BAURU</option>
            </select>
            <input type="hidden" name="data_marcada" value="<?php echo $sel_colab['id_colaborador']; ?>">
            <input type="submit" value="OK">
            </form>
        </td>
        <?php
        }
        ?>
        <td align="center" bgcolor="<?php echo $fundo; ?>">
            <?php
            if (mysql_num_rows($ex_verif_marcada) > 0) {
            ?>
            <a href="rec_marcadas.php?alterar_marcada=<?php echo $id_colaborador; ?>"><img src="img/ico_small_alterarmarcar.png" border="0" title="Alterar Data Marcada de Reciclagem"></a>
            <?php
            }
            ?>
            <a href="rec_marcadas.php?desmarcar=<?php echo $id_colaborador; ?>"><img src="img/ico_small_desmarcar.png" border="0" title="Desmarcar Reciclagem"></a>
            <a href="rec_marcadas.php?alterardatarec=<?php echo $id_colaborador; ?>"><img src="img/ico_small_alterardatarec.png" border="0" title="Cadastrar Data da Nova Reciclagem"></a>
			<?php if ($sel_reciclagens['num_convocacao'] == 0) { ?><a href="convocacao.php?id=<?php echo $id_colaborador; ?>"><img src="img/ico_small_convocacao.png" border=0 title="Imprimir Convoca&ccedil;&atilde;o de Reciclagem"></a><?php }?>
        </td>
    </tr>
    <?php
    $i++;
    }
    ?>
</div>
</table>
<?php
include 'footer.php';
?>
