<?php

class NotFoundController extends AbstractController
{
    public function exec()
    {
        require_once('templates/404.phtml');
    }
}
