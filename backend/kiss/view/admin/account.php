<?php $this->title = _('My Account') ?>
<?php $this->inc('account-header') ?>
<form method="post">
<h4><?= _('My Account') ?></h4>
<?php $this->inc('account-form') ?>
<input class="button-primary" name="submit" type="submit" value="<?= _('Log In') ?>">
<button class="button" name="submit" value="signup"><?= _('Sign Up') ?></button>
</form>
<?php $this->inc('account-footer') ?>