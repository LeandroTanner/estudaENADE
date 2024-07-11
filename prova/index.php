<?php
    include "../conexao.php";

    include_once("../config.php");
    
    session_start();

    if (isset($_SESSION) && isset($_SESSION['usuario'])) {
        // echo "Olá, <b>".$_SESSION['usuario']['nome_completo']."</b>!<br><hr>";
    }

    $id_prova = $_GET['id'];

    
    function queryProva($id_prova) {
        include "../conexao.php";

        $stt = $mysqli->query("SELECT prova.*, area.nome AS area FROM prova, area WHERE prova.id_area = area.id && prova.id = $id_prova;");
        
        return $stt;
    }

    $res = queryProva($id_prova);

    $dados = $res->fetch_assoc();

    $title;
    //DEFININDO TITULO DA PAGINA
    if (!mysqli_num_rows($res))  {
        $title = "Prova (Erro) - estudaEnade";
    } else {
        $title = "Prova #".$dados['id']." - estudaEnade";
    }



    function isStarred($id_prova) {
        include "../conexao.php";

        if (isset($_SESSION) && isset($_SESSION['usuario'])) {
            $email = $_SESSION['usuario']['email'];

            $stt = $mysqli->query("SELECT * FROM provas_salvas WHERE email_estudante = '$email' && id_prova = $id_prova;");
            
            return mysqli_num_rows($stt);
        } else {
            return 0;
        }
    }
?>

<html lang="pt-br">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="prova.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body class="site">
    <?php include '../navbar.php'; ?>

    <div class="site-content">
        <!-- FILTRO -->
        <div class="card mx-auto my-3">
            <div class="card-body card-body d-flex align-items-center" style="padding: 1%;">
                <h5 class="card-title mx-auto my-auto"><i class="fa-duotone fa-book-copy"></i> RESPONDER PROVA</h5>
            </div>
        </div>
            
        <div class="card mx-auto">
            <div class="card-body prova-container">
                <p class="id-prova" title="ID da prova">Prova #<?php echo $dados['id']; ?></p>

                <h1 class='card-title'>Enade <?php echo $dados['ano']; ?></h1>
                <h2 class='card-title'><?php echo $dados['area']; ?></h2>
                
                <?php
                    $query = "SELECT COUNT(*) AS qtd FROM questao WHERE id_prova = $id_prova;";
                    $res = $mysqli->query($query);
                    $qtd_questoes = $res->fetch_assoc();

                    if ($qtd_questoes['qtd'] == 1)
                        echo "<p>".$qtd_questoes['qtd']." questão</p>";
                    else
                        echo "<p>".$qtd_questoes['qtd']." questões</p>";
                ?>

                <p>Responda a prova inteira, com todas as questões.</p>

        
                <form action="prova.php" method="GET">
                    <input type="hidden" name="id" value="<?php echo $id_prova; ?>">

                    <button class='botao azul2' type='submit'>Responder <i class='fa-regular fa-arrow-right'></i></button>
                </form>

                <div class="options">
                    <?php
                        if (isset($_SESSION) && isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == "Estudante") {
                            echo "<form action='salvar_prova.php' method='POST'>";
                                echo "<input type='hidden' name='id_prova' value='".$dados['id']."'>";
	
                                if (isStarred($dados['id']))
                                    echo "<button class='flag flag-on' type='submit'><i class='fa-solid fa-bookmark'></i></button>";
                                else
                                    echo "<button class='flag flag-off' type='submit'><i class='fa-regular fa-bookmark'></i></button>";
                            echo "</form>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php include '../footer.php'; ?>

        <!-- <script src="https://kit.fontawesome.com/85b261f1db.js" crossorigin="anonymous"></script> -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <?php include '../libras.php';?>
    </body>
</html>
