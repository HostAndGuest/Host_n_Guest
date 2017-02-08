<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    public function adminAction()
    {
        return new Response("ADMIN DETECTED !! ");
    }

    public function userAction()
    {
        return new Response("USER DETECTED !! ");
    }
}
