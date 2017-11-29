<?php
/** @var $this  View */
/** @var $tasks array */

$this->title = View::translation('main', 'Tasks');
$this->registerJSFile('//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js');
$this->registerJSFile('//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js');
$this->registerCSSFile('//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css');
$this->registerCSSFile('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css');
$this->registerJSFile('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js');
$this->registerJSFile('/web/js/main/index.js');
?>

<a href="/main/create" class="btn btn-primary "><?= View::translation('main', 'Add task') ?></a>
<br>
<br>
<table id="tasks" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th style="width:5%;"><?= View::translation('main', 'Status') ?></th>
            <th style="width:5%;"><?= View::translation('main', 'ID') ?></th>
            <th style="width:15%;"><?= View::translation('main', 'Username') ?></th>
            <th style="width:15%;"><?= View::translation('main', 'Email') ?></th>
            <th style="width:15%;"><?= View::translation('main', 'Image') ?></th>
            <th style="width:45%;"><?= View::translation('main', 'Text') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task) : ?>
        <tr data-key="<?= $task['id'] ?>">
            <td>
                <?= Main::getStatus($task['status']) ?>
            </td>
            <td>
                <?= $task['id'] ?>
            </td>
            <td>
                <?= $task['username'] ?>
            </td>
            <td>
                <?= $task['email'] ?>
            </td>
            <td>
                <img src="<?= $task['image_url'] ?>">
            </td>
            <td>
                <?php if (array_key_exists('userId', $_SESSION)) : ?>
                    <a href="#" id="text" data-type="textarea" data-pk="<?= $task['id'] ?>" data-url="/main/change-text"><?= $task['text'] ?></a>
                <?php else : ?>
                    <?= $task['text'] ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>