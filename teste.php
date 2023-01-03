<?php
session_start();
require_once('inc/classes.php');

$objEmail = new Email();

//enviar a mensagem de teste
$objEmail->enviar('moderatedeath@gmail.com','Felipe Pereira Sarmento','<h1>teste</h1>');

$objPergunta = new Pergunta();
$pergunta = $objPergunta->sortearPergunta(2);

$opcoes = $objPergunta->opcoesDeResposta($pergunta->id_pergunta);


  //echo '<pre>';
  //echo 'Pergunta: '.$pergunta->pergunta.'<br>';
  //echo '<ol type="A">';
  //foreach ($opcoes as $resposta) {
  //	echo '<li>';
  //	echo '<input type="radio" name="resposta" value="'.$resposta->//id_alternativa.'">';//
  //  echo $resposta->respos//ta;//
  //	echo '</li>';//
  //}//
  //e//cho '</ol>';//
  //// print_r($opcoes);//
  //// print_r($_SESSION);
  //echo '<hr>';
  	// echo 'Resposta: ';
  	// $a = $objPergunta->verificarResposta(100,$_SESSION['id_usuario']);
  	// if($a){
  	// 	echo 'ACERTOUUUU!!!!';
  	// }else{
  	// 	echo 'ERRROOOOUUUU!!!!';
  	// }
 // echo '</pre>';
  // base64_encode // criptografa
  // base65_decode // descriptografa
  //echo '<br>';
  //$salt = date('dYmdmyd');
  //$toke = '1'.$salt;
  //$id = base64_encode($toke);
  //echo $id;
  //echo '<br>';
  //echo base64_decode($id);
  ///echo '<br>'
  $objUsuario = new Usuario();
  //$objUsuario->ativarUsuario($id);
  $email = 'moderatedeath@gmail.com';
  echo '<h1>'.$objUsuario->recuperarSenha($email).'</h1>';
?>