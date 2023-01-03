<?php
/**
 * Classe com metodos estáticos
 */
class Helper{

    /**
     * logado - Verifica se o usuário está logado
     *          pela variável de sessão logado
     *          Caso logado == true, pode acessar os conteúdos
     *          caso contrário, será direcionado 
     *          para a página de login
     * @return void
     */
    public static function logado(){
        // iniciar ambiente de sessão
        @session_start();
        //verificar se está logado
        if ($_SESSION['logado'] != true ) {
            // destruir a sessão
            // direcionar para a página de login
            session_destroy();
            header('location:login');
        }         

    }

    /**
     * Verificar se é um administrador
     * @param  int     $nivel - 1:Usuário, 2:Administrador
     * @return void
     */
    public static function isAdministrador($nivel)
    {
        if ($nivel != 2) {
            //desloga o usuário
            $_SESSION['logado'] = false;
            //session_unset();
            //session_destroy(); 
            //envia o usuario para a pagina de login
            //header('location:login.php') 
        }
    }

    /**
     * Retorna uma string com a primeira letra em Maiuscula
     *
     * @param string $palavra
     * @return string
     */
    public static function primeiraLetraMaiuscula($palavra)
    {
        return ucfirst(strtolower($palavra));
    }

    /**
     * criptografa a informação passada como parametro 
     * @param  string $id
     * @return string
     */
    public static function encrypta($id){
        //criar um $salt
        $salt  = HASH_CRIPTOGRAFIA; 
        $valor = $salt.$id.$salt;
        return base64_encode($valor);
    }

    /**
     * descriptografar o Token
     * @param  string $id 
     * @return string
     */
    public static function decrypta($token){
        //criar um $salt
        $salt           = HASH_CRIPTOGRAFIA;
        $descriptografa = base64_decode($token);
        $a              = str_replace($salt,"",$descriptografa);
        return $a;
    }

    /**
   * Sobe Arquivo
   * @param  file  $arquivo    - Pode ser uma imagem ou qualquer outro
   *                            tipo de arquivo
   * @param  string $diretorio - Caminho da pasta onde o arquivo
   *                             será armazenado
   * @return string            - nome do arquivo
   */
  public static function sobeArquivo($arquivo,$diretorio='uploads/'){
    $arquivo = $arquivo;
    // pegar apenas o nome original do arquivo
    $nome_arquivo = $arquivo['name'];

 

      //verificar se algum arquivo
      //foi enviado
      if(trim($nome_arquivo)!= '') {
        //pegar a extensao do file
        $extensao = explode('.', $nome_arquivo);
        
        //gerar nome
        $novo_nome = date('YmdHis').'.'.end($extensao);

 

        // montar o destino onde o arquivo será armazenado
        $destino = $diretorio.$novo_nome;
        $ok = move_uploaded_file($arquivo['tmp_name'],$destino);
        // verificar se o upload foi realizado
        if($ok) {
          return $novo_nome;
        } else {
          return false;
        }

 


      } else {
        return false;
      }

 

  }

  public static function dataBrasil($data)
  {
    $dt = new DateTime($data);
    return $dt->format('d/m/Y');
  }


}


?>