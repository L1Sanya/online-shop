<?php

namespace Core;

class ViewRenderer
{
    public function renderer(string $view, array $params)
    {
        ob_start();

        extract($params);

    }
}