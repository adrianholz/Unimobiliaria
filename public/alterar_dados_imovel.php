<?php
require_once("../conexao/conexao.php");

//teste de segurança
session_start();

if (!isset($_SESSION["Usuario"])) {
    header("Location: login.php");
}
//fim do teste

/* Opções de "Tipo de Casa" */
$SQL = "SELECT * FROM imoveltipo";
$pesquisa_tabela_tipo_imovel = mysqli_query($conexao, $SQL);

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

/* Capturando Informações do Imovel no banco */
if (isset($_POST["ALTERAR"])) { /* Alterando dados da tabela IMOVEL */

    $codimovel         = $_POST["codimovel"];
    $tipo_imovel       = $_POST["tipo_imovel_escolhido"];
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

    if ($valor_venda <> 0 && $valor_aluguel == 0) {
        $tipo_venda = "Venda";
    } elseif ($valor_venda == 0 && $valor_aluguel <> 0) {
        $tipo_venda = "Aluguel";
    } else {
        $tipo_venda = "Ambos";
    }
    /* Fim Captura */

    /* Alterando no Banco */
    $alterar  = "UPDATE imovel SET ";
    $alterar .= "codtipo = '{$tipo_imovel}', ";
    $alterar .= "descricao = '{$descricao}', ";
    $alterar .= "areaterreno = '{$area_terreno}', ";
    $alterar .= "areaconstruida = '{$area_construida}', ";
    $alterar .= "localizacao = '{$localizacao}', ";
    $alterar .= "qtdquartos = '{$qtd_quartos}', ";
    $alterar .= "qtdsalas = '{$qtd_salas}', ";
    $alterar .= "qtdbanheiros = '{$qtd_banheiros}', ";
    $alterar .= "qtdcozinha = '{$qtd_cozinhas}', ";
    $alterar .= "qtdgourmet = '{$qtd_areagourmet}', ";
    $alterar .= "qtdpiscinas = '{$qtd_piscinas}', ";
    $alterar .= "qtdvagas = '{$qtd_vagasgaragem}', ";
    $alterar .= "obs = '{$observacao}', ";
    $alterar .= "valor_venda = '{$valor_venda}', ";
    $alterar .= "valor_aluguel = '{$valor_aluguel}', ";
    $alterar .= "mod_venda = '{$tipo_venda}', ";
    $alterar .= "tour = '{$link_tour}' ";
    $alterar .= "WHERE codimovel = {$codimovel}";

    $alterar_dados = mysqli_query($conexao, $alterar);

    if (!$alterar_dados) {
        die("Erro na Alteração");
    } else {
        header("Location: tela_do_usuario.php");
    }
    /* Fim Alteração */
}

/* Pesquisa Imovel do Usuário */
$cod_imovel               = $_GET['imovel'];
$SQL_imovel_usuario       = "SELECT * FROM imovel WHERE codimovel = {$cod_imovel}";
$pesquisa_imovel_usuario  = mysqli_query($conexao, $SQL_imovel_usuario);

if (!$pesquisa_imovel_usuario) {
    die("Erro no Banco");
}

