<?php
class loader {
	public $defaultcontroller = "";
	public $controllername = "";
	public $controller = "";
	public $controllerpath = "";
	public $url = "";

	public function __construct()
	{	
		global $fathr;
		$this->controllerpath = $fathr->config['applicationpath'] . '/controller/';
		$this->defaultcontroller = $fathr->config['default_controller'];
		$this->url = $this->seperatenames($_GET['page']);
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
		if($this->url[1] != NULL)
		{
			$function = $this->url[1];
			
			if(method_exists($this->controller, $function))
			{
				$this->controller->$function();
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
	private function seperatenames($url)
	{
		return explode('/',$url);
	}
	
	private function show_error($errorid = "500")
	{
		echo " ERROR " . $errorid . " - We had some problems. come back later.";
	} 
}
?>