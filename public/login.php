<?php include('init.php'); ?>
<?php $game->soloAnonimos(); ?>
<?php

    $game->setPagina('login');

    if (isset($_POST['enviado']) && $_POST['enviado'] == 1) {
        $mensajes = Tools::Validar($_POST,'
            [
                {
                    "campo":"email",
                    "validadores":[
                        {"tipo":"email","mensaje":"Por favor, ingresa un e-mail válido"},
                        {"tipo":"notEmpty","mensaje":"Por favor, ingresa un e-mail"}
                    ]
                },
                {
                    "campo":"passwd",
                    "validadores":[
                        {"tipo":"notEmpty","mensaje":"Por favor, ingresa una contraseña"}
                    ]
                }
            ]
        ');
        if (empty($mensajes)) { //Validado
            try {
                $game->login($_POST['email'],$_POST['passwd']);
                $game->redirect('.');
                exit();
            } catch (Exception $e) {
                $game->addMensaje(new Mensaje($e->getMessage(),'error'));
            }
        } else {
            $game->addMensajes($mensajes);
        }
    }

?>
<?php include('_encabezado.php'); ?>
<title>Ingresar</title>
<?php include('_arriba.php'); ?>
<form action="login.php" method="post">
    <fieldset>
        <legend>Ingresar</legend>
        <input name="email" type="text" placeholder="E-Mail">
        <input name="passwd" type="password" placeholder="Contraseña">
        <span class="help-block"><a href="#">¿Olvidaste tu contraseña?</a></span>
        <button type="submit" class="btn">Ingresar</button>
    </fieldset>
    <input type="hidden" name="enviado" value="1" />
</form>
<?php include('_pie.php'); ?>