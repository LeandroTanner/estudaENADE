<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar questão - estudaEnade</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="cadastrar_prova.css">
    <link rel="stylesheet" href="nova_questao.css">

    <link rel="stylesheet" href="basic-form.css">
</head>
<body>

<?php
    include "../../conexao.php";

    session_start();

    $id_prova = $_POST['id_prova'];
    $ano = $_POST['ano'];
    $area = $_POST['area'];
    $tipo_questao = $_POST['tipo'];
    $enunciado = $_POST['enunciado'];
    $img;
    $alt_a = $_POST['alt_a'];
    $alt_b;
    $alt_c;
    $alt_d;
    $alt_e;
    

    // var_dump($img);
    // exit;

    $gabarito;
    $comentario;

    if (isset($_POST['alt_b']))
        $alt_b = $_POST['alt_b'];
    
    if (isset($_POST['alt_c']))
        $alt_c = $_POST['alt_c'];

    if (isset($_POST['alt_d']))
        $alt_d = $_POST['alt_d'];

    if (isset($_POST['alt_e']))
        $alt_e = $_POST['alt_e'];

    if (isset($_POST['gabarito']))
        $gabarito = $_POST['gabarito'];

    if (isset($_POST['comentario']))
        $comentario = $_POST['comentario'];

    if (isset($_POST['imagem']))
        $img = $_POST['imagem'];
    
    $pag = $_POST['pag'];
    
    if (isset($_POST['id_questao'])) {
        $id_questao = $_POST['id_questao'];

        if ($tipo_questao == 'A') {
            //TIPO DE QUESTAO ALTERNATIVA
            $stt = $mysqli->prepare("UPDATE questao SET enunciado = ?, alternativa_a = ?, alternativa_b = ?, alternativa_c = ?, alternativa_d = ?, alternativa_e = ?, imagem = ?, gabarito = ?, tipo = ? WHERE id = $id_questao;");
            $stt->bind_param("sssssssss", $enunciado, $alt_a, $alt_b, $alt_c, $alt_d, $alt_e, $img, $gabarito, $tipo_questao);
            $stt->execute();

            $_SESSION['questao_salva'] = true;
            // header("Location: etapa2.php");
        } else {
            //TIPO DE QUESTAO DISSERTATIVA
            
            $stt = $mysqli->prepare("UPDATE questao SET enunciado = ?, alternativa_a = ?, alternativa_b = ?, alternativa_c = ?, alternativa_d = ?, alternativa_e = ?, imagem = ?, comentario = ?, tipo = ? WHERE id = $id_questao;");
            $stt->bind_param("sssssssss", $enunciado, $alt_a, $alt_b, $alt_c, $alt_d, $alt_e, $img, $comentario, $tipo_questao);
            $stt->execute();

            $_SESSION['questao_salva'] = true;
            // header("Location: etapa2.php");
        }
        
        echo "<div class='update-feedback-container'>";
            echo "<p class='msg success'><i class='fa-regular fa-check'></i> Questão ".$pag." atualizada com sucesso!</p>";

            echo "<form method='POST' action='etapa2.php'>";
                echo "<input type='hidden' name='pag' value='".$pag."'>";
                echo "<input type='hidden' name='area' value='".$area."'>";
                echo "<input type='hidden' name='ano' value='".$ano."'>";
                echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                echo "<input type='hidden' name='id_questao' value='".$id_questao."'>";
                echo "<button class='voltar' type='submit'><i class='fa-regular fa-arrow-left'></i> Voltar</button>";
            echo "</form>";
        echo "</div>";
    } else {
        if ($tipo_questao == 'A') {
            //QUESTAO ALTERNATIVA

            $stt = $mysqli->query("SELECT numero FROM questao WHERE numero = $pag AND id_prova = $id_prova;");
            if (!mysqli_num_rows($stt)) {
                $stt = $mysqli->prepare("INSERT INTO questao (enunciado, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, imagem, gabarito, id_prova, tipo, numero) VALUES(?, ?, ?, ?, ?, ?, ?, ?, $id_prova, '$tipo_questao', $pag);");
                $stt->bind_param("ssssssss", $enunciado, $alt_a, $alt_b, $alt_c, $alt_d, $alt_e, $img, $gabarito);
                $stt->execute();
    
            }
            $_SESSION['questao_salva'] = true;

            $stt = $mysqli->query("SELECT id FROM questao WHERE numero = $pag AND id_prova = $id_prova;");
            $dados = $stt->fetch_assoc();

            $id_questao = $dados['id'];
        } else {
            //QUESTAO DISSERTATIVA

            $stt = $mysqli->query("SELECT numero FROM questao WHERE numero = $pag AND id_prova = $id_prova;");
            if (!mysqli_num_rows($stt)) {
                $stt = $mysqli->prepare("INSERT INTO questao (enunciado, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, imagem, comentario, id_prova, tipo, numero) VALUES(?, ?, ?, ?, ?, ?, ?, ?, $id_prova, '$tipo_questao', $pag);");
                $stt->bind_param("ssssssss", $enunciado, $alt_a, $alt_b, $alt_c, $alt_d, $alt_e, $img, $comentario);
                $stt->execute();
            }

            $_SESSION['questao_salva'] = true;

            $stt = $mysqli->query("SELECT id FROM questao WHERE numero = $pag AND id_prova = $id_prova;");
            $dados = $stt->fetch_assoc();

            $id_questao = $dados['id'];
        }
        
        echo "<div class='update-feedback-container'>";
            echo "<p class='msg success'><i class='fa-regular fa-check'></i> Questão ".$pag." cadastrada com sucesso!</p>";

            echo "<form method='POST' action='etapa2.php'>";
                echo "<input type='hidden' name='pag' value='".$pag."'>";
                echo "<input type='hidden' name='area' value='".$area."'>";
                echo "<input type='hidden' name='ano' value='".$ano."'>";
                echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                echo "<input type='hidden' name='id_questao' value='".$id_questao."'>";
                echo "<button class='voltar' type='submit'><i class='fa-regular fa-arrow-left'></i> Voltar</button>";
            echo "</form>";
        echo "</div>";
    }
?>
</body>
</html>