<?php

class Usuario
{

    protected $salt;
    protected $pdo;

     function __construct()
     {
         $this->pdo  = Conexao::conexao();
         $this->salt = 'Sen$c1235';
     }


     /**
      * listar
      *
      * @return array
      */
     public function listar()
     {
         $sql = $this->pdo->prepare('SELECT * FROM usuarios ORDER BY nome');
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_OBJ);
     }

     /**
      * cadastrar
      *
      * @param array $dados
      * @return int - id_usuario
      */
     public function cadastrar($dados)
     {
         $sql = $this->pdo->prepare('INSERT INTO usuarios
                                    (nome, email, senha, nascimento, nivel_acesso)
                                    VALUES
                                    (:nome, :email, :senha, :nascimento, :nivel_acesso)
                                  ');
        //tratar os dados
        $nome  = strtoupper(trim($dados['nome']));
        $email = strtolower(trim($dados['email']));
        $nascimento = trim($dados['nascimento']);
        $senha = crypt($dados['senha'],$this->salt);
        $nivel_acesso = 1; //1- Usuario normal / 2 é o nivel de administrador

        $sql->bindParam(':nome',$nome);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':nascimento',$nascimento);
        $sql->bindParam(':senha',$senha);
        $sql->bindParam(':nivel_acesso',$nivel_acesso);

        $sql->execute();

        //pegar o id do usuário - ou a PK do registro
        return $this->pdo->lastInsertId();

     }
     /**
      * cadastrarAdm
      *
      * @param array $dados
      * @return int - id_usuario
      */
     public function cadastrarAdm($dados)
     {
         $sql = $this->pdo->prepare('INSERT INTO usuarios
                                    (nome, email, senha, nascimento, nivel_acesso, ativo)
                                    VALUES
                                    (:nome, :email, :senha, :nascimento, :nivel_acesso, :ativo)
                                  ');
        //tratar os dados
        $nome  = strtoupper(trim($dados['nome']));
        $email = strtolower(trim($dados['email']));
        $nascimento = trim($dados['nascimento']);
        $senha = crypt($dados['senha'],$this->salt);
        $nivel_acesso = $dados['nivel_acesso']; //1- Usuario normal / 2 é o nivel de administrador
        $ativo = $dados['ativo'];

        $sql->bindParam(':nome',$nome);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':nascimento',$nascimento);
        $sql->bindParam(':senha',$senha);
        $sql->bindParam(':nivel_acesso',$nivel_acesso);
        $sql->bindParam(':ativo', $ativo);

        $sql->execute();

        //pegar o id do usuário - ou a PK do registro
        return $this->pdo->lastInsertId();

     }
     public function show($id_usuario)
    {
        $id_usuario = Helper::decrypta($id_usuario);
        //montar o SELECT ou o SQL
        $sql = $this->pdo->prepare('SELECT * FROM usuarios
                                     WHERE id_usuario = :id_usuario
                                   ');

        //mesclar os dados/atributos
        $sql->bindParam(':id_usuario',$id_usuario);

        //executar o SQL
        $sql->execute();

        //retornart os dados
        return $sql->fetch(PDO::FETCH_OBJ);

    }

    /**
     * apagar 
     * @param  string $id_usuario
     * @return void
     */
    public function apagar($id_usuario)
    {
        //descriptografar
        $id_usuario = Helper::decrypta($id_usuario);

        //atualizar todas as perguntas da categoria que será excluída para a categoria padrão que é a GERAL id = 1
        //$id_geral = 1;
        //$sqlBanners = $this->pdo->prepare('UPDATE perguntas SET
        //                                    id_usuario = :id_geral
        //                                    WHERE
         //                                   id_usuario = :id_usuario');
        //$sqlBanners->bindParam(':id_usuario',$id_usuario);
        //$sqlBanners->bindParam(':id_geral',$id_geral);
        //$sqlBanners->execute();

        //realizar a exclusão
        $sql = $this->pdo->prepare('DELETE FROM usuarios WHERE id_usuario = :id_usuario');
        $sql->bindParam(':id_usuario',$id_usuario);
        $sql->execute();
    }

    /**
     * nomeCategoria - retorna nome
     * @param  int $id_usuario
     * @return string
     */
    public function nomeUsuario($id_usuario)
    {
        //montar o SELECT ou o SQL
        $sql = $this->pdo->prepare('SELECT nome FROM usuarios
                                     WHERE id_usuario = :id_usuario
                                   ');

        //mesclar os dados/atributos
        $sql->bindParam(':id_usuario',$id_usuario);
        //executar o SQL
        $sql->execute();
        //retornart os dados
        $usuario = $sql->fetch(PDO::FETCH_OBJ);

        return $usuario->nome;

    }

    /**
     * pontuacao 
     * @param  INT     $id_usuario 
     * @return string
     */
    public function pontuacao($id_usuario)
        {
            $sql = $this->pdo->prepare('SELECT pontuacao FROM usuarios
                                        WHERE id_usuario = :id_usuario');
            $sql->bindParam(':id_usuario',$id_usuario);
            $sql->execute();
            //poderia ser assim tbm
            //$usuario = $sql->fetch(PDO::FETCH_OBJ);
            //return $usuario->pontuacao;
            return $sql->fetch(PDO::FETCH_OBJ);
        }

    /**
     * classificacao
     * @return array 
     */
    public function classificacao()
    {
        //montar o SELECT ou o SQL
        $sql = $this->pdo->prepare('SELECT * FROM usuarios ORDER BY pontuacao DESC');

        //executar a consulta
        $sql->execute();
        //pegar os dados retornados
        $rank = $sql->fetchall(PDO::FETCH_OBJ);       

        return $rank;
    }

    /**
     * primeiroLugar
     * @return array
     */
    public function primeiroLugar()
    {
        $sql = $this->pdo->prepare('SELECT nome,pontuacao FROM usuarios ORDER BY pontuacao DESC LIMIT 1');

        $sql->execute();

        $rankFirst = $sql->fetch(PDO::FETCH_OBJ); 
    }

    /**
     * ultimoLugar
     * @return array
     */
    public function ultimoLugar()
    {
        $sql = $this->pdo->prepare('SELECT nome,pontuacao FROM usuarios ORDER BY pontuacao ASC LIMIT 1');

        $sql->execute();

        $rankLast = $sql->fetch(PDO::FETCH_OBJ);
    }

    public function editar($dados, $id_usuario){
            // Montar o SQL
            $sql = $this->pdo->prepare('UPDATE usuarios 
                                        SET 
                                          nome = :nome, 
                                          email = :email, 
                                          senha = :senha, 
                                          nascimento = :nascimento,
                                          nivel_acesso = :nivel_acesso,
                                          ativo = :ativo
                                        WHERE (id_usuario = :id_usuario)'
                                        );
            
            // Tratar
            $nome =         strtoupper(trim($dados['nome']));
            $email =        strtolower(trim($dados['email']));
            $senha =        crypt($dados['senha'], $this->salt);
            $nascimento =   trim($dados['nascimento']);
            $nivel_acesso  = $dados['nivel_acesso'];
            $ativo  = $dados['ativo'];
            
            // Mesclar
            $sql->bindParam(':nome',$nome);
            $sql->bindParam(':email',$email);
            $sql->bindParam(':senha',$senha);
            $sql->bindParam(':nascimento',$nascimento);
            $sql->bindParam(':id_usuario',$id_usuario);
            $sql->bindParam(':nivel_acesso',$nivel_acesso);
            $sql->bindParam(':ativo',$ativo);
 
            // Executar
            $sql->execute();
     }


/*
* ------------------------------------------------
*  AREA DE METODOS REFERENTES AO LOGIN
* ------------------------------------------------
*/
    /**
     * logar
     * @param  string $email [description]
     * @param  string $senha [description]
     * @return bool true || false
     */
    public function logar($email,$senha)
    {
        $senhaCriptografada = crypt($senha,$this->salt);
        $email = trim(strtolower($email));

       //Criar o SQL
       $sql = $this->pdo->prepare('
                                 SELECT * FROM usuarios
                                 WHERE
                                    email = :email
                                 AND
                                    senha = :senha
                                 ');
        //Mesclar os dados
        $sql->bindParam(':email',$email);
        $sql->bindParam(':senha',$senhaCriptografada);

        //executar
        $sql->execute();

        //pegar oss dados retornados
        $resultado = $sql->fetch(PDO::FETCH_OBJ);

        //verificar se retorna algum registro
        if($sql->rowCount() == 1){
            // verificar se usuario esta ativo
           if ($resultado->ativo == 1){
            //criar as sessões
            $_SESSION['usuario']    = $resultado->nome;
            $_SESSION['id_usuario'] = $resultado->id_usuario;
            $_SESSION['nivel']      = $resultado->nivel_acesso;
            $_SESSION['logado']     = true;
            //vai retornar TRUE, pois deu tudo certo
            return true;
            }else{
            $_SESSION['logado']      = false;
            $_SESSION['usuario']     = $resultado->nome;
            $_SESSION['msgBloqueio'] = 'Seu acesso está bloqueado, procure o administrador!';
            return false;
            }
        }else{
            //destruir as variáveis de sessão
            $_SESSION['logado'] = false;
            session_unset(); // desregistrar
            session_destroy(); // destruir
            return false;
        }
    }

    /**
     * bloquearUsuario
     * @param  int      id_usuario                                  
     * @return void
     */
    public function bloquearUsuario($id_usuario)
    {
        $sql = $this->pdo->prepare('UPDATE usuarios
                                    SET ativo = :ativo
                                    WHERE id_usuario = :id_usuario
                                    ');
        $ativo = 0;
        $sql->bindParam('id_usuario',$id_usuario);
        $sql->bindParam('ativo',$ativo);

        $sql->execute();
    }

    /**
     * desbloquearUsuario
     * @param  int      id_usuario                                  
     * @return void
     */
    public function desbloquearUsuario($id_usuario)
    {
        $sql = $this->pdo->prepare('UPDATE usuarios
                                    SET ativo = :ativo
                                    WHERE id_usuario = :id_usuario
                                    ');
        $ativo = 1;
        $sql->bindParam('id_usuario',$id_usuario);
        $sql->bindParam('ativo',$ativo);

        $sql->execute();
    }

    /**
     * ativarUsuario
     * @param  string $token - id do usuario criptografado
     * @return true || false       
     */
    public function ativarUsuario($token)
    {
        $id_usuario = intval(base64_decode($token));// descriptografa
        //verificar se é um número inteiro
        if (! is_int($id_usuario)){
            return false;
        }
        $sql = $this->pdo->prepare('UPDATE usuarios
                                    SET ativo = :ativo
                                    WHERE id_usuario = :id_usuario
                                    ');
        $ativo = 1;
        $sql->bindParam('id_usuario',$id_usuario);
        $sql->bindParam(':ativo',$ativo);

        $sql->execute();

        if($sql->rowCount() == 1) {
            return true;
        } else{
            return false;
        }

        // base64_encode // criptografa
        // base65_decode // descriptografa
    }

    /**
     * recuperar Senha 
     * @param  string $email 
     * @return string - (E) para usuario não localizado, (B) - para usuário bloqueado, (S) - sucesso
     */
    public function recuperarSenha($email)
    {
        $email = strtolower(trim($email));

        $sql = $this->pdo->prepare('SELECT * FROM usuarios
                                    WHERE email = :email
                                    ');
        $sql->bindParam(':email',$email);
        $sql->execute();

        //verificar se o e-mail esta cadastrado
        // se o resultado for menor que 1, não possui cadastro
        // rowCount - retorna quantidade de linhas do banco de dados
        if ($sql->rowCount() < 1) {
            
            return 'e';
        }
        //possui cadastro.
        // verificar se está bloqueado
        $usuario = $sql->fetch(PDO::FETCH_OBJ);
        if ($usuario->ativo == 0) {
            return 'b';
        }else{
            // gerar uma nova senha
            $novaSenha = date('His');
            $senha = crypt($novaSenha,$this->salt);
            //atualizar a senha do usuário
            $sqlAtualizar = $this->pdo->prepare('UPDATE usuarios SET 
                                                senha = :senha
                                                trocar_senha = :trocar_senha
                                                WHERE id_usuario = :id_usuario
                                                ');
            $trocar_senha = 1;
            $sqlAtualizar->bindParam(':senha',$senha);
            $sqlAtualizar->bindParam(':id_usuario',$usuario->id_usuario);
            $sqlAtualizar->bindParam('trocar_senha', $trocar_senha);
            $sqlAtualizar->execute();

            // enviar o e-mail para o usuário
            $objEmail = new Email();

            //Montar a Mensagem
            $msg  = 'Olá'.$usuario->nome.'<br>';
            $msg .= 'Sua nova senha é: '.$novaSenha.'<br>';
            $msg .= 'Equipe T86';

            // enviar a MSG
            $objEmail->enviar(
                            'site@quizt86.com.br',
                            'Quiz T86',
                            $msg,
                            'Recuperação de Senha - Quiz T86',
                            $email,
                            $usuario->nome
                                );
            return 's';

        }

    }

    

    

}// fecha a classe
?>