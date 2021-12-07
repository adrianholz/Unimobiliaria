<?php
session_start();

require_once("../conexao/conexao.php");
require_once("funcoes.php");

/* Verificando se o usuário esta logado */
if (empty($_SESSION["Usuario"])) {
    header("Location: login.php");
}
/* Fim */

/* APAGAR IMOVEL */
if (isset($_POST['APAGAR'])) { /* NÃO TÁ APAGANDO, ARRUMAR */
    $codigo_imovel        = $_POST["cod_do_imovel"];

    $SQL_apagar_imovel    = "DELETE FROM imovel WHERE codimovel = {$codigo_imovel}";
    $apagar_imovel        = mysqli_query($conexao, $SQL_apagar_imovel);

    if (!$apagar_imovel) {
        die("Imovel não excluído!");
    } else {
        header("Location: tela_do_usuario.php");
    }
}
/* FIM APAGAR IMOVEL */

/* Pesquisa Imovel do Usuário */
$cod_imovel               = $_GET['imovel'];
$SQL_imovel_usuario       = "SELECT * FROM imovel WHERE codimovel = {$cod_imovel}";
$pesquisa_imovel_usuario  = mysqli_query($conexao, $SQL_imovel_usuario);
$detalhe_imovel_usuario   = mysqli_fetch_assoc($pesquisa_imovel_usuario);

if (!$pesquisa_imovel_usuario) {
    die("Erro no Banco");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar Imovel</title>

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

            <h1>Apagar Imóvel</h1>

            <div class="deletar-imovel-usuario">
                <form action="apagar_imovel.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="cod_do_imovel" value="<?php echo $detalhe_imovel_usuario['codimovel'] ?>">
                    <h3><?php echo "Imóvel: </h3>" . $detalhe_imovel_usuario['localizacao']; ?>
                        <p>Tem certeza de que deseja excluir este imóvel?</p>

                        <input type="submit" value="Excluir" name="APAGAR">
                </form>

            </div>

        </div>

        <?php
        require_once("rodape.php");
        ?>
    </div>

</body>

</html>