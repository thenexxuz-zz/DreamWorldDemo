<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        if (is_null($this->get('session')->get('currentSessionToken'))) {
            $this->get('session')->set('currentSessionToken', uniqid());
        }

        $token = $this->get('session')->get('loginUserToken');
        return $this->render('default.html.twig', [
            'logged_in' => !is_null($token)
        ]);
    }

    public function error()
    {
        return $this->render('error404.html.twig');
    }
}