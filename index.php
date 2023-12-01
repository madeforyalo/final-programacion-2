<?php
include_once "header.php";

?>

<link href="signin.css" rel="stylesheet">

  <title>Inicio de sesion</title>
</head>
<body class="text-center">
    <form class="form-signin" method="post" action="loggin.php">
        <h1 class="h3 mb-3 font-weight-normal">Inicie sesion</h1>
        
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" required="" autofocus="">
        
        <input type="password" class="form-control" placeholder="Password" name="pass" required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> recuerdeme
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        
    </form>
        

<?php
include_once "footer.php";
?>