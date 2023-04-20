<?php
class Baseclass{
    protected $_currentX; 
    protected $_currentY;
    protected $_currentAngle;
    protected $_dbh; 
    

    public function __construct(){
        $this->_dbh = new DataBase();

    }

    public function setcurrentx(int $_currentX){
        $this->_currentX = $_currentX;
    }

    public function getcurrentx(){
         return $this->_currentX;
    }

    public function setcurrenty(int $_currentY){
        $this->_currentY = $_currentY;
    }

    public function getcurrenty(){
        return $this->_currentY;
    }

    public function setcurrentangle(int $_currentAngle){
        $this->_currentAngle = $_currentAngle;
    }

    public function getcurrentangle(){
        return $this->_currentAngle;
    }

    public function init(){
        $this->_currentX = 0; 
        $this->_currentY = 1;
        $this->_currentAngle = 0;
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
        
    }
    public function _TurnRight(){
        
    }
    public function _TurnLeft(){
        
    }

}

?>