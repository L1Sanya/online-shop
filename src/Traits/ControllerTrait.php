<?php


namespace Traits;

use Core\ViewRenderer;
use Service\Authentication\AuthenticationServiceInterface;

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