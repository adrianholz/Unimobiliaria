<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div class="container">
            <a href="index.php"><img src="../img/logo.png" alt="Logo Unimobiliária" class="grid-3 logo"></a>
            <div class="grid-13">
                <?php
                /* Aparecer Botão Para Desconectar Do Login */
                if (isset($_SESSION["Usuario"])) {
                    echo ("<a class='header-links login' href='sair.php'>Sair</a>");
                    echo ("<a class='header-links login' href='tela_do_usuario.php'>Meus Imóveis</a>");
                } else {
                    echo ("<a href='login.php' class='header-links login'>Login</a>");
                }
                /* Fim Botão */
                ?>
                <a href="cadastro_imovel.php" class="header-links cad-header">Cadastro</a>
                <a href="catalogo.php" class="header-links">Catálogo</a>
                <a href="index.php" class="header-links">Home</a>

            </div>


        </div>
    </header>
</body>

</html>