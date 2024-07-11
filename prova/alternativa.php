<?php
    echo "<div class='field'>";
        echo "<input required type='radio' name='alternativa' id='alt_a_id' value='A'>";
        echo "<label for='alt_a_id'><b>A)</b> ".$dados['alternativa_a']."</label>";
    echo "</div>";

    if (!is_null($dados['alternativa_b'])) {
        echo "<div class='field'>";
            echo "<input required type='radio' name='alternativa' id='alt_b_id' value='B'>";
            echo "<label for='alt_b_id'><b>B)</b> ".$dados['alternativa_b']."</label>";
        echo "</div>";
    }

    if (!is_null($dados['alternativa_c'])) {
        echo "<div class='field'>";
            echo "<input required type='radio' name='alternativa' id='alt_c_id' value='C'>";
            echo "<label for='alt_c_id'><b>C)</b> ".$dados['alternativa_c']."</label>";
        echo "</div>";
    }

    if (!is_null($dados['alternativa_d'])) {
        echo "<div class='field'>";
            echo "<input required type='radio' name='alternativa' id='alt_d_id' value='D'>";
            echo "<label for='alt_d_id'><b>D)</b> ".$dados['alternativa_d']."</label>";
        echo "</div>";
    }

    if (!is_null($dados['alternativa_e'])) {
        echo "<div class='field'>";
            echo "<input required type='radio' name='alternativa' id='alt_e_id' value='E'>";
            echo "<label for='alt_e_id'><b>E)</b> ".$dados['alternativa_e']."</label>";
        echo "</div>";
    }

    echo "<input class='botao azul2' type='submit' value='Responder'>";

    if (isset($_SESSION['errou']) && isset($_SESSION['gabarito'])) {
        echo "<div class='msg-container'>";
            if ($_SESSION['errou'])
                echo "<p class='msg error'><i class='fa-regular fa-times'></i> A alternativa correta é a <b>".$_SESSION['gabarito']."</b>.</p>";
            else {
                echo "<p class='msg success'><i class='fa-regular fa-check'></i> Parabéns! A alternativa correta é a <b>".$dados['gabarito']."</b>.</p>";
        
        
                if (isset($_SESSION['pontuou']) && $_SESSION['pontuou'])
                    echo "<p class='msg pontuou'><i class='fa-solid fa-star'></i> Pontuação <b>+".PONTO_QUESTAO."</b> :)</p>";
            }
        echo "</div>";
        
        unset($_SESSION['errou']); unset($_SESSION['gabarito']); unset($_SESSION['pontuou']);
    }
?>
