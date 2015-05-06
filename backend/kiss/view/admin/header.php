<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?= \Kiss\Url\Router::getServer() ?>">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $this->title ?> &middot; KissAdmin</title>
<link rel="stylesheet" href="x/css-admin">
<script src="x/js-jquery"></script>
<script src="x/js-script"></script>
</head>

<body>

<header>
	<nav id="top">
	<div class="container">
		<div id="logo"><a href="admin">KissAdmin</a></div>
		<nav id="sub">
			<ul>
				<li><a href="account/notifications" class="fa fa-bell-o fa-lg"><span class="badge1" data-badge="27"></span></a></li>
				<li><a href="account/messages" class="fa fa-comment-o fa-lg"><span class="badge1" data-badge="3"></span></a></li>
				<li><a href="account/logout" class="fa fa-sign-out fa-lg"></a></li>
				<li id="togglenav"><i class="fa fa-bars fa-lg"></i></li>
			</ul>
		</nav>
	</div>
	</nav>
	<nav id="nav">
	<div class="container">
		<form id="search" method="post" action="search">
			<input id="q" type="text" name="q" placeholder="Search">
		</form>
		<ul>
			<?= \Kiss\View\Admin\Widget::navbar(); ?>
		</ul>
	</div>
	</nav>
</header>
<div class="container">