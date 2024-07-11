<?php
    include "../conexao.php";

    include_once("../config.php");

    session_start();

    if (isset($_SESSION) && isset($_SESSION['usuario'])) {
        // echo "Olá, <b>".$_SESSION['usuario']['nome_completo']."</b>!<br><hr>";
    }



    function queryTopEstudantes() {
        include "../conexao.php";

        $stt = $mysqli->query("SELECT * FROM estudante ORDER BY pontuacao_total DESC;");

        // $top_alunos = $stt->fetch_assoc();

        return $stt;
    }

?>

<html lang="pt-br">
<head>
    <title>Página inicial - estudaEnade</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

    <link rel="stylesheet" href="homepage.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body class="site">
    <?php include '../navbar.php'; ?>

    <div class="site-content">

        <h2 class="mx-auto">Seja bem-vindo(a) ao estudaEnade! Aqui você terá a melhor preparação para a tão conhecida prova ;) Vamos começar com um video explicando um pouco sobre a prova:</h2>
        
        <div class="embed-responsive embed-responsive-16by9 custom-embed mx-auto">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/q9BjYNQTOx8?si=jHmGcSk6vOK0bW_A" allowfullscreen></iframe>
        </div>

        <div class="card mx-auto my-3" style="width: 80%;  background-color: D9DCD6;">
            <div class="card-body">
                <h5 class="card-title">O MELHOR SITE DE ESTUDOS PARA O ENADE!</h5>
                <p class="card-text">Bem-vindo ao seu portal exclusivo para excelência no ENADE! Aqui, oferecemos uma plataforma incomparável, repleta de recursos inteligentes e conteúdo especializado que irá potencializar o seu preparo para o Exame Nacional de Desempenho de Estudantes. </p>
            </div>
        </div>

        <div class="card mx-auto my-3" style="width: 80%;  background-color: D9DCD6;">
            <div class="card-body">
                <h5 class="card-title">COMO FUNCIONA</h5>
                <p class="card-text">Personalize seu plano de estudos, acompanhe seu progresso em tempo real e receba feedback valioso para aprimorar suas habilidades. Descubra como nossa abordagem inovadora torna o aprendizado para o ENADE mais acessível, envolvente e, acima de tudo, eficiente.</p>
            </div>
        </div>

        <div class="card mx-auto my-3" style="height: 5%; width: 40%; background-color: D9DCD6; display: flex; align-items: center;">
            <div class="card-body card-body d-flex align-items-center" style="padding: 1%;">
                <h5 class="card-title text-center text-nowrap my-auto">TOP 3 ALUNOS</h5>
            </div>
        </div>
        
        <div class="card mx-auto" style="width: 80%; background-color: D9DCD6;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <i class="fa-solid fa-ranking-star" style="font-size: 190%;"></i>
                <div class="d-flex">
                    <span class="mr-auto"></span>
                    <i class="fa-solid fa-bullseye" style="font-size: 200%;"></i>
                </div>
            </div>

            <ol class="list-group list-group-flush">
                <?php
                    $top_alunos = queryTopEstudantes();
                    if (!mysqli_num_rows($top_alunos)) {
                        echo "<p><b>Nenhum aluno cadastrado ainda...</b></p>";
                    } else {
                        $i = 0;
                        foreach ($top_alunos as $key => $aluno) {
                            $i++;
                            if ($i <= 3) {
                                if (isset($_SESSION) && isset($_SESSION['usuario'])) {
                                    if ($aluno['nome_completo'] == $_SESSION['usuario']['nome_completo']) {
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                            echo "<b>".$aluno['nome_completo']."</b>";
                                            echo "<b>".$aluno['pontuacao_total']."pts</b>";
                                        echo "</li>";
                                    } else {
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                            echo $aluno['nome_completo'];
                                            echo "<span>".$aluno['pontuacao_total']." pts</span>";
                                        echo "</li>";
                                    }
                                } else {
                                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                        echo $aluno['nome_completo'];
                                        echo "<span>".$aluno['pontuacao_total']." pts</span>";
                                    echo "</li>";
                                }
                            }
                        }
                    }

                ?>
            </ol>
        </div>

        <a class="btn-custom mx-auto" href="../signup/" role="button">CADASTRE-SE JÁ PARA CONHECER MAIS!</a>
    </div>

    <?php include '../footer.php'; ?>

    <!-- <script src="https://kit.fontawesome.com/85b261f1db.js" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <?php include '../libras.php';?>

</body>
</html>
