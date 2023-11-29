<?php
include_once "header.php";

?>
<!-- Custom styles for this template -->
<link href="signin.css" rel="stylesheet">

  <title>Inicio de sesion</title>
</head>
<body class="text-center">
    <form class="form-signin" method="get" action="loggin.php">
        <!-- <img class="mb-4" src="https://cdn.icon-icons.com/icons2/1465/PNG/512/588hospital_100778.png" alt="" width="72"
            height="72"> -->
        <h1 class="h3 mb-3 font-weight-normal">Inicie sesion</h1>
        <!-- <label for="inputEmail" class="sr-only">Usuario</label> -->
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" required="" autofocus="">
        <!-- <label for="inputPassword" class="sr-only">Password</label> -->
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