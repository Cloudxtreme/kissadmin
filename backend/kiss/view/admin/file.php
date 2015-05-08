<?php
// alert when pending for deleting
if ($this->data['deleted'] == 1)
	$this->alert = \Kiss\View\Helper::alert(_('<strong>Warning!</strong> Pending for deletion!'), 'warning');

// form
$form = array(
	'uniqid' => array(
		'label' => _('Identifier'),
		'type' => 'text',
		'placeholder' => _('File Name'),
		'required' => true,
		'graph' => true,
		'length' => array(1, 32)
	),
	
	'dir' => array(
		'label' => _('Directory'),
		'type' => 'text',
		'placeholder' => _('Directory'),
		'required' => true,
		'graph' => true,
		'length' => array(1, 64)
	),

	'path' => array(
		'label' => _('File Path'),
		'type' => 'text',
		'placeholder' => _('File Path'),
		'required' => true,
		'graph' => true,
		'length' => array(5, 64)
	),
	
	'type' => array(
		'label' => _('File Type'),
		'type' => 'text',
		'placeholder' => _('Auto Detect'),
		'graph' => true,
		'length' => array(0, 255)
	),
	
	'title' => array(
		'label' => _('Title'),
		'type' => 'text',
		'placeholder' => _('Enter Title'),
		'print' => true,
		'length' => array(0, 255)
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
		'placeholder' => '[0,1,2,3,4,5]',
		'graph' => true
	),

	'cache' => array(
		'label' => _('Cache Time'),
		'type' => 'number',
		'placeholder' => _('In Seconds'),
		'digit' => true,
		'length' => array(0, 8)
	)
);

$validator = new \Kiss\View\Validator($form);
$validator->set($this->data);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	try {
		$validator->set($_POST);
		$validator->validate();
		$validator->error();
		
		// update record
		$file = new \Kiss\File\Control();
		$file->set($_POST);
		$file->update();
		
		// success
		$this->alert = \Kiss\View\Helper::alert(_('<strong>Successfully updated!</strong>'), 'success');
	}
	catch (\Kiss\FailedException $e) {
		$this->alert = \Kiss\View\Helper::alert($e->getMessage(), 'failed');
	}
}

// title
$this->title = _('File: ') . $this->data['uniqid'];
?>
<?php $this->inc('header') ?>
<h3><?= $this->title ?></h3>
<div class="row">
	<div class="one-half column">
		<div class="block" id="file">
			<h1>#<?= $this->data['id'] ?> - <?= $this->data['uniqid'] ?></h1>
			<?= $this->alert ?>
			<form method="post">
			<?php foreach ($validator->form() as $key => $field): ?>
			<div class="row">
				<label class="three columns" for="<?= $key ?>"><?= $field['label'] ?></label>
				<div class="nine columns">
				<?php if ($field['type'] == 'textarea'): ?>
				<textarea name="<?= $key ?>" class="u-full-width" placeholder="<?= $field['placeholder'] ?>" id="<?= $key ?>"><?= $validator->$key ?></textarea>
				<?php else: ?>			
				<input name="<?= $key ?>" class="u-full-width" type="<?= $field['type'] ?>" placeholder="<?= $field['placeholder'] ?>" id="<?= $key ?>" value="<?= $validator->$key ?>">
				<?php endif; ?></div>
			</div>
			<?php endforeach; ?>
			<div class="submit">
				<a class="button" href="<?= \Kiss\Url\Router::getPath() ?>?mode=<?= ($this->data['deleted'] == 1 ? 'restore">' ._('Restore') : 'delete">' . _('Delete')) ?></a>
				<input class="button-primary" type="submit" value="<?= _('Update') ?>">
			</div>
			</form>
		</div>
	</div>
	<div class="one-half column">
		<div class="block">
			<h1><?= _('File Info') ?> <a class="button" target="_blank" href="<?= \Kiss\Url\Router::getPath() ?>?mode=preview"><?= _('View File') ?></a></h1>
			<?php $path = $this->file->path(); ?>
			<?php if (!file_exists($path)): ?>
			<div class="alert alert-danger" role="alert"><strong><?= _('File Error!') ?></strong> <?= _('The file could not be found!') ?></div>
			<?php else: ?>
			<?php $info = array(
				_('Full Path') => $path,
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