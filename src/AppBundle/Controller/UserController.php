<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function profileAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $user_manager = $this->get('fos_user.user_manager');
            $user = $this->getUser();
            $user->setFirstName($request->get('first_name'));
            $user->setLastName($request->get('last_name'));
            $user->setUsername($request->get('username'));
            $user->setEmail($request->get('email'));
            $user->setEnabled(true);
            $user->setLocked(false);
            $user_manager->updateUser($user);
            return $this->redirectToRoute('user_profile');
        }
        return $this->render('AppBundle:User:profile.html.twig');
    }

    public function changePasswordAction(Request $request) {
        $factory = $this->get('security.encoder_factory');
        $user_manager = $this->get('fos_user.user_manager');
        $user = $this->getUser();
        
        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');
        $repeat_password = $request->get('repeat_password');

        $encoder = $factory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($old_password, $user->getSalt());
        // print_r();

        if ($user->getPassword() == $encodedPassword) {
            if ($new_password == $repeat_password) {
                $user->setPlainPassword($new_password);
                $user_manager->updateUser($user);
                $this->addFlash(
                    'success',
                    'Contraseña modificada correctamente'
                );
                return $this->redirectToRoute('user_profile');
            }
            $this->addFlash(
                'error',
                'Las contraseñas comparadas no coinciden'
            );
            return $this->redirectToRoute('user_profile');
        }
        $this->addFlash(
            'error',
            'La contraseña introducida no coincide con la almacenada en el sistema'
        );
        return $this->redirectToRoute('user_profile');
    }
}
