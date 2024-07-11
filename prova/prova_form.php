<?php
    include "../conexao.php";

    include_once "../config.php";
    
    session_start();

    if (isset($_SESSION) && isset($_SESSION['usuario'])) {
        // echo "Olá, <b>".$_SESSION['usuario']['nome_completo']."</b>!<br><hr>";
    }

    $id_questao = $_GET['id_questao'];
    $id_prova = $_GET['id_prova'];

    $query = "SELECT questao.*, area.nome AS area, prova.ano FROM questao, area, prova WHERE questao.id_prova = prova.id && prova.id_area = area.id && questao.id = $id_questao && questao.id_prova = $id_prova;";

    $res = $mysqli->query($query);

    $dados = $res->fetch_assoc();

    $title;
    //DEFININDO TITULO DA PAGINA
    if (!mysqli_num_rows($res))  {
        $title = "Questão (Erro) - estudaEnade";
    } else {
        $title = "Questão ".$dados['numero']." - Prova #".$dados['id_prova']." - estudaEnade";
    }

    
    function isAnswered($id_questao, $email_estudante) {
        include "../conexao.php";

        $stt = $mysqli->query("SELECT * FROM questoes_estudantes WHERE email_estudante = '$email_estudante' && id_questao = $id_questao;");

        return mysqli_num_rows($stt);
    }



    function isStarred($id_questao) {
        include "../conexao.php";

        if (isset($_SESSION) && isset($_SESSION['usuario'])) {
            $email = $_SESSION['usuario']['email'];

            $stt = $mysqli->query("SELECT * FROM questoes_salvas WHERE email_estudante = '$email' && id_questao = $id_questao;");
            
            return mysqli_num_rows($stt);
        } else {
            return 0;
        }
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="prova.css">
    <title><?php echo $title; ?></title>
</head>
<body class='site'>
    <?php include "../navbar.php"; ?>

    <div class='site-content'>
        <div class="wrapper">
            <div class="questao-container">
                <!-- erro de indice no link -->
                <?php
                    if (!mysqli_num_rows($res)) {
                        echo "<p>Ops! Não encontramos nenhuma questão de ID #".$_GET['id_questao']."</p>";
                        echo <<<HTML
                            <p>Que tal tentar outra página?</p>
                            <ul>
                                <li><a href="../questoes/questoes_page.php">Ir para questões</a></li>
                                <li><a href="../home/home_page.php">Página inicial</a></li>
                            </ul>
                            <p>Deseja reportar algum problema?</p>
            
                            <form action="" method="POST">
                                <div class="field">
                                    <label for="problema_id">Relatório: </label>
                                    <textarea name="problema" id="problema_id" cols="30" rows="10" placeholder="Descreva detalhadamente aqui o problema"></textarea>
                                </div>
                                <input type="submit" value="Enviar">
                            </form>
                            <!-- fechando tags pais -->
                            </div>
                            </body>
                            </html>
                        HTML;
            
                        exit;
                    }
                ?>

                <div class="header">
                    <h1>Enade <?php echo $dados['ano'] . " - " . $dados['area']; ?></h1>
                    <!-- status de questão se já foi respondida ou não -->
                    <?php
                        if (isset($_SESSION) && isset($_SESSION['usuario'])) {
                            $email_estudante = $_SESSION['usuario']['email'];
                            $stt = $mysqli->prepare("SELECT * FROM questoes_estudantes WHERE email_estudante = '$email_estudante' AND id_questao = $id_questao;");
                            $stt->execute();
                            $res = $stt->get_result();
                            if (mysqli_num_rows($res)) {
                                echo "<div class='titulo'>";
                                    echo "<p class='id' title='ID da questão'>#".$_GET['id_questao']."</p>";
                                    echo "<p class='numero'>Questão ".$_GET['pag']."</p>";
                                    echo "<p class='done'><i class='fa-regular fa-check'></i> Já respondida</p>";
                                echo "</div>";
                            } else {
                                echo "<div class='titulo'><p class='numero'>Questão ".$_GET['pag']."</p></div>";
                            }
                        } else {
                            echo "<div class='titulo'><p class='numero'>Questão ".$_GET['pag']."</p></div>";
                        }
                    ?>
                </div>

                <p class="enunciado"><?php echo $dados['enunciado']?></p>

                <?php
                    if (!is_null($dados['imagem']) && !empty($dados['imagem']))
                        echo "<img class='imagem' src='../img/questoes/".$dados['imagem']."'>";
                ?>

                <form class='alternativas' method="POST" action="questao.php">
                    <input type="hidden" name="id_questao" value="<?php echo $dados['id']; ?>">
                    <input type="hidden" name="id_prova" value="<?php echo $dados['id_prova']; ?>">
                    <input type="hidden" name="pag" value="<?php echo $_GET['pag']; ?>">
                    <?php
                        if ($dados['tipo'] == 'A')
                            include "./alternativa.php";
                        else
                            include "./dissertativa.php";
                    ?>
                </form>

                <div class="options">
                    <?php
                        if (isset($_SESSION) && isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == "Estudante") {
                            echo "<form action='salvar_questao.php' method='POST'>";
                                echo "<input type='hidden' name='id_questao' value='".$_GET['id_questao']."'>";
                    
                                if (isStarred($_GET['id_questao']))
                                    echo "<button class='flag flag-on' type='submit'><i class='fa-solid fa-bookmark'></i></button>";
                                else
                                    echo "<button class='flag flag-off' type='submit'><i class='fa-regular fa-bookmark'></i></button>";
                            echo "</form>";
                        }
                    ?>
                </div>
            </div>
            
            <div class="paginas">
                <p class='titulo'>Páginas</p>

                <ul>
                    <?php
                        $query = mysqli_query($con, "SELECT * FROM questao WHERE id_prova = $id_prova ORDER BY numero ASC;");
                        
                        $i = 0;
                        while ($dados = mysqli_fetch_assoc($query)) {
                            $i++;

                            echo "<li>";
                                echo "<form method='GET' action=''>";
                                    if (isset($_SESSION) && isset($_SESSION['usuario'])) {
                                        if ($_GET['pag'] == $i) {
                                            if (isAnswered($dados['id'], $_SESSION['usuario']['email'])) {
                                                echo "<input type='hidden' name='pag' value='".$i."'>";
                                                echo "<input type='hidden' name='id_prova' value='".$dados['id_prova']."'>";
                                                echo "<input type='hidden' name='id_questao' value='".$dados['id']."'>";
                                                echo "<button class='pg-atual feita' type='submit'>".$i."</button>";
                                            } else {
                                                echo "<input type='hidden' name='pag' value='".$i."'>";
                                                echo "<input type='hidden' name='id_prova' value='".$dados['id_prova']."'>";
                                                echo "<input type='hidden' name='id_questao' value='".$dados['id']."'>";
                                                echo "<button class='pg-atual' type='submit'>".$i."</button>";
                                            }
                                        } else {
                                            if (isAnswered($dados['id'], $_SESSION['usuario']['email'])) {
                                                echo "<input type='hidden' name='pag' value='".$i."'>";
                                                echo "<input type='hidden' name='id_prova' value='".$dados['id_prova']."'>";
                                                echo "<input type='hidden' name='id_questao' value='".$dados['id']."'>";
                                                echo "<button class='feita' type='submit'>".$i."</button>";
                                            } else {
                                                echo "<input type='hidden' name='pag' value='".$i."'>";
                                                echo "<input type='hidden' name='id_prova' value='".$dados['id_prova']."'>";
                                                echo "<input type='hidden' name='id_questao' value='".$dados['id']."'>";
                                                echo "<button type='submit'>".$i."</button>";
                                            }
                                        }
                                    } else {
                                        if ($_GET['pag'] == $i) {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden' name='id_prova' value='".$dados['id_prova']."'>";
                                            echo "<input type='hidden' name='id_questao' value='".$dados['id']."'>";
                                            echo "<button class='pg-atual' type='submit'>".$i."</button>";
                                        } else {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden' name='id_prova' value='".$dados['id_prova']."'>";
                                            echo "<input type='hidden' name='id_questao' value='".$dados['id']."'>";
                                            echo "<button type='submit'>".$i."</button>";
                                        }
                                    }
                                echo "</form>";
                            echo "</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>

        <?php include "../footer.php"; ?>
    </div>
</body>
</html>
