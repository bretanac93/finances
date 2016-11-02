<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:User:index.html.twig', array('copropietaries' => $this->getUser()->getCopropietaries()));
    }

    public function newAction(Request $request) {
            
        if ($request->getMethod() == 'POST') {
            $user_manager = $this->get('fos_user.user_manager');
            $copropietary = $user_manager->createUser();
            $copropietary->setFirstName($request->get('first_name'));
            $copropietary->setLastName($request->get('last_name'));
            $copropietary->setUsername($request->get('username'));
            $copropietary->setEmail($request->get('email'));
            $copropietary->setEnabled(true);
            $copropietary->setLocked(false);
            $copropietary->setPropietary($this->getUser());
            $copropietary->setPlainPassword($request->get('plain_password'));
            $user_manager->updateUser($copropietary);

            return $this->redirectToRoute('user_index');
        }
        return $this->render('AppBundle:User:new.html.twig');
    }

    public function editAction(Request $request, User $copropietary) {
        if ($request->getMethod() == 'POST') {
            $user_manager = $this->get('fos_user.user_manager');
            $copropietary->setFirstName($request->get('first_name'));
            $copropietary->setLastName($request->get('last_name'));
            $copropietary->setUsername($request->get('username'));
            $copropietary->setEmail($request->get('email'));
            $copropietary->setEnabled(true);
            $copropietary->setLocked(false);
            $copropietary->setPropietary($this->getUser());
            $copropietary->setPlainPassword($request->get('plain_password'));
            $user_manager->updateUser($copropietary);

            return $this->redirectToRoute('user_index');
        }
        return $this->render('AppBundle:User:edit.html.twig', array('entity' => $copropietary));
    }

    public function deleteAction(Request $request, User $copropietary)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($copropietary);
        $em->flush($copropietary);
        return $this->redirectToRoute('user_index');
    }

}
