<?php

namespace Request;

use l1sanya\MyCore\Request\Request;

class MinusProductRequest extends Request
{
    public function getId()
    {
        return $this->body['product-id'];
    }
}