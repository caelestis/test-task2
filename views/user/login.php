<?php
/** @var $this  View */
/** @var $error string */

$this->title = View::translation('login', 'Login');
?>

<?php if ($error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="username"><?= View::translation('login', 'Username') ?>:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password"><?= View::translation('login', 'Password') ?>:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-info"><?= View::translation('login', 'Login') ?></button>
</form>