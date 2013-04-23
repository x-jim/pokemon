<?php $pagina = 'oak'; ?>
<?php include('init.php'); ?>
<?php $game->soloEntrenadores(); ?>
<?php

    $s = ($game->getEntrenador()->secuencia)?$game->getSecuenciaById($game->getEntrenador()->secuencia):false;

    $e = $game->getEscenaById($game->getCurrentEscena());

    $enviado = (isset($_POST['next']) && $_POST['next'] == 1);

    //Scripts
    if ($e->script) {
        $scripts = json_decode($e->script);
        foreach ($scripts as $script) {
            switch ($script->action) {
                case 'iniciar':
                    $sql = "UPDATE entrenadores SET iniciado = 1 WHERE id = " . $game->getEntrenador()->id . ";";
                    $game->getConn()->Execute($sql);
                break;

                case 'choices':
                    $choices = $script->params->opciones;
                    if ($enviado) {
                        if (!isset($_POST['choice_value'])) {
                            $enviado = false;
                            $game->addMensaje(new Mensaje("Por favor elige una opción."));
                        }
                    }
                break;
                case 'input_text':
                    $input = $script->params->opcion;
                    if ($enviado) {
                        if ($_POST['input_value'] == '') {
                            $enviado = false;
                            $game->addMensaje(new Mensaje("Por favor completa todos los campos."));
                        }
                    }
                break;
                case 'req':
                    $entrenador = $game->getEntrenador();
                    if (isset($script->params->llave)) {
                        if (!$entrenador->hasLlave($script->params->llave)) {
                            if (isset($script->params->escena)) {
                                $entrenador->escena = $script->params->escena;
                                $game->updateEntrenador($entrenador);
                                $game->redirect('oak.php');
                            }
                        }
                    }
                break;
            }
        }
    }

    //Procesar escena
    if ($enviado) {
        if ($e->script) {
            foreach ($scripts as $script) {
                if (isset($script->action) && $script->action == "fin") {
                    $game->salirDeSecuencia();
                    $game->redirect('map.php');
                }
            }
        }
        try  {
            $opciones = array();
            if (isset($input)) {
                $opciones['input_value'] = $_POST['input_value'];
                $opciones['input_name'] = $input;
            }
            if (isset($choices)) {
                $opciones['choice_name'] = $_POST['choice_value'];
                $opciones['choice_value'] = $choices;
            }
            $e = $game->pasarEscena($opciones);
            $game->redirect('oak.php');
        } catch (EscenaException $ee) {
            echo "Error de escena: " . $ee->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }





?>
<?php include('_encabezado.php'); ?>
<title>Pokemon</title>
<?php include('_arriba.php'); ?>
    <div class="row">
        <div class="span4"><img src="uploads/escenas/<?php echo $e->getImagen(); ?>" /></div>
        <div class="span8">
            <p><?php echo $game->parseEscenaText($e); ?></p>
            <form method="post" action="">
                <?php if (isset($input)) { ?>
                <input type="text" name="input_value" />
                <?php } ?>
                <?php if (isset($choices)) { ?>
                <?php for ($i = 0; $i < count($choices); $i++) { ?>
                <label for="choice_<?php echo $i; ?>"><input id="choice_<?php echo $i; ?>" type="radio" name="choice_value" value="<?php echo $i; ?>" /> <?php echo $choices[$i]->titulo; ?></label>
                <?php } ?>
                <?php } ?>
                <input type="submit" class="btn btn-info pull-right" value="Siguiente" />
                <input type="hidden" value="1" name="next" />
            </form>
        </div>
    </div>
<?php include('_pie.php'); ?>