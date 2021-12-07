<?php
session_start();

require_once("../conexao/conexao.php");

/* Banco Imovel Tipo */
$SQL = "SELECT * FROM imoveltipo";
$search_tp_imovel = mysqli_query($conexao, $SQL);

if (!$search_tp_imovel) {
    die("Erro no Banco");
}
/* Fim */


/* Banco Bairros */
$SQL_bairros = "SELECT * FROM bairros";
$bairros = mysqli_query($conexao, $SQL_bairros);

if (!$bairros) {
    die("Erro no Banco");
}
/* Fim */
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unimobiliária | A Imobiliária Universal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        <section class="main">
            <div class="container">
                <div class="grid-8 intro">
                    <h1>Seu imóvel mais fácil.</h1>
                    <p>Cansado de tentar escolher a imobiliária ideal? Aqui, na Unimobiliária, agrupamos todas elas para
                        você. Assim, a única coisa que você precisa fazer é procurar seu futuro imóvel na faixa de preço que
                        cabe no seu bolso.</p>
                    <button><a class="acesso_catalogo" href="catalogo.php"> Veja nosso catálogo </a></button>
                </div>
                <div class="grid-8">
                    <div class="index-form">
                        <form action="catalogo.php" method="post" enctype="multipart/form-data">
                            <!-- Inicio dos Tipos Imoveis -->
                            <p>O que você procura?</p>
                            <select name="tipo_imovel" required>
                                <option value="" disabled selected>Selecione</option>
                                <?php
                                while ($tipo_imovel = mysqli_fetch_array($search_tp_imovel)) {
                                ?>
                                    <option value="<?php print $tipo_imovel['codtipo'] ?>">
                                        <?php print utf8_encode($tipo_imovel['descricao']) ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- Fim dos Tipos Imoveis -->

                            <!-- Inicio Localização -->
                            <p>Onde você procura?</p>
                            <select name="localizacao" required>
                                <option value="" disabled selected>Selecione</option>
                                <?php
                                while ($localizacao = mysqli_fetch_assoc($bairros)) {
                                ?>
                                    <option value="<?php print $localizacao['nome_bairro'] ?>">
                                        <?php print utf8_encode($localizacao['nome_bairro']) ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- Fim Localização -->


                            <!-- Modalidade Aluguel ou Compra -->
                            <p>Compra ou Aluguel?</p>
                            <select name="tipo_negocio" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="Aluguel">Aluguel</option>
                                <option value="Venda">Compra</option>
                                <option value="Ambos">Ambos</option>
                                <!-- Fim Modalidade Aluguel ou Compra -->


                            </select>
                            <input type="submit" value="Procurar" name="Procurar">
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="index-data">
            <div class="container">
                <p class="grid-16 perfect">Perfeito, também, para quem anuncia. Cadastre seu imóvel em nosso site, de forma
                    independente ou junto a sua imobiliária, para mostrá-lo a milhares de clientes em potencial.</p>
                <div class="grid-4 index-data-card imob-parceira">
                    <img src="../img/imob-parceira.png" alt="Imobiliárias Parceiras">
                    <p class="data-number">7</p>
                    <p class="data-text">Imobiliárias<br>parceiras</p>
                </div>
                <div class="grid-4 imov-cadastrado index-data-card">
                    <img src="../img/imov-cadastrado.png" alt="Imóveis Cadastrados">
                    <p class="data-number">
                        <?php
                        /* Mostrar o total de linhas de imoveis ( Imoveis Cadastrados )*/
                        $SQL = "SELECT COUNT(*) FROM imovel";
                        $ImoveisCadastrado = mysqli_query($conexao, $SQL);
                        $count_imovel = mysqli_fetch_array($ImoveisCadastrado);
                        echo $count_imovel[0];
                        /* Fim */
                        ?>
                    </p>

                    <p class="data-text">Imóveis<br>cadastrados</p>
                </div>
                <div class="grid-4 ctt-fechado index-data-card">
                    <img src="../img/ctt-fechado.png" alt="Usuários Cadastrados">
                    <p class="data-number">
                        <?php
                        /* Mostrar o total de Usuarios Cadastrados */
                        $SQL = "SELECT COUNT(*) FROM usuario";
                        $UsuariosCadastrados = mysqli_query($conexao, $SQL);
                        $count_usuario = mysqli_fetch_array($UsuariosCadastrados);
                        echo $count_usuario[0];
                        /* Fim */
                        ?>
                    </p>
                    <p class="data-text">Usuários<br>Cadastrados</p>
                </div>
            </div>
        </section>

        <section class="index-tour container">
            <div class="grid-7 tour-info">
                <p>Além disso, dispomos de um serviço de <strong><i>Tour Virtual</i></strong> a ser contratado no momento do
                    cadastro. Cative seu cliente com uma visualização interativa, ou busque por imóveis com o <i>Tour 3D</i>
                    agora mesmo!
                </p>
                <button onclick="window.location.href='catalogo.php'">Buscar por Imóveis</button>
            </div>
            <div class="grid-7 tour-3d">
                <iframe width="450" height="260" src="https://my.matterport.com/show/?m=BswfThZ38kh" frameborder="0" allowfullscreen="" allow="xr-spatial-tracking"></iframe>
            </div>
        </section>

        <section class="vantagem">
            <div class="container">
                <div class="grid-9">
                    <h2>Nossas Vantagens</h2>
                    <p>Anunciação de imóveis como você nunca viu antes. <br>Rápido, fácil e seguro.</p>
                    <button onclick="window.location.href='cadastro_imovel.php'">Explore</button>
                </div>
                <img src="../img/vantagens.png" alt="House Vector" class="grid-7">
            </div>
        </section>

        <section class="parceiros">
            <div class="container">
                <h2 class="grid-16">Imobiliárias Parceiras</h2>
                <div class="grid-16">
                    <div class="card">
                        <p>SA</p>
                        <img src="../img/sa.png" alt="SA Imóveis">
                    </div>
                    <div class="card">
                        <p>Concreto</p>
                        <img src="../img/concreto.png" alt="Concreto Imóveis">
                    </div>
                    <div class="card">
                        <p>Expande</p>
                        <img src="../img/expande.png" alt="Expande Corretora">
                    </div>
                    <div class="card">
                        <p>RE/MAX</p>
                        <img src="../img/remax.png" alt="RE/MAX">
                    </div>
                    <div class="card">
                        <p>Robuste</p>
                        <img src="../img/robuste.png" alt="Robuste">
                    </div>
                    <div class="card">
                        <p>Habites</p>
                        <img src="../img/habites.png" alt="Habites">
                    </div>
                    <div class="card">
                        <p>Ideal</p>
                        <img src="../img/ideal.png" alt="Ideal Imóveis">
                    </div>
                </div>
            </div>
        </section>

        <?php
        require_once("rodape.php");
        ?>
    </div>
</body>

</html>