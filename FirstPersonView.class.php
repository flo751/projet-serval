<?php

class FirstPersonView extends Baseclass{

    private $_mapid;

    public function __construct(){
       parent::__construct();
    }

    public function getView(BaseClass $baseclass){
            $_mapId = $baseclass->getMapId();
            $_mapStatus = $baseclass->getMapStatus();

            $sql = "SELECT path FROM images WHERE map_id = :mapId AND status_action=:status";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':mapId', $_mapId, PDO::PARAM_INT);
            $query->bindParam(':status', $_mapStatus, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();
            
            return $result['path'];
    }

    public  function getAnimCompass(BaseClass $baseclass){
        $newmap = $this->_mapid;
        switch($baseclass->_currentAngle){
            case 0 : {
                $newmap =  "east";
                break;
            }
            case 90 : {
                $newmap ="north";
                break;
            }
            case 180 : {
                $newmap = "west";
                break;
            }
            case 270 : {
                $newmap = "south";
                break;
            }
        }
        $this->_mapid = $newmap;   
        return  $this->_mapid;
    }
    
}

?>