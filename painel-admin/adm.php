<html lang="pt-br">
    <head>
        <title>ADMINISTRADOR-estudaENADE</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../ARQUIVOS_PADROES/CSS_Padrao.css">
        <link rel="stylesheet" href="CSS_Adm.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>

    <body class="site">

          <?php include '../ARQUIVOS_PADROES/header.php'; ?>

        <div class="site-content">


            <div class="card mx-auto my-3">
                <div class="card-body card-body d-flex align-items-center" style="padding: 1%;">
                    <h5 class="card-title mx-auto my-auto">DADOS CADASTRADOS</h5>
                </div>
            </div>       
            
            <div class="card mx-auto">
                <div class="dadosCadastrados">
                    <label for="example" class="titulo">Nome Completo</label>
                    <p class="dados">LEANDRO ARANTES TANNER</p>
                </div>

                <div class="dadosCadastrados">
                    <label for="example" class="titulo">Email</label>
                    <p class="dados">leandroexemplo@gmail.com</p>
                </div>

                <div class="dadosCadastrados">
                    <label for="example" class="titulo">Data De Nacimento</label>
                    <p class="dados">28/02/2005</p>
                </div>

                <div class="dadosCadastrados">
                    <label for="example" class="titulo">Escolaridade</label>
                    <p class="dados">Ensino Superior Cursando</p>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">EDITAR DADOS</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">ALTERAR SENHA</button>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="card mx-auto my-3">
                <div class="card-body card-body d-flex align-items-center" style="padding: 1%;">
                    <h5 class="card-title mx-auto my-auto">Menu de Administração</h5>
                </div>
            </div>       
            
            <div class="admin-menu mx-auto">
                <ul class="mx-auto">
                  <li><a href="../LISTAGEM_USUARIOS/Listagem_Usuarios.php" class="links">Listagem de Usuários</a></li>
                  <li><a href="../LISTAGEM_PROVAS/Listagem_Prova.php" class="links">Listagem de Provas</a></li>
                  <li><a href="../LISTAGEM_QUESTOES/Listagem_Questoes.php" class="links">Listagem de Questões</a></li>
                  <li><a href="../CADASTRAR_PROVAS/Cadastrar_Provas.php" class="links">Cadastrar Prova</a></li>
                  <li><a href="../CADASTRAR_ADM/Cadastrar_Adm.php" class="links">Cadastrar Administrador</a></li>
                </ul>
              </div>
            
        </div>

        <?php include '../ARQUIVOS_PADROES/footer.php'; ?>            

      <script src="https://kit.fontawesome.com/85b261f1db.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
      <?php include '../ARQUIVOS_PADROES/libras.php';?>

    </body>

</html>