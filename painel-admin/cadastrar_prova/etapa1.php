<?php
    include "../../conexao.php";

    session_start();

    $area = $_POST['area'];
    $ano = $_POST['ano'];

    $stt = $mysqli->query("SELECT prova.* FROM prova, area WHERE area.nome = '$area' AND ano = $ano AND prova.id_area = area.id;");
    $dados = $stt->fetch_assoc();
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova prova - estudaEnade</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="cadastrar_prova.css">
</head>
<body>
    <?php include "../navbar.php"; ?>
    
    <div class="wrapper">
        <div class="bloco">
            <?php
                if (mysqli_num_rows($stt)) {
                    if ($_SESSION['usuario']['email'] != $dados['email_admin']) {
                        echo "<h2 class='titulo'>Enade $ano</h2>";
                        echo "<h1 class='titulo'>$area</h1>";
                        echo "<p><i class='fa-solid fa-lock'></i> Essa prova é gerenciada por outro administrador.</p>";
                        echo "<a href='./'><i class='fa-regular fa-arrow-left'></i> Voltar</a>";
                    } else {
                        echo "<h2 class='titulo'>Enade $ano</h2>";
                        echo "<h1 class='titulo'>$area</h1>";
            
                        $id_prova = $dados['id'];
                        $stt = $mysqli->query("SELECT * FROM questao WHERE id_prova = $id_prova ORDER BY numero;");
                        $questao = $stt->fetch_assoc();
                        if (mysqli_num_rows($stt) == 40) {
                            echo "<p>Essa prova já possui <b>40 questões</b>. Deseja fazer alterações?</p>";
                            echo "<form method='POST' action='etapa2.php'>";
                                echo "<input type='hidden' name='id_questao' value='".$questao['id']."'>";
                                echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                                echo "<input type='hidden' name='area' value='".$area."'>";
                                echo "<input type='hidden' name='ano' value='".$ano."'>";
                                echo "<input type='hidden' name='pag' value='1'>";
                                echo "<button class='botao azul2' type='submit'>Continuar <i class='fa-regular fa-arrow-right'></i></button>";
            
                                echo "<a class='botao' href='./'><i class='fa-regular fa-arrow-left'></i> Voltar</a>";
                            echo "</form>";
                        } else {
                            echo "<p>Essa prova já tem <b>".mysqli_num_rows($stt)."/40 questões</b>. Continuar seu cadastro?</p>";
                            echo "<form method='POST' action='etapa2.php'>";
                                if (isset($questao['id']))
                                    echo "<input type='hidden' name='id_questao' value='".$questao['id']."'>";
                                echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                                echo "<input type='hidden' name='area' value='".$area."'>";
                                echo "<input type='hidden' name='ano' value='".$ano."'>";
                                echo "<input type='hidden' name='pag' value='1'>";
                                echo "<button class='botao azul2' type='submit'>Continuar <i class='fa-regular fa-arrow-right'></i></button>";
            
                                echo "<a href='./'><i class='fa-regular fa-arrow-left'></i> Voltar</a>";
                            echo "</form>";
                        }
                    }
                } else {
                    $stt = $mysqli->prepare("SELECT id FROM area WHERE nome = ?;");
                    $stt->bind_param("s", $area);
                    $stt->execute();
                    $res = $stt->get_result();
                    $dados_area = $res->fetch_assoc();
                    $id_area = $dados_area['id'];
                    $stt = $mysqli->prepare("INSERT INTO prova (ano, email_admin, id_area) VALUES ($ano, ?, $id_area);");
                    $stt->bind_param("s", $_SESSION['usuario']['email']);
                    $stt->execute();
                    $stt = $mysqli->query("SELECT prova.* FROM prova, area WHERE area.nome = '$area' AND ano = $ano AND prova.id_area = area.id;");
                    $dados = $stt->fetch_assoc();
                    echo "<h2 class='titulo'>Enade $ano</h2>";
                    echo "<h1 class='titulo'>$area</h1>";
                    echo "<p>Cada prova do Enade possui <b>40 questões</b>. Deseja prosseguir com o seu cadastro?</p>";
                    echo "<form method='POST' action='etapa2.php'>";
                        echo "<div class='field'>";
                            echo "<input type='hidden' name='id_prova' value='".$dados['id']."'>";
                            echo "<input type='hidden' name='area' value='".$area."'>";
                            echo "<input type='hidden' name='ano' value='".$ano."'>";
                            echo "<input type='hidden' name='pag' value='1'>";
                            echo "<input type='submit' value='Sim'>";
                            echo "<a href='../index.php'>Voltar para o painel</a>";
                        echo "</div>";
                    echo "</form>";
                }
            ?>
        </div>
    </div>
</body>
</html>
