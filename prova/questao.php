<?php
    include "../conexao.php";

    include_once("../config.php");

    session_start();

    $email = $_SESSION['usuario']['email'];

    $pag = $_POST['pag'];
    $id_prova = $_POST['id_prova'];
    $id_questao = $_POST['id_questao'];

    //pegando a questao
    $stt1 = $mysqli->prepare("SELECT * FROM questao WHERE id = $id_questao;");
    $stt1->execute();
    $res1 = $stt1->get_result();

    $dados = $res1->fetch_array(MYSQLI_ASSOC);

    //checando se questao é alternativa ou dissertativa

    if (isset($_SESSION) && isset($_SESSION['usuario'])) {
        //verificando se usuario ja fez a questao
        $stt = $mysqli->prepare("SELECT email_estudante FROM questoes_estudantes WHERE email_estudante = ? AND id_questao = ?;");
        $stt->bind_param("si", $email, $id_questao);
        $stt->execute();
        $res = $stt->get_result();
    
        if (mysqli_num_rows($res)) {
            //usuario ja fez a questao
    
            if ($dados['tipo'] == 'A') {
                //QUESTAO ALTERNATIVA
                $alternativa = $_POST['alternativa'];
    
                if ($alternativa != $dados['gabarito']) {
                    $_SESSION['errou'] = true;
                } else {
                    $_SESSION['errou'] = false;
                }
    
                $_SESSION['gabarito'] = $dados['gabarito'];
            } else {
                //QUESTAO DISSERTATIVA
                $_SESSION['comentario'] = $dados['comentario'];
            }
            
            header("Location: ./prova_form.php?pag=$pag&id_prova=$id_prova&id_questao=$id_questao");
        } else {
            //usuario nao fez a questao
    
            if ($dados['tipo'] == 'A') {
                //QUESTAO ALTERNATIVA
                $alternativa = $_POST['alternativa'];
    
                if ($alternativa != $dados['gabarito']) {
                    $_SESSION['errou'] = true;
                    $_SESSION['pontuou'] = false;
                } else {
                    $_SESSION['errou'] = false;
                    $_SESSION['pontuou'] = true;
    
                    $stt = $mysqli->prepare("INSERT INTO questoes_estudantes (email_estudante, id_questao, data_realizacao) VALUES(?, ?, NOW());");
                    $stt->bind_param('si', $email, $id_questao);
                    $stt->execute();
                    
                    //caso precise de alguma verificação
                    $res = $stt->get_result();
    
    
    
                    $ponto_questao = PONTO_QUESTAO;
    
                    $stt = $mysqli->prepare("UPDATE estudante SET pontuacao_total = pontuacao_total + $ponto_questao WHERE email = ?;");
                    $stt->bind_param('s', $email);
                    $stt->execute();
    
                    //caso precise de alguma verificação
                    $res = $stt->get_result();
                }
    
                $_SESSION['gabarito'] = $dados['gabarito'];
            } else {
                //QUESTAO DISSERTATIVA
    
                $stt = $mysqli->prepare("INSERT INTO questoes_estudantes (email_estudante, id_questao, data_realizacao) VALUES(?, ?, NOW());");
                $stt->bind_param('si', $email, $id_questao);
                $stt->execute();
                
                //caso precise de alguma verificação
                $res = $stt->get_result();
    
                $_SESSION['comentario'] = $dados['comentario'];
            }
    
            header("Location: ./prova_form.php?pag=$pag&id_prova=$id_prova&id_questao=$id_questao");
        }
    } else {
        if ($dados['tipo'] == 'A') {
            //QUESTAO ALTERNATIVA
            $alternativa = $_POST['alternativa'];

            if ($alternativa != $dados['gabarito']) {
                $_SESSION['errou'] = true;
            } else {
                $_SESSION['errou'] = false;
            }

            $_SESSION['gabarito'] = $dados['gabarito'];
        } else {
            //QUESTAO DISSERTATIVA
            $_SESSION['comentario'] = $dados['comentario'];
        }


        // if ($alternativa != $dados['gabarito']) {
        //     $_SESSION['errou'] = true;
        //     $_SESSION['gabarito'] = $dados['gabarito'];
        // } else {
        //     $_SESSION['errou'] = false;
        //     $_SESSION['gabarito'] = $dados['gabarito'];
        // }

        header("Location: ./prova_form.php?pag=$pag&id_prova=$id_prova&id_questao=$id_questao");
    }
    
?>
