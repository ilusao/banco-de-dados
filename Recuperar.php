<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Minhas Finanças</title>
    <link rel="stylesheet" href="css\Recuperar.css">
</head>
<body>
<div class="watermark">Fortuna</div>
    <div class="recuperar-senha-container">
        <h2>Recuperar Senha</h2>
        <form action="recuperar_senha.php" method="post">
            <div class="input-group">
                <label for="email">Digite seu email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Enviar</button>
            <a href="Entrar.php" class="back-to-login">Voltar ao login</a>
        </form>
    </div>
</body>
</html>