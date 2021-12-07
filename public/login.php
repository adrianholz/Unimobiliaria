<?php
session_start();

require_once("../conexao/conexao.php");

/* Se estiver Logado, vai para essa tela*/
if (isset($_SESSION["Usuario"])) {
    header("Location: tela_do_usuario.php");
}
/* Fim */

if (isset($_POST['LOGIN'])) {
    $usuario = $_POST['USUARIO'];
    $senha   = $_POST['SENHA'];

    $login   = "SELECT * FROM usuario ";
    $login  .= "where usuario = '{$usuario}' and senha = '{$senha}'";

    $acesso  = mysqli_query($conexao, $login);

    if (!$acesso) {
        die("Falha na consulta ao banco");
    }

    $informacao = mysqli_fetch_assoc($acesso);

    if (empty($informacao)) {
        $msg = "Login não permitido";
    } else {
        $_SESSION["Id_usuario"]  = $informacao['Id_usuario'];
        $_SESSION["Nome"]        = $informacao['nome'];
        $_SESSION["Usuario"]     = $informacao['usuario'];
        header("Location: catalogo.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

    <main>
        <div class="container">
        <div class="form-cadastro">
        <div id="janela_login">
            <form action="login.php" method="POST">
                <h3>Tela de Login</h3>
                <input class="form-cadastro-texto login-margin" type="text" name="USUARIO" required placeholder="Nome de Usuário"><br>
                <input class="form-cadastro-texto login-margin" type="password" name="SENHA" required placeholder="Senha"><br>
                <input class="login-send" type="submit" name="LOGIN" value="Entrar">

                <?php
                if (isset($msg)) {
                    echo "<p>" . $msg . "</p>";
                }
                ?>
            </form>
            <button class="cadastrar"><a href="cadastro_usuario.php">Cadastrar</a></button>
            <!-- FAZER BOTÃO SE USUÁRIO JÁ TEM CADASTRO OU NÃO -->
        </div>
        </div>
        </div>
    </main>

    <?php
    require_once("rodape.php");
    ?>
    </div>
</body>

</html>