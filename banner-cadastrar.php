<?php
// Classes
require_once('inc/classes.php');
@session_start();
	//vericar se é administrador 
	Helper::isAdministrador($_SESSION['nivel']);
// ESTANCIAR OS OBJETOS
 $objBanner = new Banner();


// VERIFICAR SE O FORMULÁRIO FOI ENVIADO
  if(isset($_POST['btnCadastrar'])) {
  	 $objBanner->cadastrar($_POST,$_FILES['banner']);
  	 header('location:banners.php');
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ - T86</title>
    <!-- CSS / ICONES -->
    <?php require_once('inc/css.php'); ?>

</head>
<body>
    <!-- CONTAINER -->
    <div class="container">
        <!-- TOPO -->
        <?php require_once('inc/topo.php'); ?>       
        <!-- /TOPO -->
        <!-- CONTEUDO -->
        <div class="col-md-12">
			<div class="card">
			  <div class="card-header">
			    <h3> <i class="fas fa-align-justify"></i>CADASTRO DE BANNER</h3>
			  </div>
			
				<div class="card-body">
					<form action="?" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="banner">Banner</label>
								<input class="form-control" type="file" name="banner" id="banner" required>
							</div>
							<div class="form-group col-md-6">
								<label for="url">URL</label>
								<input  class="form-control" type="text" id="url" name="url" value="" required >
							</div>
							<div class="form-group col-md-2">
								<labe>&nbsp;</label>
								<?php 
								    
								    	//echo '<input class="form-control btn btn-warning mt-1" type="submit" name="btnAtualizar" value=" Atualizar">';
								    
								    	echo '<input class="form-control btn btn-success mt-1" type="submit" name="btnCadastrar" value=" Cadastrar">';
								    
							    ?>
					
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
        <!-- /CONTEUDO -->
        <!-- RODAPE -->
        <?php require_once('inc/rodape.php'); ?>
        <!-- /RODAPE -->
    </div>
    <!-- /CONTAINER -->    
</body>
<!-- JS -->
<?php require_once('inc/js.php'); ?>

</html>