<?php
// requests
$mode = \Kiss\Url\Router::parseQuery()['mode'];
if (!empty($mode) && ($mode == 'delete' || $mode == 'restore')) {
	$res = ($mode == 'delete' ? $this->file->trash() : $this->file->restore());
	
}

$this->title = _('File: ') . $this->data['uniqid'];

$form = array(
	'uniqid' => array(
		'label' => _('Identifier'),
		'type' => 'text',
		'placeholder' => _('File Name'),
		'required' => true,
		'graph' => true,
		'length' => array(1, 32)
	),

	'path' => array(
		'label' => _('Path'),
		'type' => 'text',
		'placeholder' => _('File Path'),
		'required' => true,
		'graph' => true,
		'length' => array(5, 64)
	),

	'description' => array(
		'label' => _('Description'),
		'type' => 'textarea',
		'placeholder' => _('Enter Description'),
		'print' => true
	),
	
	'access' => array(
		'label' => _('Access Group(s)'),
		'type' => 'textarea',
		'placeholder' => _('[0,1,2,3,4,5]'),
		'graph' => true
	),

	'title' => array(
		'label' => _('Title'),
		'type' => 'text',
		'placeholder' => _('Enter Title'),
		'print' => true,
		'length' => array(0, 255)
	),

	'type' => array(
		'label' => _('File Type'),
		'type' => 'text',
		'placeholder' => _('Auto Detect'),
		'graph' => true,
		'length' => array(0, 255)
	),

	'cache' => array(
		'label' => _('Cache Time'),
		'type' => 'number',
		'placeholder' => 0,
		'digit' => true,
		'length' => array(0, 8)
	)
);

$fileForm = new \Kiss\View\Form($form, 'file', false);
$fileForm->set($this->data);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	try {
		// validate
		$fileForm->set($_POST);
		$fileForm->validate();
		$fileForm->getError();
		
		// update
		$file = new \Kiss\File\Control(array());
		$file->set($_POST);
		$file->update();
		
		// success
		$this->msg = \Kiss\View\Helper::alert('success', _('<strong>Success!</strong> File Updated!'));
	}
	catch (\Kiss\FailedException $e) {
		$this->msg = \Kiss\View\Helper::alert('failed', $e->getMessage());
	}
}
?>
<?php $this->inc('header') ?>
<h3><?= $this->title ?></h3>
<div class="row">
	<div class="one-half column">
		<div class="block" id="file">
			<h1>#<?= $this->data['id'] ?> - <?= $this->data['uniqid'] ?></h1>
			<?= $this->msg ?>
			<form method="post">
			<?php foreach ($fileForm->getForm() as $key => $field): ?>
			<div class="row">
				<label class="three columns" for="<?= $key ?>"><?= $field['label'] ?></label>
				<div class="nine columns">
				<?php if ($field['type'] == 'textarea'): ?>
				<textarea name="<?= $key ?>" class="u-full-width" placeholder="<?= $field['placeholder'] ?>" id="<?= $key ?>"><?= $fileForm->get($key) ?></textarea>
				<?php else: ?>			
				<input name="<?= $key ?>" class="u-full-width" type="<?= $field['type'] ?>" placeholder="<?= $field['placeholder'] ?>" id="<?= $key ?>" value="<?= $fileForm->get($key) ?>">
				<?php endif; ?></div>
			</div>
			<?php endforeach; ?>
			<div class="submit">
				<a class="button" href="<?= \Kiss\Url\Router::getPath() ?>?mode=delete">Delete</a>
				<input class="button-primary" type="submit" value="<?= _('Update'); ?>">
			</div>
			</form>
		</div>
	</div>
	<div class="one-half column">
		<div class="block">
			<h1><?= _('File Info') ?> <a class="button" href="<?= \Kiss\Url\Router::getPath() ?>?mode=preview"><?= _('View File'); ?></a></h1>
			<?php $path = $this->file->getPath($this->data['path']); ?>
			<?php if (empty($path)): ?>
			<div class="alert alert-danger" role="alert"><strong><?= 'File Error!'?></strong> <?= _('The file could not be found!') ?></div>
			<?php else: ?>
			<?php $info = array(
				_('File Path') => $path,
				_('File Size') => \Kiss\File\Helper::humanFilesize(filesize($path)),
				_('MIME Type') => (!empty($this->data['type']) ? $this->data['type'] : \Kiss\File\Helper::mimeType($path))
			); ?>
			<?php foreach ($info as $label => $value): ?>
			<div class="row">
				<strong><?= $label ?></strong><br>
				<p><?= $value ?></p>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $this->inc('footer') ?>