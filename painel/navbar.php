<?php
    include "../../conexao.php";

    if (!isset($_SESSION))
        session_start();

    $email = $_SESSION['usuario']['email'];

    $nvstt = $mysqli->query("SELECT * FROM estudante WHERE email = '$email';");
    $nvdados = $nvstt->fetch_assoc();

    // atualizando info
    $_SESSION['usuario']['foto'] = $nvdados['foto'];
    $_SESSION['usuario']['nome_completo'] = $nvdados['nome_completo'];
    $_SESSION['usuario']['pontuacao_total'] = $nvdados['pontuacao_total'];
    $_SESSION['usuario']['data_nasc'] = $nvdados['data_nasc'];
    $_SESSION['usuario']['escolaridade'] = $nvdados['escolaridade'];
    $_SESSION['usuario']['instituicao'] = $nvdados['instituicao'];
?>

<head>
    <link rel="stylesheet" href="../navbar.css">
</head>

<nav>
    <a href="../index.php">
        <h1 class="logo"><i class="fa-solid fa-books icon"></i> estudaEnade</h1>
    </a>

    <ul>
        <li class="user-container">
            <a href="../index.php">
                <?php
                    if (isset($nvdados['foto']) && !empty($nvdados['foto']))
                        echo "<img class='ppic' src='../../img/profile-pics/".$nvdados['foto']."' alt='Foto de perfil'>";
                    else
                        echo "<i class='fa-solid fa-user ppic' alt='Foto de perfil'></i>";
                ?>

                <div class="info">
                    <div class="about">
                        <?php
                            $first_name = explode(" ", $nvdados['nome_completo']);
                        ?>
                        <p class="nome"><?php echo $first_name[0]; ?></p>
                        <p class="pontuacao">+<?php echo $nvdados['pontuacao_total']; ?> pts.</p>
                    </div>

                    <p class="tipo"><?php echo $nvdados['tipo']; ?></p>
                </div>
            </a>
        </li>

        <li>
            <a href="../../home/"><i class="fa-solid fa-house-chimney icon"></i> Início</a>
        </li>

        <li>
            <a href="../questoes-salvas/"><i class="fa-solid fa-bookmark icon"></i> Questões salvas</a>
        </li>

        <li>
            <a href="../provas-salvas/"><i class="fa-solid fa-book-bookmark icon"></i> Provas salvas</a>
        </li>

        <!-- <i class="fa-solid fa-circle-bookmark"></i> -->

        
        
        <li>
            <a href="../logout.php"><i class="fa-solid fa-sign-out icon"></i> Sair</a>
        </li>
    </ul>
</nav>
