<?php
class Databasemodel {
	private $array;
	
	function __construct($result)
	{
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