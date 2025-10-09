<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/prime/styles/registro.css">
    <script src="/prime/public/js/validacion_log.js" defer></script>
    <title>login</title>
    


</head>
<body>

    

    <header class = "container text-center py-5 shadow " style = "">
        <div>
            <h1>
                LOGIN 
            </h1>


            <div class = "login-box" >    

                <form method = "post" id = "form" action="/prime/index.php?controller=loginp&action=autenticar" >

                    <input type="text" name = "usuario" placeholder = "Usuario" >
                    <span id = "usuario_error" class ="error"></span>
                    <br> 
                    <input type="password" name="clave" placeholder="Contraseña" >
                    <span id = "clave_error" class ="error"></span>
                    <br>
                    <button type = "submit">check</button>

                </form>

                <div class="links-modern">
                    <ul>
                        <li><a href="registro.php">registrarme</a></li>
                        <li><a href="recuperar.php">Cambiar contraseña</a></li>
                    </ul>

                </div>
                    
            </div>

        </div>
    </header>

    <script src = "/prime/public/js/validacion_log.js" defer></script>

</body>
</html>


