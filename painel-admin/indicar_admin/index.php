<?php
    include "../../conexao.php";

    session_start();

    $stt1 = $mysqli->query("SELECT * FROM administrador WHERE 
    (nome_completo IS NOT NULL || nome_completo != '') && 
    (senha IS NOT NULL || senha != '') && 
    (instituicao IS NOT NULL || instituicao != '') && 
    (escolaridade IS NOT NULL || escolaridade != '') && 
    (profissao IS NOT NULL || profissao != '');");
    $admins = $stt1->fetch_assoc();

    $stt2 = $mysqli->query("SELECT * FROM administrador WHERE 
    (nome_completo IS NULL || nome_completo = '') && 
    (senha IS NULL || senha = '') && 
    (instituicao IS NULL || instituicao = '') && 
    (escolaridade IS NULL || escolaridade = '') && 
    (profissao IS NULL || profissao = '');");
    $admins_indic = $stt2->fetch_assoc();
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indicar Administrador - estudaEnade</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="cadastrar_prova.css">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <div class="wrapper">
        <div class="bloco">
            <h1 class="titulo">Indicar novo admin</h1>

            <form action="indicar_admin.php" method="post">
                <?php
                    if (isset($_SESSION['indicado'])) {
                        if ($_SESSION['indicado'])
                            echo "<p class='msg success'><i class='fa-regular fa-check'></i> Administrador indicado com sucesso!</p>";
                        unset($_SESSION['indicado']);
                    }
                    if (isset($_SESSION['ja_indicado'])) {
                        if ($_SESSION['ja_indicado'])
                            echo "<p class='msg error'><i class='fa-regular fa-times'></i> Esse usuário já é administrador ou já foi indicado.</p>";
                        unset($_SESSION['ja_indicado']);
                    }
                ?>

                <p>Digite o e-mail do administrador a ser indicado por você! O e-mail não pode estar já cadastrado/indicado.</p>

                <div class="field">
                    <label for="email_indicado_id">E-mail: </label>
                    <input type="email" name="email_indicado" id="email_indicado_id">
                </div>

                <button class='botao azul1' type="submit">Indicar <i class='fa-regular fa-arrow-right'></i></button>
            </form>

            <div class="administradores">
                <div class="admins">
                    <h2>Administradores</h2>

                    <ul>
                        <?php
                            if (!mysqli_num_rows($stt1)) {
                                echo "<li><b>Não foi possível listar os administradores.</b></li>";
                            } else {
                                $i = 0;
                                foreach ($stt1 as $key => $adm) {
                                    $i++;
                                    echo "<li>".$adm['nome_completo']."</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="indicados">
                    <h2>Indicados</h2>
                    <ul>
                        <?php
                            if (!mysqli_num_rows($stt2)) {
                                echo "<li><b>Nenhum administrador indicado no momento.</b></li>";
                            } else {
                                $i = 0;
                                foreach ($stt2 as $key => $indicado) {
                                    $i++;
                                    echo "<li>".$indicado['email']."</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bloco">
            <h1 class='titulo'>Indiquei, e agora?</h1>
            
            <div class="instrucoes">
                <p>Agora que você indicou um novo administrador, ele precisa entrar no site usando o e-mail que você digitou aqui. Lá, ele poderá continuar com o seu cadastro.</p>
                <p>Lembre-se, também, de que o indicado é recomendado a não ter uma conta de estudante. </p>
            </div>
        </div>
    </div>
</body>
</html>
