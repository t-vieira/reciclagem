<?php
include "menu.php";
/*
 * @author tiago
 */
include ("conexao.php");

$cad_posto_ok = $_POST['cad_posto_ok'];

if ($cad_posto_ok == "1"){

    $posto = $_POST['posto'];

    $verif_posto = "SELECT str_posto FROM tab_posto WHERE str_posto = '$posto'";
    $exec_verif_posto = mysql_query($verif_posto);

    if (mysql_num_rows($exec_verif_posto) > 0) {

      $cad_posto = "erro";

    }
    else {

        $inserir_posto = "INSERT INTO tab_posto (str_posto) VALUES ('$posto')";

        mysql_query($inserir_posto) OR DIE ("Não foi possível cadastrar");

        $cad_posto = "cadastrado";

    }

}
?>

<fieldset>
    <legend>Cadastrar Postos de Trabalho</legend>
        <form action="cad_posto.php" method="POST">
            <ol>
                <li>
                    <label name="posto">POSTO:&nbsp;</label>
                    <input type="text" name="posto" size="30" onkeyup="this.value = this.value.toUpperCase();" autofocus>
                </li>
            </ol>
</fieldset>
<div align="center">
    <input type="hidden" name="cad_posto_ok" value="1">
    <input type="submit" value="CADASTRAR POSTO">
</div>
        </form>

<?php
if ($cad_posto == "cadastrado") {
?>
    <div id="aviso_ok">
        Posto Cadastrado com Sucesso!
    </div>
<?php
}
if ($cad_posto == "erro") {
?>
    <div id="aviso_erro">
        Posto já esta Cadastrado. Cadastre Outro!
    </div>
<?php
}
?>
<?php
include ("footer.php");
?>
