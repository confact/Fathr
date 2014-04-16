<?php
class Databasemodel {
    private $array = array();

    function __construct($result)
    {
        if(!is_bool($result)) {
        if(!is_resource($result) && get_class($result) == "mysqli_result")
        {

            while($row=$result->fetch_array(MYSQLI_ASSOC))
            {
                foreach ($row as $key => $val) {
                    if (is_int($key)) {
                        unset($row[$key]);
                    }
                    else
                    {
                        $this->array[$row["key"]] = $row["value"];
                    }
                }

            }
        }
        else {
                while($row=mysql_fetch_array($result))
                {
                    foreach ($row as $key => $val) {
                        if (is_int($key)) {
                            unset($row[$key]);
                        }
                    }
                    $this->array[] = $row;
                }
        }
        }
        else {
            return false;
        }
    }

    public function getArray()
    {
        return $this->array;
    }

    function num_rows()
    {
        return count($this->array);
    }

    function num_keys()
    {
        return count(array_keys($this->array));
    }
}
?>