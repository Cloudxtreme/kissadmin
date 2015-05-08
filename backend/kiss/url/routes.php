<?php
// static
if (self::parsePath()[0] == 'x' && ctype_graph(self::parsePath()[1])) {
	$file = new \Kiss\File\Control();
	$file->config('dir', 'static');

	// render
	$req = $file->get(self::parsePath()[1]);
	$file->set($req);
	$file->render();
}

// account
elseif (self::parsePath()[0] == 'account') {
	$class = new \Kiss\User\Template();
	$class->request(self::parsePath()[1]);
}

// admin
elseif (self::parsePath()[0] == 'admin') {
	$class = new \KissAdmin\Core();
}
?>