function mostrarAlternativas() {
    var tipoQuestao = document.getElementById('tipoQuestao').value;
    var alternativasGroup = document.getElementById('alternativasGroup');
    var respostaAlternativa = document.getElementById('respostaAlternativa');
    var respostaDissertativa = document.getElementById('respostaDissertativa');

    // Se o tipo de questão for "alternativa", mostra o campo de alternativas e resposta alternativa,
    // senão, esconde ambos e mostra o campo de resposta dissertativa.
    if (tipoQuestao === 'alternativa') {
      alternativasGroup.style.display = 'block';
      respostaAlternativa.style.display = 'block';
      respostaDissertativa.style.display = 'none';
    } else if (tipoQuestao === 'dissertativa') {
      respostaDissertativa.style.display = 'block';
      respostaAlternativa.style.display = 'none';
      alternativasGroup.style.display = 'none';
    } else {
      alternativasGroup.style.display = 'none';
      respostaAlternativa.style.display = 'none';
      respostaDissertativa.style.display = 'none';
    }
  }