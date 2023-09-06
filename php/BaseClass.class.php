<?php
class BaseClass
{
    /*******************
     * PROPRIETES *
     *******************/

    /*
     * Current coordinates
     */
    protected $currentX;
    protected $currentY;

    /*
     * Current angle
     */
    protected $currentAngle;

    /*
    * Previous coordinates
    */
    protected $previousX;
    protected $previousY;

    /*
     * Current angle
     */
    protected $previousAngle;

    /*
    * Database
    */
    protected $dbh;

    private static $_instance = null;


    /***************
     * CONSTRUCTOR *
     ***************/
    /*
     * @param  array   $map    map matrix
     * @param  int     $curX   X coordinate - 0 by default
     * @param  int     $curY   Y coordinate - 0 by default
     * @param  int     $curAng Current angle - 0 by default
     */
    public function __construct()
    {
        error_log("appel constructeur BaseClass");
        $this->dbh = new DataBase();
    }

    /**********************
     * GETTERS ET SETTERS *
     **********************/

    public function getCurrentX()
    {
        return $this->currentX;
    }

    public function getCurrentY()
    {
        return $this->currentY;
    }

    public function getCurrentAngle()
    {
        return $this->currentAngle;
    }

    public function setCurrentX(int $x)
    {
        $this->currentX = $x;
    }

    public function setCurrentY(int $y)
    {
        $this->currentY = $y;
    }

    public function setCurrentAngle(int $angle)
    {
        $this->currentAngle = $angle;
    }

