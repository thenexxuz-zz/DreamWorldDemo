<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('dashboard');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    public function logout()
    {
        $this->container->get('security.token_storage')->setToken(null);
        return $this->redirect('/');
    }

    public function register(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
        }

        if ($request->getMethod() === 'POST') {
            $em = $this->entityManager;
            $user = new User();
            $user->setUsername($request->get('username'));
            $user->setEmail($request->get('email'));
            $user->setPassword($request->get('password'));
            $em->persist($user);
            $em->flush();

            return $this->redirect('/login');
        }

        return $this->render('security/register.html.twig');
    }
}
