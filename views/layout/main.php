<?php
/** @var $this View */
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href="/web/css/custom.css">
    <?= $this->js ?>
    <?= $this->css ?>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar hidden-phone">
            <h4>Test site</h4>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="/"><?= View::translation('app', 'Home') ?></a></li>
                <?php if (array_key_exists('userId', $_SESSION)) : ?>
                    <li><a href="/user/logout"><?= View::translation('app', 'Logout') ?></a></li>
                <?php else: ?>
                    <li><a href="/user/login"><?= View::translation('app', 'Login') ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="content">
            <h4><small><?= $this->title ?></small></h4>
            <hr>
            <?= $this->content ?>
        </div>
    </div>
    <footer class="container-fluid">
        <p><?= View::translation('app', 'Footer text') ?></p>
    </footer>
</body>
</html>