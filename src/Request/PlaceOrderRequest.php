<?php

namespace Request;

class PlaceOrderRequest extends Request
{

    public function getName(): string
    {
        return $this->body['name_input'];
    }

    public function getPhone(): string
    {
        return $this->body['phone_input'];
    }

    public function getEmail(): string
    {
        return $this->body['email_input'];
    }

    public function getAddress() : string
    {
        return $this->body['address_input'];
    }

    public function getComment() : string
    {
        return $this->body['comment_input'];
    }

    public function validate(): array
    {
        $errors = [];
        return $errors;
    }


}