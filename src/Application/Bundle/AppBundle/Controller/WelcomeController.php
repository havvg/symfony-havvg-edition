<?php

namespace Application\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

final class WelcomeController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * Constructor.
     *
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function helloAction()
    {
        return $this->templating->renderResponse('Welcome/hello.html.twig');
    }
}
