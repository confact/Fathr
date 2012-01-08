<?php
class Fathr_setup extends Controller {
	function __construct() {
		parent::__construct();
		$this->load->theme();
		$this->load->helper("db");
	}
	public function index() {
		$query = $this->db->get("{$this->config['table_tag']}settings");
		if($query != null) {
			header("Location: /".$this->config['sitepath']);
		}
		$this->theme->setPageTitle("Fathr CMS Setup");
		$this->theme->setHeaderTitle("Fathr CMS Setup");
		$this->theme->setStylesheet("stylesheet");
		$this->theme->setMainView('fathr_setupform');
		$this->theme->render();
	}
	public function db_setup() {
		//fixing variables for the setup from the form.
		$sitename = mysql_escape_string($_POST['sitename']);
		$url = mysql_escape_string($_POST['url']);
		$theme = mysql_escape_string($_POST['theme']);
		$blogy = 0;
		if(isset($_POST['blogy']) AND $_POST['blogy'] == "true") {
			$blogy = 1;
		}
	
		$username = mysql_escape_string($_POST['username']);
		$password = sha1(md5(mysql_escape_string($_POST['password'])));
	
	
		//fixing the admin table first, creating table admins and then insert the admin in it.
		$this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}admins` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;") or die(mysql_error());
		$this->db->query("INSERT INTO `{$this->config['table_tag']}admins` (`id`, `username`, `password`) VALUES
(1, '{$username}', '{$password}');");

		//next is settings table, ofc.
		$this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;");
		$this->db->query("INSERT INTO `{$this->config['table_tag']}settings` (`id`, `key`, `value`) VALUES
(1, 'sitename', '{$sitename}'),
(2, 'url', '{$url}'),
(3, 'theme', '{$theme}'),
(4, 'blogyindex', '{$blogy}');");
		
		//Now is it menu table - this is just normal data that the user can change later.
		$this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");
		$this->db->query("INSERT INTO `{$this->config['table_tag']}menu` (`id`, `names`, `url`) VALUES
(1, 'admin', '{$url}/fathr_admin/');");

		//last is the pages table. here is it also a normal data to say hi to the user.
		$this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `headline` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `indexed` tinyint(1) NOT NULL,
  `dated` tinyint(1) NOT NULL,
  `date` varchar(200) NOT NULL,
  `sidebar` varchar(250) NOT NULL DEFAULT '0',
  `sidebarside` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;") or die(mysql_error());

		$this->db->query("INSERT INTO `{$this->config['table_tag']}pages` (`id`, `title`, `headline`, `text`, `indexed`, `dated`, `date`, `sidebar`, `sidebarside`) VALUES
(1, 'testar', 'Welcome', '<p>\r\n	Welcome to the Fathr! edit this in the admin.</p>\r\n', 1, 1, '1326020782', '0', ''),
(2, 'sidebar', 'sidebar', '<p>\r\n	sidebar for a page maybe?</p>\r\n', 0, 1, '1326021310', '1', 'right');");

		//after the setup will we send the user to the actual site
		header("Location: /".$this->config['sitepath']);
	}
}
?>