<?php
// Classes
require_once('inc/classes.php');
@session_start();
	//vericar se é administrador 
	Helper::isAdministrador($_SESSION['nivel']);
// ESTANCIAR OS OBJETOS
 $objBanner = new Banner();

if(isset($_POST['btnAtualizar'])){
	$objBanner->editar($_POST,$_FILES['banner']);
	header('location:banners.php');
}


 //  verificar se existe a variavel GET[id]
 //  se ela existir, uma categoria está sendo editada
 //  senão, uma categoria está sendo criada
 
 if(isset($_GET['id']) ){
 	$banners = $objBanner->show($_GET['id']);
 }else{
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
			    <h3> <i class="fas fa-align-justify"></i>EDIÇÃO DE BANNER</h3>
			  </div>
			
				<div class="card-body">
					<form action="?" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <!-- OCULTO -->
                        <?php
                        	
                        		echo '<input type="hidden" name="id_banner" value="'.$_GET['id'].'">';

                        	
                        ?>
                        <!-- OCULTO -->
						<div class="form-row">
							<img src="uploads/<?php echo $banners->banner; ?>" width="150">
							<div class="col-12"><br></div>
							<div class="form-group col-md-12">
								<label for="categoria">Banner</label>
								<input  class="form-control" type="file" id="banner" name="banner" <?php print'value="'.$banners->banner.'"'; ?>required >
							</div>

							<div class="form-group col-md-6">
								<label for="categoria">URL</label>
								<input  class="form-control" type="text" id="url" name="url" 
								<?php print'value="'.$banners->url.'"'; ?>
								required >
							</div>

							<div class="form-group col-md-3">
								<label for="id_categoria">Status</label>
								<select class="form-control" name="status" id="status" required>
								<?php	
									if ($banners->status == '1') {									
									echo '<option value="1" selected="selected">ATIVO</option>';
									echo '<option value="0">BLOQUEADO</option>';
									}else
									{
									echo '<option value="1">ATIVO</option>';
									echo '<option value="0" selected="selected">BLOQUEADO</option>';
									}
								
								?>
								</select>
							</div>
							<div class="form-group col-md-2">
								<labe>&nbsp;</label>
								<?php 
								    
								    	echo '<input class="form-control btn btn-warning mt-1"  type="submit" name="btnAtualizar" value=" Atualizar">';
								    
								    	//echo '<input class="form-control btn btn-success mt-1" type="submit" name="btnCadastrar" value=" Cadastrar">';
								    
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