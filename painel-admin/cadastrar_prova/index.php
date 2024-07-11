<?php
    include "../../conexao.php";

    session_start();

    $stt = $mysqli->query("SELECT * FROM area;");

    // $stt2 = $mysqli->query("SELECT prova.*, area.nome AS area FROM prova, area WHERE prova.id_area = area.id ORDER BY area, ano DESC;");
    $stt2 = $mysqli->query("SELECT prova.*, area.nome AS area, COUNT(questao.id) AS qtd_questoes FROM prova, area, questao WHERE prova.id_area = area.id && questao.id_prova = prova.id GROUP BY prova.id ORDER BY area, ano DESC;");
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova prova - estudaEnade</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="cadastrar_prova.css">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <div class="wrapper">
        <div class="bloco nova-prova">
            <h1 class='titulo'>Nova prova Enade</h1>
            
            <form method="POST" action="etapa1.php">
                <div class="field">
                    <label for="ano_id">Ano: </label>
                    <input type="number" name="ano" id="ano_id" required>
                </div>
                <div class="field">
                    <select name="area" id="area_id" required>
                        <?php
                            if (!mysqli_num_rows($stt)) {
                                echo "Áreas do conhecimento não encontradas.";
                            } else {
                                $i = 0;
                                foreach ($stt as $key => $area) {
                                    $i++;
                                    echo "<option value='".$area['nome']."'>".$area['nome']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <button class="botao azul2" type="submit">Prosseguir <i class="fa-regular fa-arrow-right"></i></button>
                <a class="botao" href="cadastrar_area_page.php">Nova área do conhecimento</a>
            </form>
        </div>

        <div class="bloco provas">
            <h1 class="titulo">Provas</h1>

            <table>
                <thead>
                    <tr>
                        <th colspan="3">Provas</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Ano</th>
                        <th>Área</th>
                        <th>Questões</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($stt2 as $key => $prova) {
                            echo "<tr>";
                                echo "<td>";
                                    if ($prova['email_admin'] == $_SESSION['usuario']['email']) {
                                        echo "<form method='POST' action='etapa1.php'>";
                                            echo "<input type='hidden' name='id_prova' value='".$prova['id']."'>";
                                            echo "<input type='hidden' name='area' value='".$prova['area']."'>";
                                            echo "<input type='hidden' name='ano' value='".$prova['ano']."'>";
        
                                            echo "<button type='submit'><i class='fa-regular fa-pencil'></i></button>";
                                        echo "</form>";
                                    }
                                echo "</td>";
                                echo "<td>".$prova['ano']."</td>";
                                echo "<td>".$prova['area']."</td>";
                                echo "<td>".$prova['qtd_questoes']."</td>";
                                echo "<td>".$prova['email_admin']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
