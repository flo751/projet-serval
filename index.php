<?php 

    function chargerClasse($classe)
    {require $classe . '.class.php';}
    spl_autoload_register('chargerClasse');

    $DB = new DataBase;
    $baseclass = new Baseclass;

    /*if(!isset ($_POST['turnleft'])){
         $baseclass->_Turnleft();
    }
    if(!isset ($_POST['turnright'])){
         $baseclass->_TurnRight();
    }
    if(!isset ($_POST['up'])){
         $baseclass->_goForward();
    }
    if(!isset ($_POST['left'])){
         $baseclass->_goLeft();
    }
    if(!isset ($_POST['right'])){
         $baseclass->_goRight();
    }
    if(!isset ($_POST['down'])){
         $baseclass->_goBack();
    }*/

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="index.css" />
    <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8">
    <title>Page de test PHP</title>
</head>
<body>
    <div class="background">
        
    </div>
        <div class="buttons">
            <table>
                <form>
                    <div class="control">
                        <button type="submit" name="turnleft">\</button>
                        <button type="submit" name="up" <?php if($baseclass->_checkForward() == FALSE){
                            echo 'disable';
                        } ?>>^</button>
                        <button type="submit" name="turnright">/</button>
                    </div>
                    <div>
                        <button type="submit" name="left" <?php if($baseclass->_checkLeft() == FALSE){
                            echo 'disable';
                        } ?>><</button>
                        <button type="submit" name="action">X</button>
                        <button type="submit" name="right" <?php if($baseclass->_checkRight() == FALSE){
                            echo 'disable';
                        } ?>>></button>
                    </div>
                    <div>
                        <button type="submit" name="down" <?php if($baseclass->_checkBack() == FALSE){
                            echo 'disable';
                        } ?>>V</button>
                    </div>
                </form>
            </table>
        </div>
        <div class="compass">
            <img src="./assets/compass.png">
        </div>
    </div>
    <div class="text">
    </div>
    </body>
</html>