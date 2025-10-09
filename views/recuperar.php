<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/registro.css">
    <title>Cambio de Contraseña</title>

</head>
<body>

    

    <header class = "container text-center py-5 shadow " style = "">
        <div>
            <h1>
                Cambiar contraseña  
            </h1>


            <div class = "login-box" >    

                <form method="post" id="form" action="../controllers/recuperar_Con.php">

                    <input type="text" name = "email" placeholder = "email" >
                    <span id = "email_error" class = "error" ></span>
                    <br>
                    <input type="password" name="clave" placeholder="Contraseña" >
                    <span id = "contraseña_error" class = "error" ></span>
                    <br>
                    <input type="password" name="clave1" placeholder="Contraseña" >
                    <span id = "contraseña1_error" class = "error" ></span>

                    <br>
                    <button type = "submit">check</button>

                </form>

                <div class = "links-modern">
                    <ul>
                        <li><a href="../views/registro.php">registrarme</a></li>
                        <li><a href="../views/login.php">login</a></li>
                    </ul>

                </div>
                    
                
            
            </div>



        </div>
    </header>

    <!-- <script src = "../public/js/validacion_cam.js" defer></script> -->

</body>
</html>

