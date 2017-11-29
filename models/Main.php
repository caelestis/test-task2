<?php

/**
 * Class Main
 */
class Main extends Model
{
    const MAX_IMAGE_WIDTH  = 320;
    const MAX_IMAGE_HEIGHT = 240;

    const STATUS_WAITING  = 0;
    const STATUS_FINISHED = 1;

    /**
     * Table name
     *
     * @return string
     */
    public function getTable()
    {
        return 'tasks';
    }

    /**
     * @param string $fieldName
     *
     * @return string
     */
    public function loadImage(string $fieldName)
    {
        $targetDir     = "web/uploads/";
        $file          = $_FILES[$fieldName];
        $fileExtension = mb_strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $targetFile    = $targetDir . microtime(true) . '.' . $fileExtension;

        if ($fileExtension == 'jpg') $fileExtension = 'jpeg';

        $imageCreateFromFunction  = 'imagecreatefrom' . $fileExtension;
        $imageFunction            = 'image' . $fileExtension;
        list($width, $height)     = getimagesize($file['tmp_name']);

        if ($width > self::MAX_IMAGE_WIDTH || $height > self::MAX_IMAGE_HEIGHT) {
            $scale     = min(self::MAX_IMAGE_WIDTH/$width, self::MAX_IMAGE_HEIGHT/$height);
            $newWidth  = ceil($scale*$width);
            $newHeight = ceil($scale*$height);

            $thumb            = imagecreatetruecolor($newWidth, $newHeight);
            $source           = $imageCreateFromFunction($file['tmp_name']);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            $imageFunction($thumb, $targetFile);
        } else {
            $source = $imageCreateFromFunction($file['tmp_name']);
            $imageFunction($source, $targetFile);
        }

        return $targetFile;
    }

    /**
     * @param array  $postData
     * @param string $imageUrl
     *
     * @return bool
     */
    public function saveForm(array $postData, string $imageUrl)
    {
        $query = $this->pdo->prepare(
            'INSERT INTO '. $this->getTable() .' (
                `username`, 
                `email`, 
                `image_url`, 
                `text`
            ) VALUES (
                :username,
                :email,
                :image_url,
                :text
            )'
        );
        $query->bindParam(':username', $postData['username']);
        $query->bindParam(':email', $postData['email']);
        $query->bindParam(':image_url', $imageUrl);
        $query->bindParam(':text', $postData['text']);

        return $query->execute();
    }

    /**
     * @param int   $status
     *
     * @return string
     */
    public static function getStatus(int $status)
    {
        $addClass = '';
        $button   = '';

        if (array_key_exists('userId', $_SESSION)) {
            $addClass = 'change_status';
        }

        switch ($status) {
            case self::STATUS_WAITING:
                $button = '<button type="button" class="btn btn-sm btn-info '. $addClass .'"><span class="glyphicon glyphicon-remove-circle"></span></button>';
                break;
            case self::STATUS_FINISHED:
                $button = '<button type="button" class="btn btn-sm btn-success '. $addClass .'"><span class="glyphicon glyphicon-ok-circle"></span></button>';
                break;
        }

        return $button;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function changeStatus($id)
    {
        $task = $this->findOne(['id' => $id]);

        if ($task['status'] == self::STATUS_WAITING) {
            $newStatus = self::STATUS_FINISHED;
        } elseif ($task['status'] == self::STATUS_FINISHED) {
            $newStatus = self::STATUS_WAITING;
        }

        $query = $this->pdo->prepare(
            'UPDATE '. $this->getTable() .' 
            SET `status` = :status
            WHERE `id` = :id'
        );
        $query->bindParam(':status', $newStatus);
        $query->bindParam(':id', $id);

        return $query->execute();
    }

    /**
     * @param array $postData
     *
     * @return bool
     */
    public function changeText(array $postData)
    {
        $query = $this->pdo->prepare(
            'UPDATE '. $this->getTable() .' 
            SET `text` = :text
            WHERE `id` = :id'
        );
        $query->bindParam(':text', $postData['value']);
        $query->bindParam(':id', $postData['pk']);

        return $query->execute();
    }
}