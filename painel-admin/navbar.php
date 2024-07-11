<?php
    include "../../conexao.php";

    if (!isset($_SESSION))
        session_start();

    $email = $_SESSION['usuario']['email'];

    $nvstt = $mysqli->query("SELECT * FROM administrador WHERE email = '$email';");
    $nvdados = $nvstt->fetch_assoc();
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
                    if (isset($_SESSION['usuario']['foto'])) {
                        echo "<img class='ppic' src='../../img/profile-pics/".$nvdados['foto']."'>";
                    } else {
                        echo "<i class='fa-solid fa-user ppic'></i>";
                    }
                ?>

                <div class="info">
                    <div class="about">
                        <?php
                            $first_name = explode(" ", $nvdados['nome_completo']);
                        ?>
                        <p class="nome"><?php echo $first_name[0]; ?></p>
                    </div>

                    <p class="tipo"><?php echo $nvdados['tipo']; ?></p>
                </div>
            </a>
        </li>

        <li>
            <a href="../../home/"><i class="fa-solid fa-house-chimney icon"></i> Início</a>
        </li>

        <li>
            <a href="../cadastrar_prova/"><i class="fa-solid fa-book-arrow-up icon"></i> Nova prova</a>
        </li>

        <li>
            <a href="../indicar_admin/"><i class="fa-solid fa-user-plus icon"></i> Indicar admin</a>
        </li>

        <!-- <i class="fa-solid fa-circle-bookmark"></i> -->

        
        
        <li>
            <a href="../logout.php"><i class="fa-solid fa-sign-out icon"></i> Sair</a>
        </li>
    </ul>
</nav>
