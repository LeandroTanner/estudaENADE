<?php
    include "../conexao.php";

    include_once("../config.php");
    
    session_start();

    if (isset($_SESSION) && isset($_SESSION['usuario'])) {
        echo "Olá, <b>".$_SESSION['usuario']['nome_completo']."</b>!<br><hr>";
    }

    $id_prova = $_GET['id'];

    $res = $mysqli->query("SELECT * FROM questao WHERE id_prova = $id_prova ORDER BY numero ASC;");

    if (!mysqli_num_rows($res)) {
        echo "Não foi possível achar nenhuma questão dessa prova.";
        exit;
    }
    
    $pags = mysqli_num_rows($res);
    $pag_atual = 1;
    
    $_SESSION['pags'] = $pags;

    $questoes = $res->fetch_assoc();

    $primeiro_id = $questoes['id'];

    header("Location: prova_form.php?pag=$pag_atual&id_prova=$id_prova&id_questao=$primeiro_id");
?>
