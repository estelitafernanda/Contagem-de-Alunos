<?php
session_start();
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$usuario = $password = $confirm_password = "";
$usuario_err = $password_err = $confirm_password_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nome de usuário
    if(empty(trim($_POST["usuario"]))){
        $usuario_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["usuario"]))){
        $usuario_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT usuario FROM cadastro WHERE usuario = :usuario";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":usuario", $param_usuario, PDO::PARAM_STR);
            $param_usuario = trim($_POST["usuario"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $usuario_err = "Este nome de usuário já está em uso.";
                } else{
                    $usuario = trim($_POST["usuario"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Validar senha
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar e confirmar a senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
    
    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($usuario_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO cadastro (usuario, password) VALUES (:usuario, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":usuario", $param_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_usuario = $usuario;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Redirecionar para a página de login
                header("location: index.php");
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Fechar conexão
    unset($pdo);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Contagem de Alunos CEEP</title>
<link rel="stylesheet" type="text/css" href="style2.css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<center>
<img src='WhatsApp_Image_2022-10-27_at_16.49.39-removebg-preview.png'>
</center>
<br>
<br>
<br>
<br>
<center>
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div id="circulo3">
<br>
<br>
<label id="cadastro">CADASTRO</label>
<br>
<br>
<label id="nome">Nome de Usuário:</label>
<br>
<input type="text" id="caixa" name="usuario" class="form-control <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>"</input>
<br>
<span class="invalid-feedback"><?php echo $usuario_err; ?></span>
<br>
<label id="crie">Crie uma senha:</label>
<br>
<input type="password" id="caixa" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>"</input>
<br>
<span class="invalid-feedback"><?php echo $password_err; ?></span>
<br>
<label id="repita">Repita a senha:</label>
<br>
<input type="password" id="caixa" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"</input>
<br>
<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
<p>Já tem uma conta?<a href="index.php">fazer login</a>.</p>
<input type="submit" class="btn btn-primary" id="botao" value="Criar Conta"></input>
<input type="reset" class="btn btn-secondary ml-2" id="botao" value="Apagar Dados"></input>
</div>
</form>
</center>
</body>
</html>