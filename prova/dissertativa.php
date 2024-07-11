<?php
    echo "<div class='field'>";
        echo "<label for='alt_a_id'><b>A)</b> ".$dados['alternativa_a']."</label>";
    echo "</div>";

    if (!is_null($dados['alternativa_b'])) {
        echo "<div class='field'>";
            echo "<label for='alt_b_id'><b>B)</b> ".$dados['alternativa_b']."</label>";
        echo "</div>";
    }

    if (!is_null($dados['alternativa_c'])) {
        echo "<div class='field'>";
            echo "<label for='alt_c_id'><b>C)</b> ".$dados['alternativa_c']."</label>";
        echo "</div>";
    }

    if (!is_null($dados['alternativa_d'])) {
        echo "<div class='field'>";
            echo "<label for='alt_d_id'><b>D)</b> ".$dados['alternativa_d']."</label>";
        echo "</div>";
    }

    if (!is_null($dados['alternativa_e'])) {
        echo "<div class='field'>";
            echo "<label for='alt_e_id'><b>E)</b> ".$dados['alternativa_e']."</label>";
        echo "</div>";
    }

    echo "<input class='botao azul2' type='submit' value='Conferir resposta'>";

    if (isset($_SESSION['comentario'])) {
        echo "<div class='msg-container'>";
            echo "<div class='msg comentario'>";
                echo "<p>Resposta esperada pelo aluno: </p>";
                echo "<p><b>".$_SESSION['comentario']."</b></p>";
            echo "</div>";
        echo "</div>";
        
        unset($_SESSION['comentario']);
    }
?>
