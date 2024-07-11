<?php
    include "../../conexao.php";

    session_start();

    $stt = $mysqli->query("SELECT * FROM area;");
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova área do conhecimento - estudaEnade</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="cadastrar_prova.css">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <div class="wrapper">
        <div class="bloco">
            <h1 class="titulo">Nova área do conhecimento</h1>

            <form method="POST" action="cadastrar_area.php">
                <?php
                    if (isset($_SESSION['area_ja_existe'])) {
                        if ($_SESSION['area_ja_existe'])
                            echo "<p class='msg error'><i class='fa-regular fa-times'></i> Essa área do conhecimento aparentemente já existe.</p>";
                        unset($_SESSION['area_ja_existe']);
                    }
                    if (isset($_SESSION['area_cadastrada'])) {
                        if ($_SESSION['area_cadastrada'])
                            echo "<p class='msg success'><i class='fa-regular fa-check'></i> Área do conhecimento cadastrada com sucesso!</p>";
                        unset($_SESSION['area_cadastrada']);
                    }
                ?>
                <p><b>OBS.: Não cadastre uma área do conhecimento que já existe. Olhe atentamente para as áreas que já estão cadastradas antes de clicar no botão.</b></p>
                <ul>
                    <?php
                        if (!mysqli_num_rows($stt)) {
                            echo "Áreas do conhecimento não encontradas.";
                        } else {
                            $i = 0;
                            foreach ($stt as $key => $area) {
                                $i++;
                                echo "<li>".$area['nome']."</li>";
                            }
                        }
                    ?>
                </ul>
                <div class="field">
                    <label for="area_id">Nome da área de conhecimento: </label>
                    <input type="text" name="area" id="area_id" required>
                </div>
                <button class="botao azul2" type="submit" value="Cadastrar">Cadastrar <i class="fa-regular fa-arrow-right"></i></button>
                
                <a class="botao" href="./">Voltar ao painel</a>
            </form>
        </div>
    </div>
</body>
</html>
