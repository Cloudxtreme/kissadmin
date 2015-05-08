<?php
namespace KissAdmin;
use \Kiss\Url\Router;
use \Kiss\View\Control as View;
use \Kiss\File\Control as File;
class Core {
	protected $file;
	protected $view;
	
	public function __construct() {
		Router::auth(); // authentication required
		Router::secure(); // force to https
		if (!\Kiss\Session\Helper::isAdmin())
			throw new \Kiss\PermissionException(_("You don't have the privilege to access KissAdmin"));
		
		// classes
		$this->file = new File();
		$this->view = new View();
		$this->view->config('tpl', 'admin');
		
		// routing
		switch (Router::parsePath()[1]) {
			case 'library':
				switch (Router::parseQuery()['mode']) {
					case 'upload':
					case 'new':
					case 'add':
						$this->view->inc('upload');
						break;
					default:
						$this->view->data = $this->file->records();
						$this->view->inc('library');
				}				
				break;
			case 'file':
				// get file
				$file = $this->file->get(Router::parsePath()[2]);
				$this->file->set($file);
				
				// mode
				$mode = Router::parseQuery()['mode'];
				switch ($mode) {
					case 'delete':
					case 'restore':
						($mode == 'delete' ? $this->file->deleted = 1 : $this->file->deleted = 0);
						$this->file->update();
						
						// refresh
						header('Location: /' .\Kiss\Url\Router::getPath());
						exit;
						break;
					case 'preview':
						exit($this->file->render());
						break;
				}
				
				// view
				$this->view->file = $this->file;
				$this->view->data = $file;
				$this->view->inc('file');
				break;
			default:
				$this->view->inc('home');
		}
	
	}
}
?>