<?php 

    function chargerClasse($classe)
    {require $classe . '.class.php';}
    spl_autoload_register('chargerClasse');

    $database = new DataBase();
    $baseclass = new Baseclass();
    
    if(empty($_POST)){$baseclass->init();
    }else{
        $baseclass->setcurrentx($_POST['X']);
        $baseclass->setcurrenty($_POST['Y']);
        $baseclass->setcurrentangle($_POST['Angle']);
    }

    if(!isset ($_POST['turnleft'])){
        $baseclass->_TurnLeft();
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
    }
    var_dump($baseclass);
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
                            echo 'disabled';
                        } ?>>^</button>
                        <button type="submit" name="turnright">/</button>
                    </div>
                    <div>
                        <button type="submit" name="left" <?php if($baseclass->_checkLeft() == FALSE){
                            echo 'disabled';
                        } ?>><</button>
                        <button type="submit" name="action">X</button>
                        <button type="submit" name="right" <?php if($baseclass->_checkRight() == FALSE){
                            echo 'disabled';
                        } ?>>></button>
                    </div>
                    <div>
                        <button type="submit" name="down" <?php if($baseclass->_checkBack() == FALSE){
                            echo 'disabled';
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
    <input type="hidden" name="X" value="<?php echo $baseclass->getcurrentx(); ?>">
    <input type="hidden" name="Y" value="<?php echo $baseclass->getcurrenty(); ?>">
    <input type="hidden" name="Angle" value="<?php echo $baseclass->getcurrentangle(); ?>">
    </body>
</html>