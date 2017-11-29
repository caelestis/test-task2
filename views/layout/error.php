<?php
/** @var $this View */

$this->title = '404 Not Found';
?>

<div class="error-template">
    <h3>Oops!</h3>
    <h4><?= $this->title ?></h4>

    <div class="error-details">
        Sorry, an error has occured, Requested page not found!
    </div>

    <div class="error-actions">
        <a href="/" class="btn btn-primary btn-lg">
            <span class="glyphicon glyphicon-home"></span>
            Take Me Home
        </a>
        <a href="mailto:admin@test.com" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-envelope"></span>
            Contact Support
        </a>
    </div>
</div>