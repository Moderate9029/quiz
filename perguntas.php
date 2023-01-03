<?php
// Classes
require_once('inc/classes.php');
	@session_start();
	//vericar se é administrador 
	Helper::isAdministrador($_SESSION['nivel']);

$objCategoria = new Categoria();

$objUsuario = new Usuario();

$objPergunta = new Pergunta();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ - T86 - PERGUNTAS</title>
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
			<h1><i class="fas fa-question-circle"></i> PERGUNTAS <a href="pergunta-cadastrar.php" class="btn btn-primary"> Nova Pergunta</a> <a href="responder-perguntas.php" class="btn btn-primary"> Jogar</a></h1>
			<p>
				<form action="?" method="post" accept-charset="utf-8">
					<div class="form-row">
						<div class="form-group col-md-3">
						<label for="id_categoria">Categoria*</label>
						<select class="form-control" name="id_categoria" id="id_categoria" required>
							<option value="0">Todas</option>
							<?php
								$categorias = $objCategoria->listar();
								foreach ($categorias as $categoria){
							?>
							<option value="<?php echo $categoria->id_categoria;?>"><?php echo $categoria->categoria;?></option>
							<?php } //fecha o loop?>
						</select>
					</div>
					<div class="form col-3">
						<label>&nbsp;</label>
						<input type="submit" name="btnFiltrar" id="btnFiltrar" class="btn btn-info mt-4">
					</div>
				</form>
			</p>

			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">AÇÕES</th>			 
			      <th scope="col">Pergunta</th>    
			      <th scope="col">Categoria</th>
			      <th scope="col">Criador</th>			      
			    </tr>
			  </thead>
			  <tbody>	
			  	<?php
			  		if (isset($_POST['btnFiltrar'])) {
			  			$perguntas = $objPergunta->listar($_POST['id_categoria']);
			  		}else{
			  			$perguntas = $objPergunta->listar();
			  		}
			  		foreach ($perguntas as $pergunta) {
			  		
			 	 ?>		  	
			    <tr>
			      <th scope="row">
			      	<?php if ($_SESSION['id_usuario'] == $pergunta->id_usuario) {?>
			      	<a class="btn btn-success" href="pergunta-editar?id=<?php echo Helper::encrypta($pergunta->id_pergunta);?>"><i class="fas fa-edit"></i> Editar</a>
			      <?php }?>
			      	<a class="btn btn-warning" href="pergunta-opcoes.php?id=<?php echo Helper::encrypta($pergunta->id_pergunta); ?>"><i class="fas fa-filter"></i> Opções</a>
			      	<?php if ($_SESSION['id_usuario'] == $pergunta->id_usuario) {?>
			      	<a class="btn btn-danger"  href="perguntas-excluir?id=<?php echo $pergunta->id_pergunta;?>"><i class="fas fa-trash-alt"></i> Excluir</a>
			      	<?php }?>
			      </th>
			      <td><?php echo $pergunta->pergunta; ?></td>
			      <td><?php echo $objCategoria->nomeCategoria($pergunta->id_categoria); ?></td>
			      <td><?php echo $objUsuario->nomeUsuario($pergunta->id_usuario); ?></td>
			    </tr>	
			    <?php 
				} //fecha loop
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