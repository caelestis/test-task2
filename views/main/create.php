<?php
/** @var $this  View */

$this->title = View::translation('main', 'Create task');
$this->registerJSFile('//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js');
$this->registerJSFile('//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js');
$this->registerCSSFile('//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css');
$this->registerJSFile('/web/js/main/create.js');

?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username"><?= View::translation('main', 'Username') ?>:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="email"><?= View::translation('main', 'Email') ?>:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="text"><?= View::translation('main', 'Text') ?>:</label>
        <textarea class="form-control" id="text" name="text" required></textarea>
    </div>
    <div class="form-group">
        <label for="image"><?= View::translation('main', 'Image') ?>:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/jpeg, image/gif, image/x-png" required>
    </div>
    <button type="submit" class="btn btn-info"><?= View::translation('app', 'Create') ?></button>
    <button type="button" class="btn btn-warning" id="modal_button" data-toggle="modal" data-target="#myModal"><?= View::translation('main', 'Preview') ?></button>
</form>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= View::translation('main', 'Preview') ?></h4>
            </div>
            <div class="modal-body">
                <table id="tasks" class="table table-striped table-bordered" style="word-wrap:break-word" >
                    <thead>
                    <tr>
                        <th style="width:15%;"><?= View::translation('main', 'Username') ?></th>
                        <th style="width:15%;"><?= View::translation('main', 'Email') ?></th>
                        <th style="width:15%;"><?= View::translation('main', 'Image') ?></th>
                        <th style="width:55%;"><?= View::translation('main', 'Text') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="modal_username"></td>
                            <td id="modal_email"></td>
                            <td><img src="" id="modal_image"></td>
                            <td id="modal_text"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= View::translation('app', 'Close') ?></button>
            </div>
        </div>
    </div>
</div>