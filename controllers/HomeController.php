<?php

class HomeController extends AbstractController
{
    public function exec()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->redirect('/');
        }
        require_once('templates/home.phtml');
    }
}
