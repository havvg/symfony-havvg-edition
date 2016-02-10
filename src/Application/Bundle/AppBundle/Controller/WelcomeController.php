<?php

namespace Application\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class WelcomeController
{
    public function indexAction()
    {
        return new Response('This is rendered by WelcomeController::indexAction.');
    }
}
