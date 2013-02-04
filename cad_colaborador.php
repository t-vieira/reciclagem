<?php
include "menu.php";
/*
 * @author tiago
 */
include ("conexao.php");

$cad_colaborador_ok = $_POST['cad_colaborador_ok'];

if ($cad_colaborador_ok == "1"){

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

    $verif_colab = "SELECT str_nome FROM tab_colaborador WHERE str_nome = '$nome'";
    $exec_verif_colab = mysql_query($verif_colab);

    if (mysql_num_rows($exec_verif_colab) > 0) {

      $cad_colab = "erro";

    }
    else {

        $inserir_colab = "INSERT INTO tab_colaborador (num_drt, str_nome, num_id_cidade, num_id_posto, dt_inicial, dt_final, dt_previsao, num_marcada, num_ativo, num_certificado)
        VALUES ('$drt', '$nome', '$cidade', '$posto', '$dt_in_rec_en', '$dt_fin_rec_en', '$dt_previsao_en', '0', '1', '0')";

        mysql_query($inserir_colab) OR DIE ("Não foi possível cadastrar");

        $cad_colab = "cadastrado";

    }

}
?>

<div id="conteudo">
<fieldset>
    <legend>Cadastrar Colaborador</legend>
        <form action="cad_colaborador.php" method="POST" id="cad_colaborador">
            <ol>
                <li>
                    <label name="drt">DRT:&nbsp;</label>
                    <input type="text" name="drt" size="9" onkeyup="this.value = this.value.toUpperCase();" id="drt" maxlength="7" class="required" autofocus>
                </li>
                <li>
                    <label name="nome">NOME:&nbsp;</label>
                    <input type="text" name="nome" size="50" onkeyup="this.value = this.value.toUpperCase();">
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
                        <option value="<?php echo $buscar_cidade['id_cidade']; ?>"><?php echo $buscar_cidade['str_cidade']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label name="posto">POSTO SERVI&Ccedil;O:&nbsp;</label>
                    <select name="posto">
                        <option value="">Selecione uma Posto</option>
                        <?php
                        $buscar_posto = "SELECT * FROM tab_posto ORDER BY str_posto ASC";
                        $ex_buscar_posto = mysql_query($buscar_posto);
                        while ($buscar_posto = mysql_fetch_array($ex_buscar_posto)){
                        ?>
                        <option value="<?php echo $buscar_posto['id_posto']; ?>"><?php echo $buscar_posto['str_posto']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label name="data_rec_inicial">DATA REC. INICIAL:&nbsp;</label>
                    <input type="text" name="dt_in_rec" size="10" maxlength="10" onKeyPress="DataHora(event, this)" />
                </li>
                <li>
                    <label name="data_rec_final">DATA REC. FINAL:&nbsp;</label>
                    <input type="text" name="dt_fin_rec" size="10" maxlength="10" onKeyPress="DataHora(event, this)" />
                </li>
            </ol>
</fieldset>
<div align="center">
    <input type="hidden" name="cad_colaborador_ok" value="1">
    <input type="submit" value="CADASTRAR COLABORADOR">
</div>
</form>

<?php
if ($cad_colab == "cadastrado") {
?>
<div id="aviso_ok">
    Colaborador Cadastrado com Sucesso!
</div>
<?php
}
if ($cad_colab == "erro") {
?>
<div id="aviso_erro">
    Colaborador já esta Cadastrado. Cadastre Outro!
</div>
<?php
}
?>
</div>
<?php
include ("footer.php");
?>