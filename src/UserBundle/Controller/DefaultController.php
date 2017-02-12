<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse ;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('indexBase.html.twig',array());
    }

    public function adminAction()
    {
        return $this->redirect($this->generateUrl('user_adminpage'));
    }

    public function userHomeAction()
    {
        // get current user
        $usr= $this->getUser();
        return $this->render('UserBundle::indexUser.html.twig',array('user'=>$usr));
    }


}
