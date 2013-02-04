<?php
include 'menu.php';
include 'conexao.php';

$deletar = $_GET['deletar'];

if ($deletar != "") {

    $deletar_posto = "DELETE FROM tab_posto WHERE id_posto = '$deletar'";

    mysql_query($deletar_posto);

    $del_posto = "ok";
}
?>
<div id="conteudo">
<table cellpadding="0" cellspacing="0" border="0" width="700">
     <?php
     if ($del_posto == "ok") {
     ?>
    <div id="aviso_ok">
        Posto de Trabalho Deletado com Sucesso!
    </div>
    <br><br>
    <?php
    }
    ?>
    <legend>Editar Postos de Trabalho</legend>
    <br>
    <?php
    $sel_posto = "SELECT * FROM tab_posto ORDER BY str_posto ASC";
    $rec_sel_posto = mysql_query($sel_posto);

    $i = "1";
    while ($sel_posto = mysql_fetch_array($rec_sel_posto)) {

        if (($i % 2) == 1) { $fundo = $fundo1; } else { $fundo = $fundo2; }
    ?>
    <tr>
        <td bgcolor="<?php echo $fundo; ?>">
            <p class="texto">&nbsp;<?php echo $sel_posto['str_posto']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <a href="edit_posto.php?deletar=<?php echo $sel_posto['id_posto']; ?>"><img src="img/ico_deletar.png" border="0" title="Deletar Posto de Trabalho"></a>
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
