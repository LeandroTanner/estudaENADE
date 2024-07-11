<?php
    include "../../conexao.php";

    if ($mysqli->connect_errno != 0) {
        echo "erro de conexão<br>";
        echo $mysqli->connect_error;
        exit();
    }

    session_start();

    $email = $_POST['email_indicado'];

    $stt = $mysqli->prepare("SELECT * FROM administrador WHERE email = ?;");
    $stt->bind_param("s", $email);
    $stt->execute();
    $res = $stt->get_result();

    //checando se usuário já foi indicado/já é admin
    if (!mysqli_num_rows($res)) {
        $stt = $mysqli->prepare("INSERT INTO administrador (email, tipo) VALUES (?, 'Administrador');");
        $stt->bind_param('s', $email);
        $stt->execute();

        $res = $stt->get_result();
        
        $_SESSION['indicado'] = true;

        header("Location: ./");
    } else {
        $_SESSION['ja_indicado'] = true;

        header("Location: ./");
    }
?>
