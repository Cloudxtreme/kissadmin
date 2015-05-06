<?= $this->alert ?>
<?php foreach ($this->validator->form() as $key => $field): ?>
<div class="row">
	<label for="<?= $key ?>"><?= $field['label'] ?></label>
	<input name="<?= $key ?>" class="u-full-width" type="<?= $field['type'] ?>" placeholder="<?= $field['placeholder'] ?>" id="<?= $key ?>" value="<?= $this->validator->get($key) ?>">
</div>
<?php endforeach; ?>
<?php $this->inc('captcha') ?>