<?php

class FirstPersonAction extends BaseClass
{
    /*
     * Inventaire
     */
    protected $inventory;

    /*
     * Current map status
     */
    protected $statusAction;
    /***************
     * CONSTRUCTOR *
     ***************/

    public function __construct()
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
        error_log("status en map " . $map . " " . print_r($res, 1));
        return $res->status_action;
    }

    public function getInventory()
    {
        return $this->inventory;
    }

    /*
     * Check if an action is possible at this place
     *
     * @return  bool
     * @access  public
     */
    public function checkAction()
    {
        $map = $this->getMapIdFromCoordinates($this->getCurrentX(), $this->getCurrentY(), $this->getCurrentAngle());
        $sql = "SELECT id, action, item_id, requis FROM action WHERE map_id = " . $map
            . " AND status = " . $this->getStatusAction();

        //error_log($sql);
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);
        error_log("checkAction :" . print_r($res, 1));

        // Premiere condition : existe t il une action ?
        if (isset($res->id) && $res->id > 0) {
            // Seconde condition : si item requis, est-il dans l'inventaire ?
            if ($res->requis == 1) {
                error_log("requis " . $res->item_id);
                error_log("invent : " . print_r($_SESSION['inventory'], 1));
                if (in_array($res->item_id, $_SESSION['inventory'])) {
                    error_log("J'ai l'objet requis");
                    return true;
                } else {
                    error_log("J'ai PAS l'objet requis");
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function doAction()
    {
        $map = $this->getMapIdFromCoordinates($this->getCurrentX(), $this->getCurrentY(), $this->getCurrentAngle());
        $sql = "SELECT id, action, item_id, status FROM action 
                WHERE map_id = " . $map
            . " AND status = " . $this->getStatusAction();
        error_log("Do action SQL : " . $sql);
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);

        error_log("Do action : " . print_r($res, 1));

        if (isset($res->id)) {
            $res->status++;
            $sql1 = "UPDATE map SET status_action = " . $res->status . " WHERE id = " . $map;
            $query1 = $this->dbh->prepare($sql1);
            $query1->execute();

            switch ($res->action) {
                case 'take':
                    // maj inventaire
                    if (!empty($_SESSION) && !in_array($res->item_id, $_SESSION['inventory'])) {
                        $_SESSION['inventory'][] = $res->item_id;
                        error_log("invent : " . print_r($_SESSION['inventory'], 1));
                    }
                    break;
                case 'use':
                    if (in_array($res->item_id, $_SESSION['inventory'])) {
                        $keyItem = array_keys($_SESSION['inventory'], $res->item_id);
                        error_log("cle inventaire " . print_r($keyItem, 1));
                        unset($_SESSION['inventory'][$keyItem[0]]);
                        error_log(print_r($_SESSION['inventory'], 1));
                    }
                    break;

                default:
                    break;
            }
        }
    }
}
