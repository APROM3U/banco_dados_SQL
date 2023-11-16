<?php

define("TIPO", $_POST['tipo']);      // Tipo de base de dados (MySQL/PostgreSQL/SQLServer)
define("ENDERECO", $_POST['host']);  // Endereço do host 
define("BASE", $_POST['database']);  // Base de dados
define("USERNAME", $_POST['login']); // Login de acesso
define("PASSWORD", $_POST['senha']); // Senha de acesso

$servidor = ENDERECO;
$usuario = USERNAME;
$senha = PASSWORD;
$bancoDados = BASE;
$tipo = TIPO;

$porta;
$conexao;

try {
    //code...
    switch ($tipo) {

        case 1:

            $porta = 3306;
            $conexao = new PDO("mysql:host=$servidor;port=$porta;dbname=$bancoDados;user=$usuario;password=$senha");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            break;

        case 2:

            $porta = 5432;
            $conexao = new PDO("pgsql:host=$servidor;port=$porta;dbname=$bancoDados;user=$usuario;password=$senha");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            break;

        case 3:

            $porta = 1433;
            $conexao = new PDO("sqlsrv:Server=$servidor;Database=$bancoDados", $usuario, $senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            break;

        default:

            $conexao = new PDO("");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Selecione um tipo de banco de dados";
            break;
    }
} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage() . " verifique os dados informados");
} finally {

    echo "Conexão ao banco de dados $bancoDados bem-sucedida!!!";
    echo "Versão de PHP ", phpversion();
    $conexao_close();
    $porta = null;
    $conexao = null;
}
