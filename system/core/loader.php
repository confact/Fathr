<?php
class loader {
// More or less the real father. This load, fix uri and make the framework alive on the page.
	public $defaultcontroller = "";
	public $controllername = "";
	public $controller = "";
	public $controllerpath = "";
	public $url = "";

	public function __construct($config = "")
	{	
		$this->controllerpath = $config['applicationpath'] . '/controllers/';
		$this->defaultcontroller = $config['default_controller'];
		if(!isset($_GET['page']))
		{
			$_GET['page'] = "";
		}
		$this->url = $this->urlslug($_GET['page']);
	}

	public function run()
	{
		if($this->url[0] == "" OR $this->url[0] == "index.php") {
			require_once($this->controllerpath . $this->defaultcontroller . '.php');
			$this->controllername = ucfirst($this->defaultcontroller);
			$this->controller = new $this->controllername();
			$this->alive();
		}
		else {
			
			if(file_exists($this->controllerpath . $this->url[0] . '.php'))
			{
				require_once($this->controllerpath . $this->url[0] . '.php');
				$this->controllername = ucfirst($this->url[0]);
				$this->controller = new $this->controllername();
				$this->alive();
			}
			else {
				$this->show_error(403);
			}
		}
	}
	

	private function alive()
	{
		if(isset($this->url[1]) AND $this->url[1] != NULL)
		{
			$function = $this->url[1];
			$parameters = count($this->url)-2;
			if(method_exists($this->controller, $function))
			{
				$method = new ReflectionMethod(get_class($this->controller), $function);
				$num = $method->getNumberOfParameters();
				if($num > 0) {
					
					if($parameters == $num) {
						if($parameters == 1) {
							$this->controller->$function($this->url[2]);
						}
						else {
							$this->controller->$function($this->url[2],$this->url[3]);
						}
					}
					else
					{
						$this->show_error(406);
					}
				}
				else if($num <= 0 AND $parameters > 0){
					$this->show_error(402);
				}
				else {
					$this->controller->$function();
				}
			}
			else 
			{
				$this->show_error(404);
			}
		}
		else {
			$this->controller->index();
		}
	}
	
	private function urlslug($url)
	{
		$slug = explode('/',$url);
		foreach ($slug as $key => $value) {
  			if (is_null($value)) {
    			unset($my[$key]);
  			}
		} 
		return $slug;
	}
	
	private function show_error($errorid = "500")
	{
		echo " ERROR " . $errorid . " - We had some problems. come back later.";
	} 
}
?>