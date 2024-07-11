<?php
    include "../../conexao.php";

    session_start();

    function isStarred($id_prova) {
        include "../../conexao.php";

        if (isset($_SESSION) && isset($_SESSION['usuario'])) {
            $email = $_SESSION['usuario']['email'];

            $stt = $mysqli->query("SELECT * FROM provas_salvas WHERE email_estudante = '$email' && id_prova = $id_prova;");
            
            return mysqli_num_rows($stt);
        } else {
            return 0;
        }
    }

    $email_estudante = $_SESSION['usuario']['email'];
    $stt1 = $mysqli->query("SELECT provas_salvas.*, prova.*, area.nome AS area, COUNT(questao.id) AS qtd_questoes FROM provas_salvas, prova, area, questao WHERE provas_salvas.id_prova = prova.id && prova.id_area = area.id && questao.id_prova = prova.id && provas_salvas.email_estudante = '$email_estudante' GROUP BY prova.id ORDER BY area, ano DESC;");
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provas salvas - estudaEnade</title>
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="provas_salvas.css">
</head>
<body>
    <?php include "../navbar.php"; ?>
    
    <div class="wrapper">
        <div class="bloco provas-salvas">
            <h1 class="titulo">Provas salvas</h1>

            <ul class="provas">
                <?php
                    if (!mysqli_num_rows($stt1)) {
                        echo <<<HTML
                            <div class="no-regs">
                                <i class="fa-duotone fa-ghost icon"></i>
                                <p>Não tem provas salvas por aqui ainda...</p>

                                <a href="../../provas/">Explore a seção de provas! </a>
                            </div>
                        HTML;
                    }

                    $i = 0;
                    foreach ($stt1 as $key => $prova) {
                        $i++;
                        echo "<li class='prova-container'>";
                            echo "<div class='header'>";
                                echo "<div class='titulo'>";
                                    echo "<p class='numero' title='ID da prova'>Prova #".$prova['id']."</p>";

                                echo "</div>";

                                echo "<div class='titulo'>";
                                    echo "<p class='ano'>Enade ".$prova['ano']." - </p>";
                                    echo "<p class='area'>".$prova['area']."</p>";
                                echo "</div>";

                            echo "</div>";

                            // echo "<p><b>".$prova['numero'].")</b> ".$prova['enunciado']."</p>";
                            
                            echo "<p><b>".$prova['qtd_questoes']." questões</b></p>";

                            echo "<form method='get' action='../../prova/'>";
                                echo "<input type='hidden' name='id' value='".$prova['id']."'>";
                                echo "<button class='botao azul2' type='submit'>Responder <i class='fa-regular fa-arrow-right'></i></button>";
                            echo "</form>";

                            echo "<div class='options'>";
                    
                                if (isset($_SESSION) && isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == "Estudante") {
                                    echo "<form action='salvar_prova.php' method='POST'>";
                                            echo "<input type='hidden' name='id_prova' value='".$prova['id']."'>";
                    
                                        if (isStarred($prova['id']))
                                            echo "<button type='submit'><i class='fa-solid fa-bookmark-slash'></i></button>";
                                        else
                                            echo "<button type='submit'><i class='fa-regular fa-bookmark'></i></button>";
                                    echo "</form>";
                                }
                    
                                echo "<form action='#' method='POST'>";
                                    echo "<input type='hidden' name='id_prova' value='".$prova['id']."'>";
                                    echo "<button type='submit'><i class='fa-solid fa-triangle-exclamation'></i></button>";
                                echo "</form>";
                            echo "</div>";
                        echo "</li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
