<?php
session_start();

require_once("../conexao/conexao.php");
require_once("funcoes.php");

$cod_imovel = $_GET["var_imovel"]; /* Variavel que veio da outra tela pelo link(VERIFICAR COM O PROFESSOR SE ISSO FICOU BOM) e mostrar erro quando volta da pagina anterior DETALHE_IMOVEL.php para CATALOGO.PHP depois que escolhe chacara no INDEX.PHP*/

/* Procurar Informações do Imovel */
$SQL_imovel              = "SELECT * FROM imovel WHERE codimovel = {$cod_imovel}";
$informacao_imovel       = mysqli_query($conexao, $SQL_imovel);
$informacao_imovel       = mysqli_fetch_assoc($informacao_imovel);

if ($informacao_imovel['valor_venda'] == 0) {
  $informacao_imovel['valor_venda'] = "Não está a Venda";
} else {
  $informacao_imovel['valor_venda'] = real_format($informacao_imovel['valor_venda']);
}

if ($informacao_imovel['valor_aluguel'] == 0) {
  $informacao_imovel['valor_aluguel'] = "Não está para Alugar";
} else {
  $informacao_imovel['valor_aluguel'] = real_format($informacao_imovel['valor_aluguel']);
}
/* Fim Procura */

/* Procurar Informações do Dono do Imovel */
$SQL_dono_imovel         = "SELECT * FROM usuario WHERE Id_usuario = {$informacao_imovel['id_usuario']}";
$informacao_dono_imovel  = mysqli_query($conexao, $SQL_dono_imovel);
$informacao_dono_imovel  = mysqli_fetch_assoc($informacao_dono_imovel);
/* Fim Procura */

/* Procurar Tipo do Imovel */
$procura_tipo_imovel  = "SELECT descricao FROM imoveltipo where ";
$procura_tipo_imovel .= " codtipo = {$informacao_imovel['codtipo']}";
$tipo_imovel          = mysqli_query($conexao, $procura_tipo_imovel);
$tipo_imovel          = mysqli_fetch_assoc($tipo_imovel);
/* Fim Procura */

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhe Imovel</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Adicionando CSS -->
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/grid.css">
  <link rel="stylesheet" href="../css/style.css">

</head>

<body>
  <div class="footerfix">

    <?php
    require_once("topo.php");
    ?>
    <div class="container">
      <h3 class="info-title">Informações do Proprietário</h3><br>
      <?php
      echo "<h2 class='informacao'>" . $informacao_dono_imovel['nome'] . "</h2>";
      echo "<h2 class='informacao'>" . $informacao_dono_imovel['telefone'] . "</h2>";
      ?>

      <iframe class="iframe-detalhe" width="800" height="461" src="<?php echo $informacao_imovel['tour']; ?>" frameborder="0" allowfullscreen="" allow="xr-spatial-tracking"></iframe>

      <?php
      echo "<div class='detailpaddingfix'>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Tipo do Imóvel</h3>" . "<p class='p-detalhe'>" . utf8_encode($tipo_imovel['descricao']) . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Descrição</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['descricao'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Área do Terreno</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['areaterreno'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Área Construída</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['areaconstruida'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Localização do Imóvel</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['localizacao'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Quarto(s)</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdquartos'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Sala(s)</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdsalas'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Banheiro(s)</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdbanheiros'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Cozinha(s)</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdcozinha'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Área(s) gourmet</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdgourmet'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Piscina(s)</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdpiscinas'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Vaga(s)</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['qtdvagas'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Observações</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['obs'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Valor de Venda</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['valor_venda'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Valor de Aluguel</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['valor_aluguel'] . "</p></div>";
      echo "<div class='grid-4 detalhe'><h3 class='h3-detalhe'>Modo de Negócio</h3>" . "<p class='p-detalhe'>" . $informacao_imovel['mod_venda'] . "<br>";
      echo "</div>";
      ?>
    </div>
  </div>
  <?php
  require_once("rodape.php");
  ?>

  </div>
</body>

</html>