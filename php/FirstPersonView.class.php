<?php

class FirstPersonView extends BaseClass
{
    /*******************
     * CONSTANTES *
     *******************/
    const PATH_IMAGES = "images/";

    /*
     * Path where the images are
     */
    protected $imagePath;

    /*
     * Current map id
     */
    protected $mapId;

    /*
     * Current map status
     */
    protected $statusAction;

    /***************
     * CONSTRUCTOR *
     ***************/

    function __construct()
    {
        parent::__construct();
    }

    /**********************
     * GETTERS ET SETTERS *
     **********************/

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getMapId()
    {
        return $this->mapId;
    }

    public function getStatusAction()
    {
        $map = $this->getMapIdFromCoordinates($this->currentX, $this->currentY, $this->currentAngle);
        error_log("Nous sommes en map : " . $map);
        $sql = "SELECT status_action FROM map WHERE id = " . $map;
        error_log($sql);
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);
        error_log(print_r($res, 1));
        return $res->status_action;
    }

    public function setImagePath()
    {
        $this->imagePath = self::PATH_IMAGES;
    }

    public function setMapId(int $id)
    {
        $this->mapId = $id;
    }

    public function setStatusAction(int $id)
    {
        $this->statusAction = $id;
    }

    /* List Of Functions :
     *
     * getView
     * getAnimCompass

    
    /*
     * Returns the current image filename
     *
     * @return      string
     * @access      public
     */

    public function getView()
    {
        $map = $this->getMapIdFromCoordinates($this->currentX, $this->currentY, $this->currentAngle);
        $sql = "SELECT path FROM images
                WHERE map_id = " . $map
            . " AND status_action = " . $this->getStatusAction();

        error_log("get view : " . $sql);
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);

        if (isset($res->path)) {
            return $this->getImagePath() . $res->path;
        } else {
            return false;
        }
    }

    public function getAnimCompass()
    {
        return "rotate" . $this->currentAngle;
    }
}
