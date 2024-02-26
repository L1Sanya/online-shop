<?php

namespace Request;

use l1sanya\MyCore\Request\Request;

class PlusProductRequest extends Request
{
    public function getId()
    {
        return $this->body['product-id'];
    }
}