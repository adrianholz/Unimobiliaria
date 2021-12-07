<?php
session_start();

$erro_usuario       = 0; /* Se caso acontecer erro no usuário, essa variavel irá ajudar a completar a tabela só faltando o Usuário */

require_once("../conexao/conexao.php");

/* Capturando Informações Cadastro Usuario */
if (isset($_POST["CADASTRAR_USUARIO"])) { /* Adicionando tudo na tabela USUARIO */

  $nome_usuario       = $_POST["nome"];
  $telefone_usuario   = $_POST["telefone"];
  $usuario            = $_POST["usuario"];
  $senha_usuario      = $_POST["senha"];
  /* Fim Captura */
  $erro_usuario       = 0; /* Se caso acontecer erro no usuário, essa variavel irá ajudar a completar a tabela só faltando o Usuário */

  /* Verificando se o Usuario já existe no banco */
  $pesquisa_usuario   = "SELECT usuario FROM usuario ";
  $pesquisa_usuario  .= "where usuario = '{$usuario}'";

  $verificar = mysqli_query($conexao, $pesquisa_usuario);

  if (!$verificar) {
    print $inserir_usuario;
    die("Erro no Banco");

  }

  $verificar = mysqli_fetch_array($verificar);

  if ($verificar[0] == $usuario) {
    $erro_usuario       = 1; /* Se caso acontecer erro no usuário, essa variavel irá ajudar a completar a tabela só faltando o Usuário */
    echo ("<script> alert('Esse usuário já existe, por favor digite outro nome para usuário') </script>");
  } else {
    /* Inserindo no Banco */
    $SQL_usuario = "INSERT INTO usuario (nome, telefone, usuario, senha)";
    $SQL_usuario .= "values ('$nome_usuario','$telefone_usuario','$usuario','$senha_usuario')";

    $inserir_usuario = mysqli_query($conexao, $SQL_usuario);

    if (!$inserir_usuario) {
      die("Erro no Banco");
    }

    header("Location: login.php");
    /* Fim inserção */
  }
  /* Fim Verificação Usuario */
}

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
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

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
      <div class="form-cadastro-usuario">
        <form action="cadastro_usuario.php" method="POST" enctype="multipart/form-data">
          <h3>Nome</h3><input type="text" name="nome" maxlength="45" class="form-cadastro-usuario-texto" value="<?php if ($erro_usuario == 1) {
                                                                                                                  echo ($nome_usuario);
                                                                                                                } ?>"
            required>

          <h3>Telefone</h3><input type="text" name="telefone" id="telefone" maxlength="15"
            class="form-cadastro-usuario-texto" value="<?php if ($erro_usuario == 1) {
                                    echo ($telefone_usuario);
           } ?>" required>

          <h3>Usuário</h3><input type="email" name="usuario" placeholder="Insira um e-mail" maxlength="50" class="form-cadastro-usuario-texto" required>

          <h3>Senha</h3><input type="password" id="senha" name="senha" maxlength="20" class="form-cadastro-usuario-texto"
             value="<?php if ($erro_usuario == 1) {
               echo ($senha_usuario);
            } ?>" required>

          <h3>Confirmação de Senha</h3><input type="password" id="senhaC" name="senhaC" maxlength="20"
            class="form-cadastro-usuario-texto" required>
          <br>
          <button type="submit" onclick="validarSenha()" name="CADASTRAR_USUARIO"
            class="form-send">Cadastrar</button>
        </form>
      </div>
    </div>

    <!-- Adicionando JavaScript -->
    <script type="text/javascript" src="../js/funcoes.js"></script>

    <?php
    echo "<span class=footer>";
    require_once("rodape.php");
    echo "</span>";
    ?>
  </div>
</body>

</html>