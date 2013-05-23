<?php
class Fathr_settings extends Model {

	function getSettings()
	{
		$query = $this->db->get("{$this->config['table_tag']}settings");
		return $query->getArray();
	}
	function setSettings($sitename, $url, $theme, $blogy)
	{
		$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$sitename}' WHERE {$this->config['table_tag']}settings.key='sitename'");
		$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$url}' WHERE {$this->config['table_tag']}settings.key='url'");
		$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$theme}' WHERE {$this->config['table_tag']}settings.key='theme'");
		$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$blogy}' WHERE {$this->config['table_tag']}settings.key='blogyindex'");
	}
	
	function install($sitename, $url, $theme, $blogy)
	{
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}settings` (
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
		return $query;
	}
}
?>