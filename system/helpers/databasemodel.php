<?php
/**
 * The class handling the data from db-queries.
 */
class Databasemodel {

    /**
     *
     * @var array
     */
    private $array = array();

    /**
     * 
     * @param boolean|mysqli_result|mysql_fetch_array $result
     * @return boolean
     */
    function __construct($result) {
        if (!is_bool($result)) {
            if (!is_resource($result) && get_class($result) == "mysqli_result") {
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    foreach ($row as $key => $val) {
                        if (is_int($key)) {
                            unset($row[$key]);
                        }
                    }
                    $this->array[] = $row;
                }
            } else {
                while ($row = mysql_fetch_array($result)) {
                    foreach ($row as $key => $val) {
                        if (is_int($key)) {
                            unset($row[$key]);
                        }
                    }
                    $this->array[] = $row;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * returns the array of results.
     * 
     * @return array
     */
    public function getArray() {
        return $this->array;
    }

    /**
     * returns amount of rows.
     * 
     * @return integer
     */
    function num_rows() {
        return count($this->array);
    }

    /**
     * returns amount of fields of result.
     * 
     * @return integer
     */
    function num_keys() {
        return count(array_keys($this->array));
    }

}

?>