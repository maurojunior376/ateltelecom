<?php

set_time_limit(0);

$cpf_user=$_GET['cpf'];
$pass_user=$_GET['pass'];
$action_=$_GET['action'];

function valid_login($action='false'){
	global $cpf_user,$pass_user,$action_;
	if ($_SERVER['REQUEST_METHOD'] === 'GET' && $action_ ==='login'){
		$url = 'http://central.ateltelecom.com.br/loginPost.php';
		$dataPost = array('var_cpf' => $cpf_user, 'pass' => $pass_user);
		$options  = array(
			'http' 	  => array(
			'header'  => "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n",
			'method'  => 'POST',
			'content' => http_build_query($dataPost),
			)
		);
		$context  = stream_context_create($options);
		$content  = file_get_contents($url, false, $context);			
		if (!strpos($content,'Senha incorreta') && strpos($content,'"status":"true"')){ 
			echo "logged"; // login bem sucedido
		}else{
			echo "invalid"; // erro no login
		}
	}
}
valid_login($cpf_user,$pass_user,$action_);
?>

