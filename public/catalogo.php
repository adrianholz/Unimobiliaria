<?php
session_start();

require_once("../conexao/conexao.php");
require_once("funcoes.php");


/* FILTRO DOS IMOVEIS*/
if (isset($_POST['Procurar'])) {

    /* Filtro Tipo Imovel */
    $codtipo           = $_POST["tipo_imovel"];
    $bairro_escolhido  = $_POST["localizacao"];
    $tipo_negocio      = $_POST["tipo_negocio"];
    $ambos = "Ambos";

    $SQL = "SELECT * FROM imovel where codtipo = '{$codtipo}' AND localizacao = '{$bairro_escolhido}' AND mod_venda = '{$tipo_negocio}' OR codtipo = '{$codtipo}' AND localizacao = '{$bairro_escolhido}' AND mod_venda = '{$ambos}'";
    $detalhe = mysqli_query($conexao, $SQL);

    if (!$detalhe) {
        die("Falha no Banco de Dados");
    }
    /* Fim Filtro Tipo Imovel */
} else {
    $SQL = "SELECT * FROM imovel ORDER BY rand() LIMIT 10";
    $detalhe = mysqli_query($conexao, $SQL);
}
/* FIM FILTRO DOS IMOVEIS*/

/* PESQUISA IMOVEL */
$banco = "SELECT * FROM imovel";

if (isset($_GET['pesquisar_imovel'])) {
    $pesquisa = $_GET["imovel_pesquisa"];  /* VER QUAL SERÁ A COLUNA DO RESULTADO DA PESQUISA */
    $banco .= " WHERE localizacao LIKE '%{$pesquisa}%'";
    $detalhe = mysqli_query($conexao, $banco);
}

/* Na pesquisa do index, ele bloqueia o filtro */
/* FIM PESQUISA IMOVEL */
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unimobiliária | Catálogo</title>

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

        <section class="container paddingfix">
            <!-- Pesquisa Por Escrito -->
            <div class="grid-16 catalogo-form">
                <form action="catalogo.php" method="GET">
                    <input type="text" placeholder="Procure seu imóvel..." name="imovel_pesquisa" class="pesquisa" required>
                    <input type="submit" class="pesquisa-btn" name="pesquisar_imovel">
                </form>
            </div>
            <!-- Fim Pesquisa Por Escrito -->


            <!-- Laço de Repetição Tipo Imovel -->
            <?php
            while ($dados_detalhe = mysqli_fetch_assoc($detalhe)) {
            ?>
                <div class="grid-1-3 cat-imovel">
                    <iframe width="300" height="173" src="<?php echo $dados_detalhe['tour']; ?>" frameborder="0" allowfullscreen="" allow="xr-spatial-tracking"></iframe>
                    <div class="cat-title"><a href="detalhe_imovel.php?var_imovel=<?php echo $dados_detalhe['codimovel'] ?>">
                            <h3><?php echo utf8_encode($dados_detalhe['localizacao']); ?></h3>
                        </a></div>

                    <?php /* Verificar qual preço deve aparecer */
                    if ($dados_detalhe['mod_venda'] == "Venda") {
                        echo "<h4>Comprar: R$ " . real_format($dados_detalhe['valor_venda']) . "</h4>";
                    } else if ($dados_detalhe['mod_venda'] == "Aluguel") {
                        echo "<h4>Alugar: R$ " . real_format($dados_detalhe['valor_aluguel']) . "</h4>";
                    } else {
                        echo "<h5>Comprar: R$ " . real_format($dados_detalhe['valor_venda']) . " ou </h5><br><h4>Alugar: R$ " . real_format($dados_detalhe['valor_aluguel']) . "</h4>";
                    } /* Fim Verificação */ ?>

                    <?php /* Verificar se precisa aparecer MENSAIS se acaso for casa para alugar */
                    if ($dados_detalhe['mod_venda'] == "Aluguel" || $dados_detalhe['mod_venda'] == "Ambos") {
                        echo ("<p>mensais</p>");
                    } /* Fim Verificação */ ?>

                </div>
            <?php
            }
            ?>
            <!-- Fim Laço de Repetição Tipo Imovel -->

        </section>

        <?php
        require_once("rodape.php");
        ?>
    </div>
</body>

</html>