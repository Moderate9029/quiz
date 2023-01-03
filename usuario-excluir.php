<?php 
// Classes
require_once('inc/classes.php');
@session_start();
    //vericar se é administrador 
    Helper::isAdministrador($_SESSION['nivel']);
// ESTANCIAR OS OBJETOS
 $objUsuario = new Usuario();
 $usuario = $objUsuario->show($_GET['id']);
 
 if(isset($_POST['btnExcluir'])){    
     $objUsuario->apagar($_POST['id_usuario']);
     header('location:usuarios');
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
                <h3> <i class="fas fa-align-justify"></i> TEM CERTEZA QUE DEJA EXCLUIR O USUÁRIO:
                 <?php echo $usuario->nome; ?> ? 
                </h3>
			  </div>
			
				<div class="card-body">
					<form action="?" method="post" accept-charset="utf-8">
                        <!-- OCULTO -->                        
                        <input type="hidden" name="id_usuario" value="<?php echo $_GET['id'];?>">
                        <!-- OCULTO -->
						<div class="form-row">				
							<div class="form-group col-md-2">
                                <a href="usuarios" class="btn btn-danger"> Cancelar</a>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="submit" value="Confirmar" name="btnExcluir" class="btn btn-success">
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