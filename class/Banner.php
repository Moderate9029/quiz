<?php 

class Banner{

	protected $pdo;
    	protected $upload;

    function __construct()
    {
        $this->pdo = Conexao::conexao();
    }

    /**
     * cadastrar banner
     * @param  array $dados 
     * @return int   $id_banner
     */
    public function cadastrar($dados,$banner='')
    {
        $sql = $this->pdo->prepare('INSERT INTO banners
                                    (banner, url)
                                    VALUES
                                    (:banner,:url)
                                    ');
        //$banner = trim($dados['banner']);
        $url    = strtolower(trim($dados['url']));
        // VERIFICAR SE UM ARQUIVO FOI ENVIADO
        $arquivo = Helper::sobeArquivo($banner, 'uploads/');
        $vazio   = '';
        // se o retorno do metodo for diferente de STRING ou seja FALSE
        if(!$arquivo){
            $sql->bindParam(':banner',$vazio);
        }else{
            $sql->bindParam(':banner',$arquivo);
        }

        //$sql->bindParam(':banner',$banner);
        $sql->bindParam(':url',$url);

        $sql->execute();

        //retorna a PK do registro inserido
        //return $this->pdo->lastInsertId();
    }

    /**
     * editar banner
     * @param  array $dados 
     * @return int   
     */
    public function editar($dados,$banner="")
    {
        $arquivo = Helper::sobeArquivo($banner,'uploads/');
        if($arquivo){
        $sql = $this->pdo->prepare('UPDATE banners SET
                                    banner = :banner,
                                    url = :url,
                                    status = :status
                                    WHERE
                                    id_banner = :id_banner
                                    ');
        }else{
        $sql = $this->pdo->prepare('UPDATE banners SET
                                    url = :url,
                                    status = :status
                                    WHERE
                                    id_banner = :id_banner
                                    ');
        }

        $id_banner = $dados['id_banner'];
        $url    = trim($dados['url']);
        $status = $dados['status'];

        if ($arquivo) {
            $sql->bindParam(':banner',$arquivo);
        }

        $sql->bindParam(':url',$url);
        $sql->bindParam(':id_banner',$id_banner);
        $sql->bindParam(':status',$status);

        $sql->execute();

    }

    /**
     * sortear Banner 
     * @return int $id_banner
     */
    public function sortearBanner()
    {
        $sql = $this->pdo->prepare('SELECT * FROM banners
                                            WHERE status = 1
                                            ORDER BY rand()
                                            LIMIT 1
                                          ');
       
        
        // executar a consulta SQL
        $sql->execute();

        $resultado = $sql->fetch(PDO::FETCH_OBJ);

        // somar 1 ao contador do banner
        //$sqlContador = $this->pdo->prepare(' UPDATE banners SET contador + 1
        //                                     WHERE id_banner = :id_banner
        //                                     '); 
        //$sqlContador->bindParam(':id_banner',$resultado->id_banner);
        //$sqlContador->execute();
    

        //verificar se existe uma imagem
        if ($resultado->banner != '') {
            // verificar se existe um link
            if ($resultado->url != '') {
                
                $banner = ' <div class="text-center m-3">
                            <a href="'.$resultado->url.'" target="_blank">
                            <img class="img-thumbnail" src="uploads/'.$resultado->banner.'" height="250">
                            </a>
                            </div>';
            }else{
                $banner = ' <div class="text-center m-3">
                            <img class="img-thumbnail" src="uploads/'.$resultado->banner.'" height="250">
                            </div>';
            }
            echo $banner;
        }else{
            return false;
        }
        }

    /**
     * listar 
     * @return array
     */
    public function listar()
    {
    	$sql = $this->pdo->prepare('SELECT * FROM banners ORDER BY contador DESC');

        $sql->execute();

        return $sql->fetchall(PDO::FETCH_OBJ);
    }

    /**
     * show - retorna os dados de uma categoria
     * @param  string $id_categoria 
     * @return array / obj
     */
    public function show($id_banner)
    {
        //montar o SELECT ou o SQL
        $sql = $this->pdo->prepare('SELECT * FROM banners
                                     WHERE id_banner = :id_banner
                                   ');

        //mesclar os dados/atributos
        $sql->bindParam(':id_banner',$id_banner);

        //executar o SQL
        $sql->execute();

        //retornart os dados
        return $sql->fetch(PDO::FETCH_OBJ);

    }

    public function apagar($id_banner){
    //realizar a exclusão
        $sql = $this->pdo->prepare('DELETE FROM banners WHERE id_banner = :id_banner');
        $sql->bindParam(':id_banner',$id_banner);
        $sql->execute();
    }



}

?>