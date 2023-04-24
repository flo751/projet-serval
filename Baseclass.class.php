<?php
class Baseclass{
    protected $_currentX; 
    protected $_currentY;
    protected $_currentAngle;
    protected $_currentMap;
    protected $_dbh; 
    

    public function __construct(){
        $this->_dbh = new DataBase();

    }

    public function set_currentx(int $_currentX){
        $this->_currentX = $_currentX;
    }

    public function get_currentx(){
         return $this->_currentX;
    }

    public function set_currenty(int $_currentY){
        $this->_currentY = $_currentY;
    }

    public function get_currenty(){
        return $this->_currentY;
    }

    public function set_currentangle(int $_currentAngle){
        $this->_currentAngle = $_currentAngle;
    }

    public function get_currentangle(){
        return $this->_currentAngle;
    }

    public function set_currentmap(str $_currentMap){
        $this->_currentMap = $_currentMap;
    }

    public function get_currentmap(){
         return $this->_currentMap;
    }
    public function init(){
        $this->_currentX = 0; 
        $this->_currentY = 1;
        $this->_currentAngle = 0;
        $this->_currentMap =  "01-0.jpg";
    }
    
    private function _checkMove(int $newX, int $newY, int $_currentAngle){

        $stmt = $this->_dbh->prepare("SELECT * FROM map WHERE coordx= $newX AND coordy = $newY AND
        direction= $_currentAngle");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }

    public function _checkForward(){

        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
        case 0:
            $newX++;
            break;
        case 90:
            $newY++;
            break;
        case 180:
            $newX--;
            break;
        case 270:
            $newY--;
            break;
    }
    
    return $this->_checkMove($newX,$newY,$this->_currentAngle);
    }
    public function _checkBack(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
        case 0:
            $newX--;
            break;
        case 90:
            $newY--;
            break;
        case 180:
            $newX++;
            break;
        case 270:
            $newY++;
            break;
    }
    return $this->_checkMove($newX,$newY,$this->_currentAngle);
    }
    
    public function _checkRight(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
        case 0:
            $newY--;
            break;
        case 90:
            $newX++;
            break;
        case 180:
            $newY++;
            break;
        case 270:
            $newX++;
            break;
    }
    return $this->_checkMove($newX,$newY,$this->_currentAngle);
    }
    
    public function _checkLeft(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
            case 0:
                $newY++;
                break;
            case 90:
                $newX--;
                break;
            case 180:
                $newY--;
                break;
            case 270:
                $newX++;
                break;
    }
    return $this->_checkMove($newX,$newY,$this->_currentAngle);
    }
     
    public function _goForward(){
        error_log('_goForward()');

        $newX = $this->_currentX;
        $newY = $this->_currentY;
        switch($this->_currentAngle){
        case 0:
            $newX++;
            break;
        case 90:
            $newY++;
            break;
        case 180:
            $newX--;
            break;
        case 270:
            $newY--;
            break;
        }
        $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordx = $newX AND coordy = $newY AND direction = $this->_currentAngle");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $map_id = $result["id"];

        $stmt = $this->_dbh->prepare("SELECT * FROM images WHERE $map_id=map_id");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $newMap = $result["path"];
            $this->_currentX= $newX;
            $this->_currentY= $newY;
    }
    public function _goBack(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
        case 0:
            $newX--;
            break;
        case 90:
            $newY--;
            break;
        case 180:
            $newX++;
            break;
        case 270:
            $newY++;
            break;
    }
    $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordx = $newX AND coordy = $newY AND direction = $this->_currentAngle");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $map_id = $result["id"];

    $stmt = $this->_dbh->prepare("SELECT * FROM images WHERE $map_id=map_id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $newMap = $result["path"];
        $this->_currentX= $newX;
        $this->_currentY= $newY;

    }
    public function _goRight(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
        case 0:
            $newY--;
            break;
        case 90:
            $newX++;
            break;
        case 180:
            $newY++;
            break;
        case 270:
            $newX++;
            break;
    }
    $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordx = $newX AND coordy = $newY AND direction = $this->_currentAngle");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $map_id = $result["id"];

    $stmt = $this->_dbh->prepare("SELECT * FROM images WHERE $map_id=map_id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $newMap = $result["path"];

        $this->_currentX= $newX;
        $this->_currentY= $newY;

    }
    public function _goLeft(){
        $newX = $this->_currentX;
        $newY = $this->_currentY;
        
        switch($this->_currentAngle){
            case 0:
                $newY++;
                break;
            case 90:
                $newX--;
                break;
            case 180:
                $newY--;
                break;
            case 270:
                $newX++;
                break;
    }
    $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordx = $newX AND coordy = $newY AND direction = $this->_currentAngle");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $map_id = $result["id"];

    $stmt = $this->_dbh->prepare("SELECT * FROM images WHERE $map_id=map_id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $newMap = $result["path"];
        $this->_currentX= $newX;
        $this->_currentY= $newY;
    }
    public function _TurnRight(){

        $newAngle = $this->_currentAngle;
        switch($this->_currentAngle){
            case 0 : {
                $newAngle =270;
                break;
            }
            case 90 : {
                $newAngle = 0;
                break;
            }
            case 180 : {
                $newAngle = 90;
                break;
            }
            case 270 : {
                $newAngle = 180;
                break;
            }
    }
    $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordx = $this->_currentX AND coordy = $this->_currentY AND direction = $newAngle");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $map_id = $result["id"];

    $stmt = $this->_dbh->prepare("SELECT * FROM images WHERE $map_id=map_id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $newMap = $result["path"];
    $this->_currentAngle = $newAngle;
    }

    public function _TurnLeft(){
        $newAngle = $this->_currentAngle;
        switch($this->_currentAngle){
            case 0:
                $newAngle=90;
                break;
            case 90:
                $newAngle=180;
                break;
            case 180:
                $newAngle=270;
                break;
            case 270:
                $newAngle=0;
                break;
    }
    $stmt = $this->_dbh->prepare("SELECT id FROM map WHERE coordx = $this->_currentX AND coordy = $this->_currentY AND direction = $newAngle");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $map_id = $result["id"];

    $stmt = $this->_dbh->prepare("SELECT * FROM images WHERE $map_id=map_id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $newMap = $result["path"];
    $this->_currentAngle = $newAngle;
    }
    }



?>