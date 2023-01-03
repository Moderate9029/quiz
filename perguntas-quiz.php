<?php 
// Classes
require_once('inc/classes.php');
$objPergunta = new Pergunta();

$pergunta = $objPergunta->sortearPergunta('');

$opcoes = $objPergunta->opcoesDeResposta($pergunta->id_pergunta);

//$verificar = $objPergunta->verificarResposta();
if(isset($_POST['btnVerificar'])){

    $objPergunta->verificarResposta($_POST['correta'],$_SESSION['id_usuario']);
    header('location:perguntas-quiz-random.php');
}
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> QUIZ - PERGUNTAS T86</title>

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
        <h1 class="col-12"><i class="fas fa-question-circle"></i> Pergunta Aleatória</h2>
            <hr>
            <br>
            <br>
            <br>
            <br>
        <form action="?" method="post" accept-charset="utf-8">
        <div class="col-md-6 offset-md-3 border rounded p-2 border-dark rounded-lg alert alert-light">
            
            <h3 class=""><?php echo $pergunta->pergunta ?></h3>

            <hr>

            <ol type="A offset-1">
                <!-- LOOP -->
                <?php foreach ($opcoes as $resposta){
                ?>
                <li>
                    <strong>
                    <input role="button" type="radio" name="resposta" value="'<?php echo $resposta->id_alternativa; ?>'">
                    <label><?php echo $resposta->resposta ?> </label>
                    </strong>
                </li>
                <?php } // fecha loop?>
            </ol>

            <hr>

            <input type="submit" name="btnVerificar" class="form-control btn btn-success mt-1" value=" Enviar ">

        </div>
        </form>
        
        <!-- /CONTEUDO -->

        <!-- RODAPE -->
        <?php require_once('inc/rodape.php'); ?>
        <!-- /RODAPE -->
    </div>
    <!-- /CONTAINER -->    


</body>

</html>