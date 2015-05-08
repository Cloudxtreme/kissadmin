<?php
namespace Kiss\View\Admin;
use \Kiss\Url\Router;
class Widget {
	public static function navbar() {
		$config = include('config.php');

		// build nav
		$ret = '';
		foreach ($config['navbar'] as $path => $item) {
			$ret.= '<li'.((Router::getPath() == $path || Router::parsePath()[1] == $path) ? ' class="active"' : '');
			$ret.= '><a href="admin/'.$path.'">'.$item['title'].'</a></li>';
		}
		return $ret;
	}
}
?>