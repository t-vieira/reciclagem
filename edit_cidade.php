<?php
include 'menu.php';
include 'conexao.php';

$deletar = $_GET['deletar'];

if ($deletar != "") {

    $deletar_cidade = "DELETE FROM tab_cidade WHERE id_cidade = '$deletar'";

    mysql_query($deletar_cidade);

    $del_cidade = "ok";
}
?>
<div id="conteudo">
<table cellpadding="0" cellspacing="0" border="0" width="700">
     <?php
     if ($del_cidade == "ok") {
     ?>
    <div id="aviso_ok">
        Cidade Deletada com Sucesso!
    </div>
    <br><br>
    <?php
    }
    ?>
    <legend>Editar Cidade</legend>
    <br>
    <?php
    $sel_cidades = "SELECT * FROM tab_cidade ORDER BY str_cidade ASC";
    $rec_sel_cidades = mysql_query($sel_cidades);

    $i = "1";
    while ($sel_cidades = mysql_fetch_array($rec_sel_cidades)) {
        
        if (($i % 2) == 1) { $fundo = $fundo1; } else { $fundo = $fundo2; }
    ?>
    <tr>
        <td bgcolor="<?php echo $fundo; ?>">
            <p class="texto">&nbsp;<?php echo $sel_cidades['str_cidade']; ?></p>
        </td>
        <td bgcolor="<?php echo $fundo; ?>" align="center">
            <a href="edit_cidade.php?deletar=<?php echo $sel_cidades['id_cidade']; ?>"><img src="img/ico_deletar.png" border="0" title="Deletar Cidade"></a>
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
