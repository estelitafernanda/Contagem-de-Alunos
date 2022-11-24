<?php
// Inicialize a sessão
session_start();
 
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$usuario = $password = "";
$usuario_err = $password_err = $login_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Verifique se o nome de usuário está vazio
    if(empty(trim($_POST["usuario"]))){
        $usuario_err = "Por favor, insira o nome de usuário.";
    } else{
        $usuario = trim($_POST["usuario"]);
    }
    
    // Verifique se a senha está vazia
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciais
    if(empty($usuario_err) && empty($password_err)){
        // Prepare uma declaração selecionada
        $sql = "SELECT usuario, usuario, password FROM cadastro WHERE usuario = :usuario";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":usuario", $param_usuario, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_usuario = trim($_POST["usuario"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Verifique se o nome de usuário existe, se sim, verifique a senha
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $usuario = $row["usuario"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // A senha está correta, então inicie uma nova sessão
                            session_start();
                            
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["usuario"] = $usuario;     
                          
                           // Redirecionar o usuário para a página de boas-vindas
                            header("location: entrada.php");
                        } else{
                            // A senha não é válida, exibe uma mensagem de erro genérica
                            $login_err = "Nome de usuário ou senha inválidos.";
                        }
                    }
                } else{
                    // O nome de usuário não existe, exibe uma mensagem de erro genérica
                    $login_err = "Nome de usuário ou senha inválidos.";
                }
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
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<center>
<img src='WhatsApp_Image_2022-10-27_at_16.49.39-removebg-preview.png'>
</center>
<br>
<br>
<br>
<br>
<h1 id="contagem">CONTAGEM DE ALUNOS</h1>
<br>
 <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
<center>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div id="Usuario">
<br>
<label id="login">LOGIN</label>
<br>
<label for="nome" id="nome">Usuário:</label>
<br>
<input type="text" id="caixa" name="usuario" <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?> value="<?php echo $usuario; ?>"></input>
<span class="invalid-feedback"><?php echo $usuario_err; ?></span>
<br>
<label for="senha" id="senha">Senha:</label>
<br>
<input type="password" id="caixa" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?></input>
<span class="invalid-feedback"><?php echo $password_err; ?></span>
<br>
<a href="esqueceu.html" id="esqueceu">esqueceu a senha?</a>
<br>
<input type="submit" class="btn btn-primary" id="botao" value="Entrar">
<br>
<a href="cadastro.php" id="botão">cadastre-se</a>
<br>
</div>
</form>
</center>
</body>
</html>