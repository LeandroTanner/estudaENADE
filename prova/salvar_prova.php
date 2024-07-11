<?php
    include "../conexao.php";
    
    session_start();

    if (!isset($_POST['id_prova'])) {
        echo "Erro. Não foi possível achar a questão.";
        exit;
    }
    
    $id_prova = $_POST['id_prova'];

    if (!isset($_SESSION) && !isset($_SESSION['usuario'])) {
        echo "não foi possível salvar a questão.";
    } else {
        $email_estudante = $_SESSION['usuario']['email'];
        $stt = $mysqli->query("SELECT * FROM provas_salvas WHERE email_estudante = '$email_estudante' && id_prova = $id_prova;");

        if (mysqli_num_rows($stt)) {
            $stt = $mysqli->query("DELETE FROM provas_salvas WHERE email_estudante = '$email_estudante' && id_prova = $id_prova;");
        } else {
            $stt = $mysqli->query("INSERT INTO provas_salvas (email_estudante, id_prova) VALUES ('$email_estudante', $id_prova);");
        }
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estudaEnade</title>
</head>
<body>
    <script>
        function voltar() {
            window.history.go(-1);
            return false;
        }

        voltar();
    </script>
</body>
</html>
