<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>
        <h2> Login de Acesso </h2>
    </header>
    <form action="?query=conteudo" method="POST">
        <input type="email" name="email" placeholder="Digite seu E-mail cadastrado">
        <input type="text" name="senha" placeholder="Digite sua senha">

        <button type="submit">Entrar</button>
    </form>
    <div>
    <a href="?query=admin/cliente/cadastro-cliente">Não tem conta? Cadastre-se</a>
    </div> 
</body>
</html>