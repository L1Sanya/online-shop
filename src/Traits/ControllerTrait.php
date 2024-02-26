<?php


namespace Traits;

use l1sanya\MyCore\AuthenticationServiceInterface;
use l1sanya\MyCore\ViewRenderer;

trait ControllerTrait
{
    private AuthenticationServiceInterface $authenticationService;
    private ViewRenderer $viewRenderer;

    public function __construct(AuthenticationServiceInterface $authenticationService, ViewRenderer $viewRenderer)
    {
        $this->authenticationService = $authenticationService;
        $this->viewRenderer = $viewRenderer;
    }

}