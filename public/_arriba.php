</head>
<body>
<div class="container">
    <h1><a href=".">Pokemon</a></h1>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">

                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="nav-collapse collapse">
                    <?php if (!$game->getEntrenador()) { ?>
                    <ul class="nav">
                        <li <?php if ($game->getPagina() == 'login') { ?>class="active" <?php } ?>><a href="login.php">Ingresar</a></li>
                        <li <?php if ($game->getPagina() == 'registrarse') { ?>class="active" <?php } ?>><a href="login.php">Registrarse</a></li>
                    <?php } else { ?>
                    <ul class="nav">
                        <li><a href="items.php">Items</a></li>
                        <li><a href="map.php">Mapa</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><a href="salir.php">Salir</a></li>
                    </ul>
                    <?php } ?>
                    </ul>
                </div>


            </div>
        </div>
    </div>

    <?php if ($game->hayMensajes()) { ?>
    <?php foreach ($game->soltarMensajes() as $mensaje) { ?>
        <div class="alert alert-<?php echo $mensaje->tipo; ?>">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php if ($mensaje->titulo) { ?><strong><?php echo $mensaje->titulo; ?></strong><?php } ?><?php echo $mensaje->mensaje; ?>
        </div>
    <?php } ?>
    <?php } ?>