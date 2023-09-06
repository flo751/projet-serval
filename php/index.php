<?php

session_start();

function loadClass($class)
{
    require $class . '.class.php';
}

spl_autoload_register('loadClass');

$base = new BaseClass();
$fpv = new FirstPersonView();
$fpt = new FirstPersonText();
$fpa = new FirstPersonAction();
//var_dump($base);
//error_log(print_r($base, 1));

error_log("POST :" . print_r($_POST, 1));

if (!empty($_POST)) {
    $fpv->setCurrentX($_POST["current_x"]);
    $fpv->setCurrentY($_POST["current_y"]);
    $fpv->setCurrentAngle($_POST["current_angle"]);
    $fpt->setCurrentX($_POST["current_x"]);
    $fpt->setCurrentY($_POST["current_y"]);
    $fpt->setCurrentAngle($_POST["current_angle"]);
    $fpa->setCurrentX($_POST["current_x"]);
    $fpa->setCurrentY($_POST["current_y"]);
    $fpa->setCurrentAngle($_POST["current_angle"]);

    /*if (!empty($_SESSION))
        error_log("INVENTAIRE : " . print_r($_SESSION['inventory'], 1));*/
} else {
    error_log("init");
    $base->initTables();
    $_SESSION['inventory'] = [];

    $fpv->setCurrentX(0);
    $fpv->setCurrentY(1);
    $fpv->setCurrentAngle(0);
    $fpt->setCurrentX(0);
    $fpt->setCurrentY(1);
    $fpt->setCurrentAngle(0);
    $fpa->setCurrentX(0);
    $fpa->setCurrentY(1);
    $fpa->setCurrentAngle(0);
}

$fpv->setImagePath();

if (!empty($_POST)) {
    $moveKey = array_keys($_POST)[0];

    switch ($moveKey) {
        case 'go-forward':
            $fpv->goForward();
            $fpt->goForward();
            $fpa->goForward();
            break;
        case 'go-back':
            $fpv->goBack();
            $fpt->goBack();
            $fpa->goBack();
            break;
        case 'go-left':
            $fpv->goLeft();
            $fpt->goLeft();
            $fpa->goLeft();
            break;
        case 'go-right':
            $fpv->goRight();
            $fpt->goRight();
            $fpa->goRight();
            break;
        case 'turn-left':
            $fpv->turnLeft();
            $fpt->turnLeft();
            $fpa->turnLeft();
            break;
        case 'turn-right':
            $fpv->turnRight();
            $fpt->turnRight();
            $fpa->turnRight();
            break;
        case 'interaction':
            $fpa->doAction();
            break;
    }
}

?>
<html>

<head>
    <title>Serval</title>
    <link rel="stylesheet" href="./includes/style/style.css">
</head>

<body>
    <div>
        <img class="bg" src="./assets/941723.jpg" alt="background" />
    </div>
    <div class="layer2">
        <div class="container-view">
            <img src="<?php echo $fpv->getView(); ?>" alt="background" />
            <div class="container-text">
                <div class="right">
                    <?php echo $fpt->getText(); ?>
                    <?php echo "(" . $fpt->getMapIdFromCoordinates($fpa->getCurrentX(), $fpa->getCurrentY(), $fpa->getCurrentAngle()) . ")"; ?>
                </div>
                <div class="left">
                    <form name="movements" action="index.php" method="post">
                        <table class="control">
                            <tr>
                                <td>
                                    <input type="submit" name="turn-left" value="&nbsp;&#92&nbsp;" <?php echo ($fpv->checkTurnLeft()) ? "" : "disabled"; ?> />
                                </td>
                                <td>
                                    <input type="submit" name="go-forward" value="&nbsp;&#94&nbsp;" <?php echo ($fpv->checkForward()) ? "" : "disabled"; ?> />
                                </td>
                                <td>
                                    <input type="submit" name="turn-right" value="&nbsp;&#47&nbsp;" <?php echo ($fpv->checkTurnRight()) ? "" : "disabled"; ?> />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="go-left" value="&nbsp;&#60&nbsp;" <?php echo ($fpv->checkLeft()) ? "" : "disabled"; ?> />
                                </td>
                                <td>
                                    <input type="submit" name="interaction" value="&nbsp;&#120&nbsp;" <?php echo ($fpa->checkAction()) ? "" : "disabled"; ?> />
                                </td>
                                <td>
                                    <input type="submit" name="go-right" value="&nbsp;&#62&nbsp;" <?php echo ($fpv->checkRight()) ? "" : "disabled"; ?> />
                                </td>
                            </tr>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>
                                    <input type="submit" name="go-back" value="&nbsp;V&nbsp;" <?php echo ($fpv->checkBack()) ? "" : "disabled"; ?> />
                                </td>
                                <td>

                                </td>
                        </table>

                        <!-- BEGIN IMPORTANT HIDDEN INFO -->
                        <input type="hidden" name="current_x" value="<?php echo $fpv->getCurrentX(); ?>" />
                        <input type="hidden" name="current_y" value="<?php echo $fpv->getCurrentY(); ?>" />
                        <input type="hidden" name="current_angle" value="<?php echo $fpv->getCurrentAngle(); ?>" />
                        <input type="hidden" name="status_action" value="<?php echo $fpv->getStatusAction(); ?>" />
                        <!-- END IMPORTANT HIDDEN INFO -->
                    </form>
                    <div id="container_compass">
                        <img id="image" class="<?php echo $fpv->getAnimCompass() ?>" src="./assets/compass.png" alt="" width="120px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>