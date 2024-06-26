<?php
include 'conecta.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrCPF = $_POST['usernameOrCpf'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE user_name = '$usernameOrCPF' OR user_cpf = '$usernameOrCPF'";
    $result = $fortuna->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_password = $row['user_password'];

        if ($senha === $db_password) {
            header("Location: Menu.php");
            exit();
        } else {
            $errors[] = "Senha incorreta. Por favor, tente novamente.";
        }
    } else {
        $errors[] = "Usuário não encontrado. Verifique o nome ou CPF e tente novamente.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Minhas Finanças</title>
    <link rel="stylesheet" href="css\Entrar.css">
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="watermark">Fortuna</div>
    <div class="container">
        <div class="login-box">
            <h1>Bem-vindo</h1>
            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username ou CPF" name="usernameOrCpf" value="<?php echo htmlspecialchars($usernameOrCPF ?? ''); ?>" required>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                </div>
                <a href="Recuperar.php" class="forgot-password">Esqueci minha senha</a>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.querySelector('input[name="password"]');
            var icon = document.querySelector('.fa-eye');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>