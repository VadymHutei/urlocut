<?php

abstract class AbstractController
{
    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->model = new Model($config);
    }

    abstract public function exec();

    /**
     * @param string $url
     * @param int $status_code
     * @return exit
     */
    function redirect(string $url, int $status_code = 303): void
    {
        header("Location: $url", true, $status_code);
        exit;
    }

    /**
     * @return exit
     */
    function notFound(): void
    {
        http_response_code(404);
        require_once('templates/404.phtml');
        exit;
    }
}
