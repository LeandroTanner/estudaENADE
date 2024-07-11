<html lang="pt-br">
    <head>
        <title>CADASTRAR ADMINISTRADOR-estudaENADE</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../ARQUIVOS_PADROES/CSS_Padrao.css">
        <link rel="stylesheet" href="CSS_Cadastro_Admin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      </head>
    <body class="site">
       

      <!--ESSA É A BARRA DE NAVEGAÇÃO-->
      <?php include '../ARQUIVOS_PADROES/header.php'; ?>
      <!--AQUI ACABA A BARRA DE NAVEGAÇÃO-->

       <div class="site-content">
        <form class="formulario mx-auto">

          <h2 class="Titulo_Form">CADASTRE UM ADMINISTRADOR</h2>
          
          <div class="form-group">
            <label for="Email">Endereço de email do administrador</label><i class="fa-solid fa-asterisk"></i>
            <input type="email" class="form-control mx-auto form-control-sm" id="Email" aria-describedby="emailHelp" placeholder="Ex: exemplo@gmail.com" required>
            <!--<small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>-->
          </div>
  
          <div class="form-group">
              <label for="confirma_Email">Confirme o email</label><i class="fa-solid fa-asterisk"></i>
              <input type="email" class="form-control mx-auto form-control-sm" id="confirma_Email" aria-describedby="emailHelp" placeholder="Ex: exemplo@gmail.com" required>
              <!--<small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>-->
          </div>
  
          <div class="form-group">
            <label for="senha">Confirme a ação com sua senha</label><i class="fa-solid fa-asterisk"></i>
            <input type="password" class="form-control mx-auto form-control-sm" id="senha" placeholder="Confirme sua senha" required>
            <span class="toggle-password" onclick="togglePasswordVisibility()">
                <span id="eye-open"><i class="fa-solid fa-eye" class="eye"></i></span>
                <span id="eye-closed" style="display:none;"><i class="fa-solid fa-eye-slash"></i></span>
              </span>
          </div>
  
            <div class="container">
              <div class="row">
                  <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary btn-block btn-sm">CADASTRAR</button>
                  </div>
                  <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary btn-block btn-sm"><a href="Login.php">CANCELAR</a></button>
                  </div>
              </div>
          </div>
  
        </form>
       </div>
  
        <?php include '../ARQUIVOS_PADROES/footer.php'; ?>

      <script src="./JS_Cadastrar_Adm.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
      <script src="https://kit.fontawesome.com/85b261f1db.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
      <?php include '../ARQUIVOS_PADROES/libras.php';?>
    
    </body>
</html>