<?php
include "menu.php";
/* 
 * @author tiago
 */
include ("conexao.php");

$cad_cidade_ok = $_POST['cad_cidade_ok'];

if ($cad_cidade_ok == "1"){
    
    $cidade = $_POST['cidade'];

    $verif_cidade = "SELECT str_cidade FROM tab_cidade WHERE str_cidade = '$cidade'";
    $exec_verif_cidade = mysql_query($verif_cidade);

    if (mysql_num_rows($exec_verif_cidade) > 0) {

      $cad_cidade = "erro";

    }
    else {

        $inserir_cidade = "INSERT INTO tab_cidade (str_cidade) VALUES ('$cidade')";

        mysql_query($inserir_cidade) OR DIE ("Não foi possível cadastrar");

        $cad_cidade = "cadastrado";
        
    }

}
?>
<div id="conteudo">

<fieldset>
    <legend>Cadastrar Cidade</legend>
        <form action="cad_cidade.php" method="POST">
            <ol>
                <li>
                    <label for="cidade">CIDADE:&nbsp;</label>
                    <input type="text" name="cidade" size="30" onkeyup="this.value = this.value.toUpperCase();" autofocus>
                </li>
            </ol>
    </fieldset>

    <div align="center">
    <input type="hidden" name="cad_cidade_ok" value="1">
    <input type="submit" value="CADASTRAR CIDADE">
    </div>
    </form>


    <?php
    if ($cad_cidade == "cadastrado") {
    ?>
    <div id="aviso_ok">
        Cidade Cadastrada com Sucesso!
    </div>
    <?php
    }
    if ($cad_cidade == "erro") {
    ?>
    <div id="aviso_erro">
        Cidade já esta Cadastrada. Cadastre Outra!
    </div>
    <?php
    }
    ?>
</div>
<?php
include ("footer.php");
?>