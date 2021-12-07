<?php
session_start();

require_once("../conexao/conexao.php");
require_once("funcoes.php");

/* Verificando se o usuário esta logado */
if (empty($_SESSION["Usuario"])) {
  header("Location: login.php");
}
/* Fim */

$id_usuario = $_SESSION["Id_usuario"];

/* Pesquisa Imovel do Usuário */
$SQL_imovel_usuario          = "SELECT * FROM imovel WHERE id_usuario = {$id_usuario}";
$informacao_imovel_usuario   = mysqli_query($conexao, $SQL_imovel_usuario);
/* Fim */
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

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

    <div class="container imoveis-cadastrados">

      <h1>Meus Imóveis</h1>

      <?php
      while ($detalhe_imovel_usuario = mysqli_fetch_assoc($informacao_imovel_usuario)) {
      ?>

        <div class="grid-1-3 quadro-imovel-usuario">
          <h3><?php echo "Localização: </h3> <p>"     . utf8_encode($detalhe_imovel_usuario['localizacao']); ?></p><br>
            <h3><?php echo "Descrição: </h3> <p>"       . $detalhe_imovel_usuario['descricao']; ?></p><br>
              <h3><?php echo "Valor Venda: </h3> <p>"     . real_format($detalhe_imovel_usuario['valor_venda']); ?>
                </p><br>
                <h3><?php echo "Valor Aluguel: </h3> <p>"   . real_format($detalhe_imovel_usuario['valor_aluguel']); ?>
                  </p>
                  <br>
                  <h3><?php echo "Modalidade Venda: </h3> <p>" . $detalhe_imovel_usuario['mod_venda']; ?></p><br>

                    <button type="submit">
                      <a href="alterar_dados_imovel.php?imovel=<?php echo $detalhe_imovel_usuario['codimovel'] ?>">Editar
                      </a>
                    </button>
                    <button>
                      <a href="apagar_imovel.php?imovel=<?php echo $detalhe_imovel_usuario['codimovel'] ?>">Apagar
                      </a>
                    </button>

        </div>

      <?php
      }
      ?>
    </div>

    <?php
    require_once("rodape.php");
    ?>
  </div>
</body>

</html>