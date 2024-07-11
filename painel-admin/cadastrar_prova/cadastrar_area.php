<?php
    include "../../conexao.php";

    session_start();

    $area = $_POST['area'];

    $stt = $mysqli->query("SELECT nome FROM area WHERE nome = '$area';");

    if (mysqli_num_rows($stt)) {
        $_SESSION['area_ja_existe'] = true;
        
        header("Location: ./cadastrar_area_page.php");
    } else {
        $stt = $mysqli->prepare("INSERT INTO area (nome, email_admin) VALUES (?, ?);");
        $stt->bind_param("ss", $area, $_SESSION['usuario']['email']);
        $stt->execute();

        $res = $stt->get_result();

        $_SESSION['area_cadastrada'] = true;
        
        header("Location: ./cadastrar_area_page.php");
    }
?>
