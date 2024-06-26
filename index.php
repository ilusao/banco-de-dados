<?php include 'conecto.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Finanças</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Minhas Finanças</div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="financiamento.php">Financiamento</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
            <div class="login-join">
                <a href="Entrar.php" class="login">💵Entrar💵</a>
                <a href="CPF.php" class="join">Junte-se a nós ➡️</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Bem-Vindo</h1>
                <h2>Finanças</h2>
                <p>Gerencie seu dinheiro, simplifique sua vida.</p>
                <a href="CPF.php" class="btn-primary">Junte-se a nós ➡️</a>
                <a href="Leitura.php" class="btn-secondary">Leia mais</a>
            </div>
            <div class="velha-image">
                <img src="images\imagem1.png" alt="Imagem principal">
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Minhas Finanças. Sem uso comercial.</p>
    </footer>
</body>
</html>