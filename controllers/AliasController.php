<?php

class AliasController extends AbstractController
{
    public function exec()
    {
        $alias = trim($_SERVER['REQUEST_URI'], '/');
        if (preg_match(ALIAS_PATTERN, $alias) !== 1) {
            $this->notFound();
        }
        $data = $this->model->getLinkByAlias($alias);
        if (empty($data)) {
            $this->notFound();
        }
        $this->model->visitAlias($alias);
        $this->redirect($data[0]['link']);
    }
}
