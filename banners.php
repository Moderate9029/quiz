<?php
// Classes
require_once('inc/classes.php');
@session_start();
	//vericar se é administrador 
	Helper::isAdministrador($_SESSION['nivel']);

// ESTANCIAR OS OBJETOS
 $objBanner = new Banner();
 $objUsuario = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ - T86 - BANNERS</title>
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
			<h1><i class="fas fa-align-justify"></i> BANNERS - <a href="banner-cadastrar.php" class="btn btn-primary"> Novo Banner</a></h1>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th>AÇÕES</th>
			      <th>Código</th>--
			      <th>Banner</th>
			      <th>URL</th>
			      <th>STATUS</th>
			      <!-- <th>USUÁRIO</th>  -->
			      <th>VISUALIZAÇÕES</th>
			    </tr>
			  </thead>

			  <tbody>
				<?php
				 $banners = $objBanner->listar();				 
				 // echo '<pre>';
				 // print_r($categorias);
				 // echo '</pre>';
				 foreach ($banners as $banner){
				?>
			    <tr>
			      <th>
			      	
			      	
			      	<a class="btn btn-success" href="banner-editar?id=<?php  echo $banner->id_banner; ?>"><i class="fas fa-edit"></i> Editar</a>
			      	<a class="btn btn-danger"  href="banner-excluir?id=<?php  echo $banner->id_banner; ?>"><i class="fas fa-trash-alt"></i> Excluir</a>
			      	
			      </th>
			      <td><?php  echo $banner->id_banner; ?></td>
			      <td><?php 
				      	if(trim($banner->banner) != '' ){
				      	  echo '<img src="'.PASTA_BANNER.$banner->banner.'" width="150">';
				      	}
			      	?></td>
			      <td><?php  echo $banner->url; ?></td>
			      <td>
			    	<?php 
			    	if ($banner->status == '1') {
			    		echo "ATIVO";
			    	}else{
			    		echo "BLOQUEADO";
			    	}
			    	?>
			    	</td>
			    	<td>
			    		<?php echo $banner->contador; ?>
			    	</td>
			    </tr>
			    
			    <?php
			      } // fecha o loop 
			    ?>

			  </tbody>
			</table>
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