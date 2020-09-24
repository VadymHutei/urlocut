<?php

class AdminController extends AbstractController
{
    public function exec()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->redirect('/admin');
        }
        $admin_data = $this->model->getAliases();
        require_once('templates/admin.phtml');
    }
}
