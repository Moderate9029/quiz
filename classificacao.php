<?php
// Classes
require_once('inc/classes.php');
$objCategoria = new Categoria();
$objPergunta  = new Pergunta();
$objUsuario   = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shurtcut icon" href="uploads/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ - T86 - CLAFISSICAÇÃO</title>
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
            <h1><i class="fas fa-trophy"></i> Clafissicação</h1>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>RANK</th>
                  <th>NOME</th>
                  <th>PONTOS</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $x=1;
                  $ranks = $objUsuario->classificacao();                 
                 // echo '<pre>';
                 // print_r($categorias);
                 // echo '</pre>';
                 foreach ($ranks as $rank){
                ?>
                <tr>
                  <th>
                    <?php echo $x;?>
                  </th>
                  <td><?php  echo $rank->nome; ?></td>
                  <td><?php  echo $rank->pontuacao; ?></td>
                </tr>
                <?php
                  $x++; } // fecha o loop 
                ?>

              </tbody>
            </table>
            <div class="banner">
            <?php 
            $objBanner = new Banner();
            $objBanner->sortearBanner();

            ?>
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