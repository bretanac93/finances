<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashBoardController extends Controller
{
	public function homeAction () {
		if (!$this->getUser())
			return $this->redirect('/login');
		return $this->redirectToRoute('dashboard');
	}

	public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:DashBoard:dashboard.html.twig');
    }
}