$informacao_imovel_usuario   = mysqli_fetch_assoc($pesquisa_imovel_usuario);
/* Fim */
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

        <!-- Começo do Formulário -->
        <div class="container">
            <div class="form-alterar">
                <form action="alterar_dados_imovel.php" method="POST" enctype="multipart/form-data">
                    <!-- Tipo dos Imoveis -->
                    <h3>Codigo do Imovel(Não Alterar)</h3><input type="number" name="codimovel" class="form-alterar-texto" readonly="readonly" value="<?php echo $cod_imovel; ?>" required>

                    <h3>Tipo do Imovel </h3><select name="tipo_imovel_escolhido">
                        <option value="" disabled selected>Selecione</option>
                        <?php
                        while ($tipo_imovel = mysqli_fetch_array($pesquisa_tabela_tipo_imovel)) {
                        ?>
                            <option value="<?php print $tipo_imovel['codtipo'] ?>" <?php
                                                                                    if ($tipo_imovel['codtipo'] == $informacao_imovel_usuario['codtipo']) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                <?php print utf8_encode($tipo_imovel['descricao']) ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    <!-- Fim dos Tipos Imoveis -->

                    <h3>Descrição </h3><textarea type="text" class="form-alterar-texto" maxlength="500" name="descricao" required><?php echo $informacao_imovel_usuario['descricao'] ?></textarea>

                    <h3>Area Terreno </h3><input type="number" name="area_terreno" class="form-alterar-texto" value="<?php echo $informacao_imovel_usuario['areaterreno'] ?>" required>

                    <h3>Area Construida </h3><input type="number" name="area_construida" class="form-alterar-texto" value="<?php echo $informacao_imovel_usuario['areaconstruida'] ?>" required>

                    <h3>Localização</h3><select name="localizacao" required>
                        <option value="" disabled selected>Selecione</option>
                        <?php
                        while ($localizacao = mysqli_fetch_assoc($bairros)) {
                        ?>
                            <option value="<?php print $localizacao['cod_bairro'] ?>" <?php if ($informacao_imovel_usuario['localizacao'] == $localizacao['nome_bairro']) {
                                                                                            echo "selected";
                                                                                        } ?> required>
                                <?php print utf8_encode($localizacao['nome_bairro']) ?> </option>
                        <?php
                        }
                        ?>
                    </select>


                    <h3>Quantidade de Quartos</h3>
                    <select name="qtd_quartos" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdquartos']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdquartos']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdquartos']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdquartos']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                        <option value="4" <?php if (4 == $informacao_imovel_usuario['qtdquartos']) {
                                                echo "selected";
                                            } ?>>4
                        </option>
                        <option value="5" <?php if (5 == $informacao_imovel_usuario['qtdquartos']) {
                                                echo "selected";
                                            } ?>>5
                        </option>
                    </select>


                    <h3>Quantidade de Salas</h3>
                    <select name="qtd_salas" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdsalas']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdsalas']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdsalas']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdsalas']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                        <option value="4" <?php if (4 == $informacao_imovel_usuario['qtdsalas']) {
                                                echo "selected";
                                            } ?>>4
                        </option>
                        <option value="5" <?php if (5 == $informacao_imovel_usuario['qtdsalas']) {
                                                echo "selected";
                                            } ?>>5
                        </option>
                    </select>


                    <h3>Quantidade de Banheiros</h3>
                    <select name="qtd_banheiros" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdbanheiros']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdbanheiros']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdbanheiros']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdbanheiros']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                        <option value="4" <?php if (4 == $informacao_imovel_usuario['qtdbanheiros']) {
                                                echo "selected";
                                            } ?>>4
                        </option>
                        <option value="5" <?php if (5 == $informacao_imovel_usuario['qtdbanheiros']) {
                                                echo "selected";
                                            } ?>>5
                        </option>
                    </select>


                    <h3>Quantidade de Cozinhas</h3>
                    <select name="qtd_cozinhas" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdcozinha']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdcozinha']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdcozinha']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdcozinha']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                    </select>


                    <h3>Quantidade de Area Gourmet</h3>
                    <select name="qtd_areagourmet" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdgourmet']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdgourmet']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdgourmet']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdgourmet']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                    </select>


                    <h3>Quantidade de Piscinas</h3>
                    <select name="qtd_piscinas" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdpiscinas']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdpiscinas']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdpiscinas']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdpiscinas']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                    </select>


                    <h3>Quantidade de Vagas</h3>
                    <select name="qtd_vagasgaragem" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="0" <?php if (0 == $informacao_imovel_usuario['qtdvagas']) {
                                                echo "selected";
                                            } ?>>0
                        </option>
                        <option value="1" <?php if (1 == $informacao_imovel_usuario['qtdvagas']) {
                                                echo "selected";
                                            } ?>>1
                        </option>
                        <option value="2" <?php if (2 == $informacao_imovel_usuario['qtdvagas']) {
                                                echo "selected";
                                            } ?>>2
                        </option>
                        <option value="3" <?php if (3 == $informacao_imovel_usuario['qtdvagas']) {
                                                echo "selected";
                                            } ?>>3
                        </option>
                        <option value="4" <?php if (4 == $informacao_imovel_usuario['qtdvagas']) {
                                                echo "selected";
                                            } ?>>4
                        </option>
                        <option value="5" <?php if (5 == $informacao_imovel_usuario['qtdvagas']) {
                                                echo "selected";
                                            } ?>>5
                        </option>
                    </select>

                    <h3>Link do Tour 3D</h3><input type="url" name="tour" maxlength="100" class="form-alterar-texto" value="<?php echo $informacao_imovel_usuario['tour'] ?>">

                    <h3>Observação Opcional</h3><input type="text" name="observacao" maxlength="500" class="form-alterar-texto" value="<?php echo $informacao_imovel_usuario['obs'] ?>">

                    <h3>Desejo somente vender</h3><input type="checkbox" id="check_venda" onclick="somente_venda(this.checked)" <?php if ($informacao_imovel_usuario['mod_venda'] == 'Venda') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                    <h3>Desejo somente alugar</h3><input type="checkbox" id="check_aluguel" onclick="somente_aluguel(this.checked)" <?php if ($informacao_imovel_usuario['mod_venda'] == 'Aluguel') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                    <h3>Desejo vender e alugar</h3><input type="checkbox" id="check_ambos" onclick="habilitar_ambos(this.checked)" <?php if ($informacao_imovel_usuario['mod_venda'] == 'Ambos') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>


                    <h3>Valor Venda</h3><input type='number' id="venda_id" name='valor_venda' class='form-alterar-texto' value="<?php echo $informacao_imovel_usuario['valor_venda'] ?>" required>

                    <h3>Valor Aluguel</h3> <input type='number' id="aluguel_id" name='valor_aluguel' class='form-alterar-texto' value="<?php echo $informacao_imovel_usuario['valor_aluguel'] ?>" required>
                    <br>
                    <input type="submit" value="Alterar" name="ALTERAR" class="form-send">
                </form>
            </div>
        </div>

        <!-- Adicionando JavaScript -->
        <script type="text/javascript">
            function somente_venda(selecionado) {
                document.getElementById('check_venda').checked = true;
                document.getElementById('check_aluguel').checked = false;
                document.getElementById('check_ambos').checked = false;
                document.getElementById('venda_id').disabled = false;
                document.getElementById('aluguel_id').disabled = selecionado;
                document.getElementById('aluguel_id').value = '';
                document.getElementById('aluguel_id').placeholder = 'Não está para alugar';
                document.getElementById('venda_id').placeholder = 'Digite o valor';
            }

            function somente_aluguel(selecionado) {
                document.getElementById('check_venda').checked = false;
                document.getElementById('check_aluguel').checked = true;
                document.getElementById('check_ambos').checked = false;
                document.getElementById('aluguel_id').disabled = false;
                document.getElementById('venda_id').disabled = selecionado;
                document.getElementById('venda_id').value = '';
                document.getElementById('venda_id').placeholder = 'Não está para venda';
                document.getElementById('aluguel_id').placeholder = 'Digite o valor';
            }

            function habilitar_ambos(selecionado) {
                document.getElementById('check_venda').checked = false;
                document.getElementById('check_aluguel').checked = false;
                document.getElementById('check_ambos').checked = true;
                document.getElementById('venda_id').disabled = false;
                document.getElementById('aluguel_id').disabled = false;
                document.getElementById('venda_id').placeholder = 'Digite o valor';
                document.getElementById('aluguel_id').placeholder = 'Digite o valor';
            }
        </script>

        <?php
        require_once("rodape.php");
        ?>
    </div>
</body>

</html>