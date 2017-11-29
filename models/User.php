<?php

/**
 * Class User
 */
class User extends Model
{
    const IS_ADMIN_NO  = 0;
    const IS_ADMIN_YES = 1;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;

    /**
     * Table name
     *
     * @return string
     */
    public function getTable()
    {
        return 'users';
    }

    /**
     * @param array $postData
     *
     * @return bool|int
     */
    public function authorize(array $postData)
    {
        $username = $postData['username'];
        $password = $postData['password'];
        $hash     = md5($username . ':' . $password);

        if ($userId = $this->checkPassword($username, $hash)) {
            $_SESSION['userId'] = $userId;
            return $userId;
        }

        return false;
    }

    /**
     * @param string $username
     * @param string $hash
     *
     * @return bool|int
     */
    public function checkPassword(string $username, string $hash)
    {
        $user = $this->findOne([
            'username' => $username,
            'is_admin' => self::IS_ADMIN_YES,
            'status'   => self::STATUS_ACTIVE,
        ]);

        if ($user) {
            if ($user['password_hash'] == $hash) {
                return $user['id'];
            }
        }

        return false;
    }
}