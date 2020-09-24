<?php

class AddController extends AbstractController
{
    public function exec()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once('templates/add.phtml');
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $link = $_POST['link'];
            if (preg_match(LINK_PATTERN, $link) !== 1) {
                $this->redirect('/add');
            }
            $data = $this->model->getAliasByLink($link);
            if (!empty($data)) {
                $alias = $data[0]['alias'];
            } else {
                $alias = $this->model->createAlias();
                $this->model->setAlias($alias, $link);
            }
            $url = $this->model->createUrl([$alias]);
            require_once('templates/add_result.phtml');
        }
    }
}
