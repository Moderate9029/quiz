<?php
// Classes
require_once('inc/classes.php');
$objCategoria = new Categoria();

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
        <form action="?" method="post" accept-charset="utf-8">
            <?php
                 $categorias = $objCategoria->listar();              
                 // echo '<pre>';
                 // print_r($categorias);
                 // echo '</pre>';
                 foreach ($categorias as $categoria){
            ?>
            <br>
            <input type="submit" name="btnCategoria" class="offset-md-1 btn btn-info" value="<?php echo $categoria->categoria ?>">
            <br>
            <?php } // fecha loop?>
        </form>
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