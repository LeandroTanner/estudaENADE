<?php
    include "../../conexao.php";

    include_once "../../config.php";

    session_start();

    $email = $_SESSION['usuario']['email'];

    $stt1 = $mysqli->query("SELECT * FROM administrador WHERE email = '$email';");
    $res1 = $stt1->fetch_assoc();

    //atualizando info do usuario
    $_SESSION['usuario']['foto'] = $res1['foto'];
    $_SESSION['usuario']['nome_completo'] = $res1['nome_completo'];
    $_SESSION['usuario']['data_nasc'] = $res1['data_nasc'];
    $_SESSION['usuario']['escolaridade'] = $res1['escolaridade'];
    $_SESSION['usuario']['instituicao'] = $res1['instituicao'];
    $_SESSION['usuario']['profissao'] = $res1['profissao'];
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estudaEnade - Painel</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="perfil.css">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <div class="wrapper">
        <div class="bloco perfil">
            <h1 class="titulo">Perfil <i title="Editar perfil" class='fa-solid fa-pen editar'></i></h1>

            <form method="POST" action="editar_perfil.php">
                <div class="bloquinhos">
                    <div class="foto-nome bloquinho">
                        <div class="field foto-container">
                            <?php
                                if (isset($res1['foto']) && !empty($res1['foto']))
                                    echo "<img class='ppic' src='../../img/profile-pics/".$res1['foto']."' alt='Foto de perfil'>";
                                else
                                    echo "<i class='fa-solid fa-user ppic' alt='Foto de perfil'></i>";
                            ?>

                            <label class='lbl-foto' for="foto_id">Foto de perfil: </label>
                            <input class="foto desabilitado" type="file" name="foto" id="foto_id" disabled>
                        </div>
                    
                        <div class="field">
                            <p class="saudacao">Olá, </p>
                    
                            <div class="nome">
                                <?php
                                    echo "<div class='edit-mode'>";
                                        echo "<input class='nome desabilitado' type='text' name='nome' id='nome_id' value='".$_SESSION['usuario']['nome_completo']."' disabled required>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="about bloquinho">
                        <h3>Suas informações: </h3>

                        <div class="field">
                            <label for="email_id"><i class="fa-duotone fa-lock"></i> E-mail: </label>
                            <div class="email">
                                <?php
                                    echo "<div class='edit-mode email-field'>";
                                        echo "<input class='desabilitado' type='text' name='email' id='email_id' value='".$_SESSION['usuario']['email']."' disabled required>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="data_nasc_id">Data de nascimento: </label>
                            <div class="data_nasc">
                                <?php
                                    echo "<div class='edit-mode'>";
                                        echo "<input class='desabilitado' type='date' name='data_nasc' id='data_nasc_id' value='".$_SESSION['usuario']['data_nasc']."' disabled required>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="escolaridade_id">Escolaridade: </label>
                            <div class="escolaridade">
                                <?php
                                    echo "<div class='edit-mode'>";
                                        echo "<input class='desabilitado' type='text' name='escolaridade' id='escolaridade_id' value='".$_SESSION['usuario']['escolaridade']."' disabled required>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="profissao_id">Profissão: </label>
                            <div class="profissao">
                                <?php
                                    echo "<div class='edit-mode'>";
                                        echo "<input class='desabilitado' type='text' name='profissao' id='profissao_id' value='".$_SESSION['usuario']['profissao']."' disabled required>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="instituicao_id">Instituição: </label>
                            <div class="data_nasc">
                                <?php
                                    echo "<div class='edit-mode'>";
                                        echo "<input class='desabilitado' type='text' name='instituicao' id='instituicao_id' value='".$_SESSION['usuario']['instituicao']."' disabled required>";
                                    echo "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="edit-options">
                    <button class="btn red2 close-edit-mode" type="button">Cancelar <i class="fa-regular fa-times"></i></button>
                    <button class="btn blue1 atualizar-perfil" type="submit">Atualizar <i class="fa-regular fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>

    <script src="toggleEditMode.js"></script>
</body>
</html>
