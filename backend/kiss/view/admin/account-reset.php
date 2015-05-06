<?php $this->title = _('Account Action') ?>
<?php $this->inc('account-header') ?>
<div id="form">
<form method="post">
<h4><?= _('Account Action') ?></h4>
<?php $this->inc('account-form') ?>
<input class="button-primary" name="submit" type="submit" value="<?= _('Submit') ?>">
</form>
</div>
<?php $this->inc('account-footer') ?>