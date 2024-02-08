<?php

namespace Request;

class PlusProductRequest extends Request
{
    public function getId()
    {
        return $this->body['product-id'];
    }
}