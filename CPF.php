<?php
include 'conecta.php';

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}


session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo']; 

    
    if (!validarCPF($cpf)) {
        echo '<script>alert("CPF inválido! Tente novamente.");</script>';
    } else {
       
        $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf); 

        
        $sql = "INSERT INTO usuarios (user_id, user_name, user_email, user_type, user_password, user_cpf) 
                VALUES (NULL, '', '', '$tipo', '', '$cpfLimpo')";

        if ($fortuna->query($sql) === TRUE) {
            
            $_SESSION['user_id'] = $fortuna->insert_id;

           
            header("Location: Senha.php");
            exit; 
        } else {
            echo "Erro ao registrar CPF: " . $fortuna->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Minhas Finanças</title>
    <link rel="stylesheet" href="css/CPF.css">
</head>
<body>
    <div class="container">
        <h1 class="lingua">Falta pouco...</h1>
        <div class="content">
            <div class="left-side">
                <p>Qual tipo de pessoa você é? 🤔</p>
                <form id="register-form" action="CPF.php" method="POST">
                    <input type="radio" id="juridica" name="tipo" value="juridica" required>
                    <label for="juridica">Jurídica</label><br>
                    <input type="radio" id="fisica" name="tipo" value="fisica" required>
                    <label for="fisica">Física</label>
            </div>
            <div class="right-side">
                <p>Por favor nos diga seu CPF</p>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                <button type="submit">Registrar</button>
            </div>
        </div>
    </div>
</body>
</html>