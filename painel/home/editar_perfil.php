<?php
    include "../../conexao.php";
    session_start();

    $foto = $_POST["foto"];
    $nome = $_POST["nome"];
    $data_nasc = $_POST["data_nasc"];
    $instituicao = $_POST["instituicao"];
    $escolaridade = $_POST["escolaridade"];

    $email_estudante = $_SESSION['usuario']['email'];

    if (isset($foto) && !empty($foto))
        $stt = $mysqli->query("UPDATE estudante SET nome_completo = '$nome', data_nasc = '$data_nasc', instituicao = '$instituicao', escolaridade = '$escolaridade', foto = '$foto' WHERE email = '$email_estudante';");
    else
        $stt = $mysqli->query("UPDATE estudante SET nome_completo = '$nome', data_nasc = '$data_nasc', instituicao = '$instituicao', escolaridade = '$escolaridade' WHERE email = '$email_estudante';");

?>


<html lang="en">
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
