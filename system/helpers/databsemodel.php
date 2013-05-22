<?php
class Databasemodel {
	private $array;
	
	function __construct($result)
	{
		if(get_class($result) == "mysqli_result")
		{
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				foreach ($row as $key => $val) {
					if (is_int($key)) {
						unset($row[$key]);
					}
				}
				$this->array[] = $row;
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
	
	function getArray()
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