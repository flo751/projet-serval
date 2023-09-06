<?php
class FirstPersonText extends BaseClass
{

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


    public function getStatusAction()
    {
        $map = $this->getMapIdFromCoordinates($this->currentX, $this->currentY, $this->currentAngle);
        error_log("Nous sommes en map : " . $map);
        $sql = "SELECT status_action FROM map WHERE id = " . $map;
        //error_log($sql);
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);
        error_log(print_r($res, 1));
        return $res->status_action;
    }

    public function setStatusAction(int $id)
    {
        $this->statusAction = $id;
    }

    /*******************
     * PUBLIC FUNCTIONS *
     ********************/

    /*
     * Returns the current text
     *
     * @return      string
     * @access      public
     */
    public function getText()
    {
        $map = $this->getMapIdFromCoordinates($this->currentX, $this->currentY, $this->currentAngle);
        $sql = "SELECT text FROM text
                WHERE map_id = " . $map
            . " AND status_action = " . $this->getStatusAction();

        //error_log($sql);

        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);

        if (isset($res->text)) {
            return $res->text;
        }
    }
}
