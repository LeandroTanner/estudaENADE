<?php
    include "../../conexao.php";

    session_start();

    // if (!isset($_POST['pag']))
    //     $pag = $_SESSION['pag'];
    // else
    //     $pag = $_POST['pag'];
    $pag = $_POST['pag'];


    // if (!isset($_POST['area']))
    //     $area = $_SESSION['area'];
    // else
    //     $area = $_POST['area'];
    $area = $_POST['area'];

    // if (!isset($_POST['ano']))
    //     $ano = $_SESSION['ano'];
    // else
    //     $ano = $_POST['ano'];
    $ano = $_POST['ano'];

    // if (!isset($_POST['id_prova']))
    //     $id_prova = $_SESSION['id_prova'];
    // else
    //     $id_prova = $_POST['id_prova'];
    $id_prova = $_POST['id_prova'];

    // if (!isset($_POST['id_questao']) && !isset($_SESSION['id_questao']));
    if (!isset($_POST['id_questao'])) {
        // echo $id_questao;
        //questao não existe
    } else {
        // if (!isset($_POST['id_questao']))
        //     $id_questao = $_SESSION['id_questao'];
        // else
        //     $id_questao = $_POST['id_questao'];
        $id_questao = $_POST['id_questao'];
    
        $query = "SELECT * FROM questao WHERE id = $id_questao && id_prova = $id_prova;";
    
        $res = $mysqli->query($query);
    
        $dados_questao = $res->fetch_assoc();
    }
    
    $stt = $mysqli->query("SELECT prova.*, area.nome FROM prova, area WHERE area.nome = '$area' AND ano = $ano AND prova.id_area = area.id;");
    $dados = $stt->fetch_assoc();

    $title = $area . " " . $ano;


    function isAnswered($id_questao, $id_prova, $email_admin) {
        include "../../conexao.php";

        $stt = $mysqli->query("SELECT * FROM questao, prova WHERE questao.id = $id_questao && questao.id_prova = $id_prova && prova.email_admin = '$email_admin';");

        return mysqli_num_rows($stt);
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - estudaEnade</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="../main.css">

    <link rel="stylesheet" href="cadastrar_prova.css">

    <link rel="stylesheet" href="basic-form.css">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <div class="wrapper">
        <div class="bloco">
            <div class="header">
                <p>Você está editando: </p>
                <h1 class='prova-titulo'>Enade <?php echo $ano . " - " . $area?></h1>
            </div>

            <div class="paginas">
                <p class="titulo">Questões</p>

                <ul>
                    <?php
                        $query = mysqli_query($con, "SELECT * FROM questao WHERE id_prova = $id_prova ORDER BY numero ASC;");
                        
                        $total_questoes = mysqli_num_rows($query);
                        
                        $i = 0;
                        while ($questao = mysqli_fetch_assoc($query)) {
                            $i++;

                            echo "<li>";
                                echo "<form method='POST' action=''>";
                                    if ($pag == $i) {
                                        if (isAnswered($questao['id'], $questao['id_prova'], $_SESSION['usuario']['email'])) {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden' name='id_prova' value='".$questao['id_prova']."'>";
                                            echo "<input type='hidden' name='area' value='".$area."'>";
                                            echo "<input type='hidden' name='ano' value='".$ano."'>";
                                            echo "<input type='hidden' name='id_questao' value='".$questao['id']."'>";

                                            echo "<button class='pg-atual feita' type='submit'>".$i."</button>";
                                        } else {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden' name='id_prova' value='".$questao['id_prova']."'>";
                                            echo "<input type='hidden' name='area' value='".$area."'>";
                                            echo "<input type='hidden' name='ano' value='".$ano."'>";
                                            echo "<input type='hidden' name='id_questao' value='".$questao['id']."'>";

                                            echo "<button class='pg-atual' type='submit'>".$i."</button>";
                                        }
                                    } else {
                                        if (isAnswered($questao['id'], $questao['id_prova'], $_SESSION['usuario']['email'])) {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden'  name='id_prova'  value='".$questao['id_prova']."'>";
                                            echo "<input type='hidden' name='area' value='".$area."'>";
                                            echo "<input type='hidden' name='ano' value='".$ano."'>";
                                            echo "<input type='hidden' name='id_questao' value='".$questao['id']."'>";
    
                                            echo "<button class='feita' type='submit'>".$i."</button>";
                                        } else {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden'  name='id_prova'  value='".$questao['id_prova']."'>";
                                            echo "<input type='hidden' name='area' value='".$area."'>";
                                            echo "<input type='hidden' name='ano' value='".$ano."'>";
                                            echo "<input type='hidden' name='id_questao' value='".$questao['id']."'>";
                                            
                                            echo "<button class='' type='submit'>".$i."</button>";
                                        }
                                    }
                                echo "</form>";
                            echo "</li>";
                        }
                        //QUESTÕES NÃO CADASTRADAS
                        if ($total_questoes < 40) {
                            while ($i < $total_questoes + 1) {
                                $i++;

                                echo "<li>";
                                    echo "<form method='POST' action=''>";
                                        if ($pag == $i) {
                                                echo "<input type='hidden' name='pag' value='".$i."'>";
                                                echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                                                echo "<input type='hidden' name='area' value='".$area."'>";
                                                echo "<input type='hidden' name='ano' value='".$ano."'>";
                                                // echo "<input type='text' name='id_questao' value='".$questao['id']."'>";
                                                echo "<button class='pg-atual' type='submit'>".$i."</button>";
                                        } else {
                                            echo "<input type='hidden' name='pag' value='".$i."'>";
                                            echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                                            echo "<input type='hidden' name='area' value='".$area."'>";
                                            echo "<input type='hidden' name='ano' value='".$ano."'>";
                                            echo "<input type='hidden' name='enunciado' value=' '>";
                                            // echo "<input type='text' name='id_questao' value='".$questao['id']."'>";
                                            echo "<button class='' type='submit'>".$i."</button>";
                                        }
                                    echo "</form>";
                                echo "</li>";
                            }
                        }
                    ?>
                </ul>
            </div>

            <div class="container">
                <form action="nova_questao.php" method="POST">
                    <!-- VARIÁVEIS ESCONDIDAS -->
                    <?php
                        echo "<input type='hidden' name='pag' value='".$pag."'>";
                        echo "<input type='hidden' name='id_prova' value='".$id_prova."'>";
                        echo "<input type='hidden' name='ano' value='".$ano."'>";
                        echo "<input type='hidden' name='area' value='".$area."'>";
                        if (isset($id_questao))
                            echo "<input type='hidden' name='id_questao' value='".$id_questao."'>";
                    ?>


                    <!-- feedback mensagens -->
                    <?php
                        if (isset($_SESSION['questao_salva'])) {
                            if ($_SESSION['questao_salva'])
                                echo "<p class='msg success'><i class='fa-regular fa-check'></i> Questão salva!</p>";
                            unset($_SESSION['questao_salva']);
                        }
                    ?>

                    <p><b>Questão <?php echo $pag; ?></b></p>

                    <!-- inicializando tipo de questão -->
                    <div class="tipos-questao">
                        <?php
                            if (isset($id_questao)) {
                                //SE A QUESTÃO EXISTE
                                if ($dados_questao['tipo'] == 'A') {
                                    echo <<<HTML
                                        <button class="tipo-questao btt-a active" type="button" value="alternativa"><i class="fa-solid fa-list-radio"></i> Alternativa</button>
                                        <button class="tipo-questao btt-d" type="button" value="dissertativa"><i class="fa-solid fa-pen-nib"></i> Dissertativa</button>
                                        <input type="hidden" name="tipo" id="tipo_id" value='A'>
                                        <!-- toggleAlternativa() -->
                                    HTML;
                                } else {
                                    echo <<<HTML
                                        <button class="tipo-questao btt-a" type="button" value="alternativa"><i class="fa-solid fa-list-radio"></i> Alternativa</button>
                                        <button class="tipo-questao btt-d active" type="button" value="dissertativa"><i class="fa-solid fa-pen-nib"></i> Dissertativa</button>
                                        <input type="hidden" name="tipo" id="tipo_id" value='D'>
                                        <!-- toggleDissertativa() -->
                                    HTML;
                                }
                            } else {
                                //SE A QUESTÃO NÃO EXISTE
                                echo <<<HTML
                                    <button class="tipo-questao btt-a active" type="button" value="alternativa"><i class="fa-solid fa-list-radio"></i> Alternativa</button>
                                    <button class="tipo-questao btt-d" type="button" value="dissertativa"><i class="fa-solid fa-pen-nib"></i> Dissertativa</button>
                                    <input type="hidden" name="tipo" id="tipo_id" value='A'>
                                    <!-- toggleAlternativa() -->
                                HTML;
                            }
                        ?>
                    </div>

                    <div class="field">
                        <label for="enunciado_id">Enunciado: <span class="obrigatorio">*</span></label>
                        <textarea name="enunciado" id="enunciado_id" cols="30" rows="10" required><?php if (isset($dados_questao['enunciado'])) echo $dados_questao['enunciado']; ?></textarea>
                    </div>

                    <div class="field">
                        <label for="imagem_id">Imagem: </label>

                        <?php
                            if (isset($dados_questao['imagem']) && !is_null($dados_questao['imagem']) && !empty($dados_questao['imagem']))
                                echo "<img src='../../img/questoes/".$dados_questao['imagem']."' alt='Imagem da questão'>";
                        ?>

                        <input type="file" name="imagem" id="imagem_id">
                    </div>

                    <div class="alternativas">
                        <label for="">Alternativas: <span class="obrigatorio">*</span></label>

                        <div class="field alter-a default-alt">
                            <label for="alt_a_id">A) </label>
                            <input placeholder="Alternativa A" type="text" name="alt_a" id="alt_a_id" required value="<?php if (isset($dados_questao['alternativa_a'])) echo $dados_questao['alternativa_a']; ?>">
                        </div>

                        <div class="field alter-b inactive-alt">
                            <label for="alt_b_id">B) </label>
                            <input placeholder="Alternativa B" type="text" name="alt_b" id="alt_b_id" required disabled value="<?php if (isset($dados_questao['alternativa_b'])) echo $dados_questao['alternativa_b']; ?>">
                            <button type="button">&Cross;</button>
                        </div>

                        <div class="field alter-c inactive-alt">
                            <label for="alt_c_id">C) </label>
                            <input placeholder="Alternativa C" type="text" name="alt_c" id="alt_c_id" required disabled value="<?php if (isset($dados_questao['alternativa_c'])) echo $dados_questao['alternativa_c']; ?>">
                            <button type="button">&Cross;</button>
                        </div>

                        <div class="field alter-d inactive-alt">
                            <label for="alt_d_id">D) </label>
                            <input placeholder="Alternativa D" type="text" name="alt_d" id="alt_d_id" required disabled value="<?php if (isset($dados_questao['alternativa_d'])) echo $dados_questao['alternativa_d']; ?>">
                            <button type="button">&Cross;</button>
                        </div>

                        <div class="field alter-e inactive-alt">
                            <label for="alt_e_id">E) </label>
                            <input placeholder="Alternativa E" type="text" name="alt_e" id="alt_e_id" required disabled value="<?php if (isset($dados_questao['alternativa_e'])) echo $dados_questao['alternativa_e']; ?>">
                            <button type="button">&Cross;</button>
                        </div>
            
                        <button type="button" class='nova-alt'>+ alternativa</button>
                    </div>
            
            
                    <div class="field gabarito">
                        <label for="gabarito_id">Gabarito: <span class="obrigatorio">*</span></label>

                        <select name="gabarito" id="gabarito_id" required>
                            <option hidden <?php if (!isset($dados_questao['gabarito'])) echo "selected"; ?> selected value="">...</option>
                            <option id="a_id" value="A" <?php if (isset($dados_questao['gabarito']) && $dados_questao['gabarito'] == 'A') echo "selected"; ?>>A </option>
                            <option id="b_id" value="B" disabled <?php if (isset($dados_questao['gabarito']) && $dados_questao['gabarito'] == 'B') echo "selected"; ?>>B </option>
                            <option id="c_id" value="C" disabled <?php if (isset($dados_questao['gabarito']) && $dados_questao['gabarito'] == 'C') echo "selected"; ?>>C </option>
                            <option id="d_id" value="D" disabled <?php if (isset($dados_questao['gabarito']) && $dados_questao['gabarito'] == 'D') echo "selected"; ?>>D </option>
                            <option id="e_id" value="E" disabled <?php if (isset($dados_questao['gabarito']) && $dados_questao['gabarito'] == 'E') echo "selected"; ?>>E </option>
                        </select>
                    </div>

                    <div class="field comentario">
                        <label for="comentario_id">Comentário: <span class="obrigatorio">*</span></label>
                        <textarea placeholder="Resposta esperada pelo aluno, comentário geral sobre a questão..." name="comentario" id="comentario_id" cols="30" rows="10" required><?php if (isset($dados_questao['comentario'])) echo $dados_questao['comentario']; ?></textarea>
                    </div>

                    <button class='botao azul2' type="submit">Salvar questão <i class='fa-regular fa-arrow-right'></i></button>
                </form>
            </div>
        </div>
    </div>

    <script src="alternativa.js"></script>
    <script src="toggleTipoQuestao.js"></script>
</body>
</html>
