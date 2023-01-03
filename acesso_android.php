<?php


//$conectado = new Conexao(); // criação do objeto(instância) da classe conexão

 # Informações sobre o banco de dados:
        $db_host    = "localhost";   // servidor
        $db_nome    = "quiz"; //nome do banco
        $db_usuario = "root"; //usuario do banco
        $db_senha   = "";
        $db_driver  = "mysql";
        $db_porta   = "3306";

try{

$conectado = new PDO("mysql:host=".$db_host."; dbname=". $db_nome, $db_usuario, $db_senha);

$conectado->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$tabela = "usuarios";

// instrução SQL a ser executada com prepared statement
$sql = "SELECT email, nome, nascimento, pontuacao FROM $tabela WHERE email= :email_usuario AND senha= :senha_usuario";

// prepara o SQL juntamente com as variaveis que serão informadas
$resultados = $conectado -> prepare($sql);	

// parametros que preencherão o SQL
$resultados -> bindParam(":email_usuario","teste", PDO::PARAM_STR);
$resultados -> bindParam(":senha_usuario","1234", PDO::PARAM_STR);

//executar a instrução SQL
$resultados -> execute();

// Pegando os dados do DB
foreach ($resultados as $linha) {
	echo "<p>";
	echo $linha['usuario'];
	echo "</p>";
}

echo "<h2>Encontrados: ".$resultados -> rowCont()." resultados</h2>";

	}catch(PDOException $erro){
		echo "Ocorreu um erro: ". $erro;
	}


?>
{
	"web_usuario": "tetes@teste.com.br"
	"web_nome": "Nome do usuário no DB"
	"web_nascimento": "21/07/2020"
	"web_pontuacao": "0"
}