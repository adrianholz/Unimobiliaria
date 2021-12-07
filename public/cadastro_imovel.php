<?php
require_once("../conexao/conexao.php");
require_once("funcoes.php");

//teste de segurança
session_start();

if (!isset($_SESSION["Usuario"])) {
    echo "<script>
    alert('É necessário estar logado, para acessar essa página')
    window.location.replace('login.php');
    </script>";
}
//fim do teste

/* Opções de "Tipo de Casa" */
$SQL_tipo_imovel = "SELECT * FROM imoveltipo";
$pesquisa_tabela_tipo_imovel = mysqli_query($conexao, $SQL_tipo_imovel);

if (!$pesquisa_tabela_tipo_imovel) {
    die("Erro no Banco");
}
/* Fim opções */

/* Banco Bairros */
$SQL_bairros = "SELECT * FROM bairros";
$bairros = mysqli_query($conexao, $SQL_bairros);

if (!$bairros) {
    die("Erro no Banco");
}
/* Fim */

/* Capturando Informações do Imovel */
if (isset($_POST["ENVIAR"])) { /* Adicionando tudo da tabela IMOVEL e IMOVELFOTOS*/

    $tipo_imovel       = $_POST["tipo_imovel_escolhido"];
    $id_usuario        = $_SESSION["Id_usuario"];
    $descricao         = $_POST["descricao"];
    $area_terreno      = $_POST["area_terreno"];
    $area_construida   = $_POST["area_construida"];

    /* Pesquisa Nome Localizacao */
    $localizacao_banco = $_POST["localizacao"];
    $SQL_localizacao   = "SELECT * FROM bairros WHERE cod_bairro = '{$localizacao_banco}'";
    $nome_localizacao  = mysqli_query($conexao, $SQL_localizacao);
    $localizacao_assoc = mysqli_fetch_assoc($nome_localizacao);
    if (!$localizacao_assoc) {
        die("Erro no Banco");
    }
    $localizacao       = $localizacao_assoc['nome_bairro'];
    /* Fim */

    $qtd_quartos       = $_POST["qtd_quartos"];
    $qtd_salas         = $_POST["qtd_salas"];
    $qtd_banheiros     = $_POST["qtd_banheiros"];
    $qtd_cozinhas      = $_POST["qtd_cozinhas"];
    $qtd_areagourmet   = $_POST["qtd_areagourmet"];
    $qtd_piscinas      = $_POST["qtd_piscinas"];
    $qtd_vagasgaragem  = $_POST["qtd_vagasgaragem"];
    $link_tour         = $_POST["tour"];
    $observacao        = $_POST["observacao"];

    $valor_venda       = $_POST["valor_venda"];
    if (empty($valor_venda)) {
        $valor_venda = 0;
    }

    $valor_aluguel     = $_POST["valor_aluguel"];
    if (empty($valor_aluguel)) {
        $valor_aluguel = 0;
    }

    $tipo_venda        = $_POST["tipo_venda"];

    /* Fim Captura */

    /* Inserindo no Banco */
    $SQL = "INSERT INTO imovel (codtipo, id_usuario, descricao, areaterreno, areaconstruida, localizacao, qtdquartos, qtdsalas, qtdbanheiros, qtdcozinha, qtdgourmet, qtdpiscinas, qtdvagas, obs, valor_venda, valor_aluguel, mod_venda, tour) values ('$tipo_imovel', '$id_usuario', '$descricao', '$area_terreno', '$area_construida', '$localizacao', '$qtd_quartos', '$qtd_salas', '$qtd_banheiros','$qtd_cozinhas', '$qtd_areagourmet', '$qtd_piscinas', '$qtd_vagasgaragem', '$observacao', '$valor_venda', '$valor_aluguel', '$tipo_venda', '$link_tour')";

    $inserir = mysqli_query($conexao, $SQL);

    if (!$inserir) {
        die("Erro no Banco");
    } else {
        header("Location: tela_do_usuario.php");
    }
    /* Fim inserção */
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Imovel</title>

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

            <div class="form-cadastro">

                <form action="cadastro_imovel.php" method="POST">
                    <!-- Tipo dos Imoveis -->
                    <h3>Tipo do Imovel</h3><select name="tipo_imovel_escolhido" required>
                        <option value="" disabled selected>Selecione</option>
                        <?php
                        while ($tipo_imovel = mysqli_fetch_array($pesquisa_tabela_tipo_imovel)) {
                        ?>
                            <option value="<?php print $tipo_imovel['codtipo'] ?>">
                                <?php print utf8_encode($tipo_imovel['descricao']) ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <!-- Fim dos Tipos Imoveis -->


                    <h3>Descrição</h3><textarea name="descricao" maxlength="500" required></textarea>

                    <h3>Área Terreno</h3><input type="number" name="area_terreno" class="form-cadastro-texto" required>

                    <h3>Área Construida</h3><input type="number" name="area_construida" class="form-cadastro-texto" required>

                    <h3>Localização</h3><select name="localizacao" required>
                        <option value="" disabled selected>Selecione</option>
                        <?php
                        while ($localizacao = mysqli_fetch_assoc($bairros)) {
                        ?>
                            <option value="<?php print $localizacao['cod_bairro'] ?>">
                                <?php print utf8_encode($localizacao['nome_bairro']) ?> </option>
                        <?php
                        }
                        ?>
                    </select>

                    <h3>Quantidade de Quartos</h3><select name="qtd_quartos" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>

                    <h3>Quantidade de Salas</h3><select name="qtd_salas" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>

                    <h3>Quantidade de Banheiros</h3><select name="qtd_banheiros" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>

                    <h3>Quantidade de Cozinhas</h3><select name="qtd_cozinhas" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <br>

                    <h3>Quantidade de Áreas Gourmet</h3><select name="qtd_areagourmet" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <br>

                    <h3>Quantidade de Piscinas</h3><select name="qtd_piscinas" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <br>

                    <h3>Quantidade de Vagas</h3><select name="qtd_vagasgaragem" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>

                    <h3>Link do Tour 3D</h3>
                    <input type="url" name="tour" class="form-cadastro-texto" maxlength="100" required>

                    <h3>Observação Opcional</h3><textarea name="observacao" maxlength="500"></textarea>

                    <h3>Tipo da Venda:</h3>
                    <select name="tipo_venda" id="tipo_de_venda" onchange="exibir_ocultar_tipo_venda()" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="Aluguel">Alugar</option>
                        <option value="Venda">Vender</option>
                        <option value="Ambos">Ambos</option>
                    </select>

                    <p id="mostrar_tipo_venda"></p>
                    <!-- ARRUMAR SE O USUARIO ESCOLHER SÓ O VENDA OU ALUGUEL, E O OUTRO TEM QUE RECEBER 0-->
                    <p id="mostrar_tipo_aluguel"></p>



                    <input type="submit" value="Enviar" name="ENVIAR" class="form-send">
                </form>
            </div>
        </div>

        <!-- Adicionando JavaScript -->
        <script type="text/javascript" src="../js/funcoes.js"></script>

        <?php
        require_once("rodape.php");
        ?>
    </div>
</body>

</html>