    public static function getInstance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new BaseClass();
        }

        return self::$_instance;
    }

    /********************
     * PUBLIC FUNCTIONS *
     ********************/

    /*
     * List of functions:
     * initTables
     * checkForward
     * goForward
     * checkBack
     * goBack
     * checkRight
     * goRight
     * checkLeft
     * goLeft
     * checkTurnRight
     * turnRight
     * checkTurnLeft
     * turnLeft
     */

    public function initTables()
    {
        $sql = "UPDATE map SET status_action = 0";
        $query = $this->dbh->prepare($sql);
        $query->execute();
    }

    /*
     * Check Forward
     *
     * Check if it's possible to move forward according to the coordinates and angle
     *
     * @return  bool
     * @access  public
     */
    public function checkForward()
    {
        if ($this->_checkMove(
            $this->currentX + $this->_offset($this->currentAngle)['dx'],
            $this->currentY + $this->_offset($this->currentAngle)['dy'],
            $this->currentAngle
        )) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Go Forward
     *
     * Move forward according to the coordinates and angle
     *
     * @access  public
     */
    public function goForward()
    {
        if ($this->checkForward()) {
            $this->currentX = $this->currentX + $this->_offset($this->currentAngle)['dx'];
            $this->currentY = $this->currentY + $this->_offset($this->currentAngle)['dy'];
        }
    }

    /*
     * Check Back
     *
     * Check if it's possible to move backward according to the coordinates and angle
     *
     * @return  bool
     * @access  public
     */
    public function checkBack()
    {
        if ($this->_checkMove(
            $this->currentX - $this->_offset($this->currentAngle)['dx'],
            $this->currentY - $this->_offset($this->currentAngle)['dy'],
            $this->currentAngle
        ))
            return true;
        else
            return false;
    }

    /*
     * Go Back
     *
     * Move backward according to the coordinates and angle
     *
     * @access  public
     */
    public function goBack()
    {
        if ($this->checkBack()) {
            $this->currentX = $this->currentX - $this->_offset($this->currentAngle)['dx'];
            $this->currentY = $this->currentY - $this->_offset($this->currentAngle)['dy'];
        }
    }

    /*
     * Check Right
     *
     * Check if it's possible to move right according to the coordinates and angle
     *
     * @return  bool
     * @access  public
     */
    public function checkRight()
    {
        if ($this->_checkMove(
            $this->currentX + $this->_offset($this->currentAngle)['dy'],
            $this->currentY - $this->_offset($this->currentAngle)['dx'],
            $this->currentAngle
        ))
            return true;
        else
            return false;
    }

    /*
     * Go Right
     *
     * Move right according to the coordinates and angle
     *
     * @access  public
     */
    public function goRight()
    {
        if ($this->checkRight()) {
            $this->currentX = $this->currentX + $this->_offset($this->currentAngle)['dy'];
            $this->currentY = $this->currentY - $this->_offset($this->currentAngle)['dx'];
        }
    }

    /*
     * Check Left
     *
     * Check if it's possible to move left according to the coordinates and angle
     *
     * @return  bool
     * @access  public
     */
    public function checkLeft()
    {
        if ($this->_checkMove(
            $this->currentX - $this->_offset($this->currentAngle)['dy'],
            $this->currentY + $this->_offset($this->currentAngle)['dx'],
            $this->currentAngle
        ))
            return true;
        else
            return false;
    }

    /*
     * Go Left
     *
     * Move left according to the coordinates and angle
     *
     * @access  public
     */
    public function goLeft()
    {
        if ($this->checkLeft()) {
            $this->currentX = $this->currentX - $this->_offset($this->currentAngle)['dy'];
            $this->currentY = $this->currentY + $this->_offset($this->currentAngle)['dx'];
        }
    }

    /*
     * Check Turn Right
     *
     * Check if it's possible to turn right according to the coordinates and angle
     *
     * @return  bool
     * @access  public
     */
    public function checkTurnRight()
    {
        if ($this->_checkMove(
            $this->currentX,
            $this->currentY,
            ($this->currentAngle == 0) ? 270 : $this->currentAngle - 90
        ))
            return true;
        else
            return false;
    }

    /*
     * Turn Right
     *
     * Turn Right according to the coordinates and angle
     *
     * @access  public
     */
    public function turnRight()
    {
        $this->previousAngle = (isset($this->currentAngle)) ? $this->currentAngle : 0;
        if ($this->checkTurnRight()) {
            if ($this->currentAngle == 0)
                $this->currentAngle = 270;
            else
                $this->currentAngle -= 90;
        }
    }

    /*
     * Check Turn Left
     *
     * Check if it's possible to turn left according to the coordinates and angle
     *
     * @return  bool
     * @access  public
     */
    public function checkTurnLeft()
    {
        if ($this->_checkMove(
            $this->currentX,
            $this->currentY,
            ($this->currentAngle == 270) ? 0 : $this->currentAngle + 90
        ))
            return true;
        else
            return false;
    }

    /*
     * Turn Left
     *
     * Turn Left according to the coordinates and angle
     *
     * @access  public
     */
    public function turnLeft()
    {
        $this->previousAngle = (isset($this->currentAngle)) ? $this->currentAngle : 0;
        if ($this->checkTurnLeft()) {
            if ($this->currentAngle == 270)
                $this->currentAngle = 0;
            else
                $this->currentAngle += 90;
        }
    }

    public function getMapIdFromCoordinates($x, $y, $angle)
    {
        $sql = "SELECT id FROM map WHERE coordx = $x AND coordy = $y AND direction = $angle";
        //error_log($sql);
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_OBJ);

        if (isset($res->id)) {
            return $res->id;
        }
    }


    /********************
     * PRIVATE FUNCTIONS *
     ********************/

    /*
     * List of functions:
     * _checkMove
     * _offset
     */



    /*
     * Check Move
     *
     * Check if it's possible to change coordinate
     *
     * @return  bool
     * @param   int    $x   Target X coordinate
     * @param   int    $y   Target Y coordinate
     * @param   int    $a   Target angle
     * @access  private
     */
    private function _checkMove($x, $y, $a)
    {
        $mapId = $this->getMapIdFromCoordinates($x, $y, $a);
        $sql = "SELECT id FROM map WHERE id = " . $mapId;
        /*error_log($sql);*/
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if (isset($res['id'])) {
            return true;
        } else {
            return false;
        }
    }

    /*
    * offset
    *
    * Returns the offset for x and y coordinates according to the angle when moving
    */
    private function _offset($angle)
    {
        switch ($angle) {
            case 0:
                return ['dx' => 1, 'dy' => 0];

            case 90:
                return ['dx' => 0, 'dy' => 1];

            case 180:
                return ['dx' => -1, 'dy' => 0];

            case 270:
                return ['dx' => 0, 'dy' => -1];
        }
    }
}
