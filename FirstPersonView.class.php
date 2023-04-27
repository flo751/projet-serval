<?php

class FirstPersonView extends Baseclass{

    private $_mapid;

    public function __construct(){
        $base = new Baseclass();
        $_mapid = $base->set_currentmap();
    }

    public function getView(){
       return $_mapid;
    }

    public  function getAnimCompass(){

    }
    
}

?>