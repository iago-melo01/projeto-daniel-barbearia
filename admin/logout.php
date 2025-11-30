<?php
    session_start(); // iniciar sessão para poder destruí-la
    
    //destruir todas as variaveis de sessão
    $_SESSION = array();
    
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    //  destroi a sessão
    session_destroy();
    
    //redireciona para pagina de login
    header("Location: ?query=login-barbeiro");
    exit;
?>

