<?php

class MainController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $main = new Main($this->db);

        return $this->view->render('index', [
            'tasks' => $main->findAll()
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate()
    {
        $main = new Main($this->db);

        if ($_POST) {
            $main->saveForm($_POST, $main->loadImage('image'));
            return $this->view->redirect('/');
        }

        return $this->view->render('create');
    }

    /**
     * @return bool
     */
    public function actionChangeStatus()
    {
        if (array_key_exists('id', $_POST)) {
            $main = new Main($this->db);
            return $main->changeStatus($_POST['id']);
        }
    }

    /**
     * @return bool
     */
    public function actionChangeText()
    {
        $main = new Main($this->db);
        return $main->changeText($_POST);
    }

    /**
     * @return string
     */
    public function actionError()
    {
        return $this->view->renderNotFound();
    }
}