<?php
// Classes
require_once('inc/classes.php');
@session_start();
	//vericar se é administrador 
	Helper::isAdministrador($_SESSION['nivel']);
	$objUsuario = new Usuario();

	$usuario = $objUsuario->show($_GET['id']);

	// verificar se o formulario foi postado
	if(isset($_POST['btnCadastrar'])){
			$objUsuario = new Usuario();
			$id_usuario = $objUsuario->cadastrarAdm($_POST);
			header('location:usuarios?'.$id_usuario);
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
			    <h3><i class="fas fa-users"></i> CADASTRO DE USUÁRIO</h3>
			  </div>
			
				<div class="card-body">
					<form action="?" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nome">Nome*</label>
								<input  class="form-control" type="text" id="nome" name="nome" value="<?php echo $usuario->nome; ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label for="email">E-mail*</label>
								<input  class="form-control" type="email" id="email" name="email" value="<?php  echo $usuario->email; ?>" required>
							</div>
							<div class="form-group col-md-4">
								<label for="senha">Senha*</label>
								<input  class="form-control" type="password" id="senha" name="senha" value="" required>
							</div>

							<div class="form-group col-md-4">
								<label for="confirmaSenha">Confirma Senha*</label>
								<input  class="form-control" type="password" id="confirmaSenha" name="confirmaSenha" value="" required>
							</div>

							<div class="form-group col-md-4">
								<label for="nascimento">Data de Nascimento</label>
								<input  class="form-control" type="date" id="nascimento" name="nascimento" min="<?php echo (date('Y')-10)?>" max="<?php echo date('Y-m-d')?>" value="<?php echo $usuario->nascimento; ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="nivel_acesso">Nivel de Usuário</label>
								<select class="form-control" name="nivel_acesso" id="nivel_acesso" required>
									<option value="2"<?php ($usuario->nivel_acesso == 2)?(print 'selected="selected"'):( print '' ) ?>>Admin</option>
									<option value="1"<?php ($usuario->nivel_acesso == 1)?(print 'selected="selected"'):( print '' ) ?>>Usuário</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="ativo">Ativo</label>
								<select class="form-control" name="ativo" id="ativo" required>
									<option value="1"<?php ($usuario->ativo == 1)?(print 'selected="selected"'):( print '' ) ?>>Ativo</option>
									<option value="0"<?php ($usuario->ativo == 0)?(print 'selected="selected"'):( print '' ) ?>>Bloqueado</option>
								
								</select>
							</div>

							<span id="alerta" class="col-md-12 alert alert-danger">
								<strong>As senhas não conferem! Digite Novamente!</strong>
							</span>
							<span id="alerta2" class="col-md-12 alert alert-danger">
								<strong>Você precisa informar uma senha!</strong>
							</span>

							<div class="form-group col-md-2">
								<labe>&nbsp;</label>
								<input class="form-control btn btn-success mt-1" type="submit" name="btnCadastrar" value=" Cadastrar">
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

<!-- senha e conf. senha -->
<script type="text/javascript">
	// ocultar a mensagem de erro
	$('#alerta').hide();
	$('#alerta2').hide();
	$('#btnCadastrar').attr('disabled','disabled');
	//verificar se as senhas são iguais
	$('#confirmarSenha').blur(function(){

		let senha = $('#senha').val();
		let confirmarSenha = $(this).val();

		if (senha != confirmarSenha) {
			$('#alerta').show();
			
		}else {
			$('#alerta').hide();
			
		}
	});

</script>

</html>