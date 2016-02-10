<?php

namespace Application\Bundle\AppBundle\Controller;

use Application\Bundle\AppBundle\Form\Type\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

final class SecurityController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param EngineInterface      $templating
     */
    public function __construct(FormFactoryInterface $formFactory, EngineInterface $templating)
    {
        $this->formFactory = $formFactory;
        $this->templating = $templating;
    }

    public function loginAction(Request $request)
    {
        $form = $this->formFactory->create(LoginType::class);

        if ($error = $this->getAuthenticationError($request)) {
            $form->addError(new FormError($error->getMessage()));
        }

        return $this->templating->renderResponse('Security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    /**
     * Retrieves any authentication error of the given request.
     *
     * @param Request $request
     *
     * @return AuthenticationException|null
     */
    private function getAuthenticationError(Request $request)
    {
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            return $request->attributes->get(Security::AUTHENTICATION_ERROR);
        }

        $session = $request->getSession();
        if (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);

            return $error;
        }
    }
}
