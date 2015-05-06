<?php $this->title = _('Account Recovery') ?>
<?php $this->inc('account-header') ?>
<form method="post">
<h4><?= _('Account Recovery') ?></h4>
<?php $this->inc('account-form') ?>
<input class="button-primary" name="submit" type="submit" value="<?= _('Recover') ?>">
<a class="button" href="<?= \Kiss\Url\Router::getServer() ?>/account/login"><?= _('Log In') ?></a>
</form>
<?php $this->inc('account-footer') ?>