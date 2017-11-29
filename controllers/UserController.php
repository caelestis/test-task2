<?php

class UserController extends Controller
{
    /**
     * @return string
     */
    public function actionLogin()
    {
        $error = '';

        if ($_POST) {
            $login = new User($this->db);

            if ($login->authorize($_POST)) {
                return $this->view->redirect('/');
            } else {
                $error = View::translation('login', 'Invalid login or password');
            }
        }

        return $this->view->render('login', ['error' => $error]);
    }
    /**
     * @return string
     */
    public function actionLogout()
    {
        unset($_SESSION['userId']);
        session_destroy();

        return $this->view->redirect('/');
    }
}