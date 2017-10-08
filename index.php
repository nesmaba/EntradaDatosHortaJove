<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
 require_once 'Modelo/Login.php';
?>
<html>
    <head>
        <title>Login L'Horta Jove</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <!-- vinculando a libreria Jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Libreria java script de bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="login-page">
            <h1> L'Horta Jove </h1>
            
            <?php
		 //Datos para ingresar
		 //usuario:       nesmaba
		 //Contraseña: 1234
                //Se realiza la validacion de las variable globales
		 if(!empty($_POST['user']) && !empty($_POST['pass'])){
                    echo "holaaaa";
                     var_dump($_POST);
                    $login=new Login($_POST['user'],$_POST['pass']);
                    $login->ingresar();
                    //Muestra el mesaje de error al usuario
                    echo $login->mostrarMsg();
		 }
            ?>
            
            <div class="form">
              <form class="register-form" action="" method="post">
                <input type="text" placeholder="nombre"/>
                <input type="password" placeholder="password"/>
                <input type="text" placeholder="email"/>
                <button type="submit">create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
              </form>
              <form class="login-form"  action="" method="post">
                <input type="text" name="user" placeholder="usuario"/>
                <input type="password" name="pass" placeholder="password"/>
                <button type="submit">entrar</button>
                <!-- <p class="message">Not registered? <a href="#">Create an account</a></p> -->
              </form>
            </div>
        </div>
    </body>
</html>

