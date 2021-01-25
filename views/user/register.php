<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SenntCloud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
</head>

<body>
<div id="fondo" class="f-register">

<div class="login-box register">
    <div id="logo"><i class="fa fa-cloud fa-2x"></i></div>
    <h1>Registrarme</h1>
    <?php if(isset($_SESSION['err'])){ ?>
        <?= $_SESSION['err'] ?>
    <?php } ?>
    <form action="<?= base_url ?>user/save/" method="POST">
        <label for="name">Nombre</label>
        <input type="text" name="name" placeholder="Nombre" autofocus>
        
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email">
            
        <label for="password">Contraeña</label>
        <input type="password" name="password" placeholder="Contraseña">

        <input type="submit" value="Registrarme">
        <a href="<?= base_url ?>user/login/">¿Ya tienes cuenta? Inicia sesion aqui</a>
    </form>
</div>

</div>

</body>
</html>

<?php Utils::deleteSession('err'); ?>