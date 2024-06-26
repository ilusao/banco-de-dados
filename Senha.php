<?php
include 'conecta.php';

session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: CPF.php");
    exit;
}

$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    
    if ($senha !== $confirma_senha) {
        header("Location: registrar2.php?error=password_mismatch");
        exit();
    }

    $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

   
    $sql_verifica_usuario = "SELECT * FROM usuarios WHERE user_id = $user_id";
    $result_verifica_usuario = $fortuna->query($sql_verifica_usuario);

    if ($result_verifica_usuario->num_rows > 0) {
        
        $sql = "UPDATE usuarios SET user_name='$nome', user_email='$email', user_password='$senha' WHERE user_id=$user_id";
    } else {
        
        $sql = "INSERT INTO usuarios (user_id, user_name, user_email, user_password) VALUES ($user_id, '$nome', '$email', '$senha')";
    }

    if ($fortuna->query($sql) === TRUE) {
        header('Location: Menu.php');
        exit;
     
    } else {
        echo "Erro ao inserir/atualizar registro: " . $fortuna->error;
    }


    $fortuna->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Minhas Finanças</title>
    <link rel="stylesheet" href="css/Senha.css">
</head>
<body>
    <h1>Você está quase lá 💪</h1>
    <div class="container">
        <div class="content">
            <div class="image-container">
                <img src="images\Imagem3.png" alt="Imagem">
            </div>
            <div class="form-container">
                <form id="register-form" action="" method="POST">
                    <div class="input-group">
                        <label for="nome">Qual seu nome?</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="input-group">
                        <label for="senha">Que tal escolher uma senha?</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Qual seu email?</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="confirma_senha">Confirme a senha</label>
                        <input type="password" id="confirma_senha" name="confirma_senha" required>
                    </div>
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] == 'password_mismatch') {
                        echo '<p id="password-error" class="error-message">As senhas estão diferentes!</p>';
                    }
                    ?>
                    <div class="buttons">
                        <button type="button" onclick="window.location.href='index.php'">Voltar</button>
                        <button type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>