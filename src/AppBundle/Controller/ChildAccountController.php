<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChildAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Childaccount controller.
 *
 */
class ChildAccountController extends Controller
{
    /**
     * Lists all childAccount entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        return $this->render('AppBundle:childaccount:index.html.twig', array(
            'childAccounts' => $childAccounts,
        ));
    }

    /**
     * Creates a new childAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $matrixAccounts = $em->getRepository('AppBundle:MatrixAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $child = new ChildAccount();
            $matrix_account_id = $request->get('matrixAccount');
            $count_child_type = $em->getRepository('AppBundle:ChildAccount')->findBy(['matrix_account' => $matrix_account_id]);
            $counti = count($count_child_type) + 1;

            $child->setCode("$matrix_account_id.$counti");
            $child->setName($request->get('name'));
            $child->setMatrixAccount($em->getRepository('AppBundle:MatrixAccount')->findOneById($request->get('matrixAccount')));
            $em->persist($child);
            $em->flush();

            return $this->redirectToRoute('childaccount_index');
        }

        return $this->render('AppBundle:childaccount:new.html.twig', array(
            // 'income' => $income,
            'matrixAccounts'=>$matrixAccounts
        ));
    }

    /**
     * Finds and displays a childAccount entity.
     *
     */
    public function showAction(ChildAccount $childAccount)
    {
        $deleteForm = $this->createDeleteForm($childAccount);

        return $this->render('AppBundle:childaccount:show.html.twig', array(
            'childAccount' => $childAccount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing childAccount entity.
     *
     */
    public function editAction(Request $request, ChildAccount $childAccount)
    {
        $em = $this->getDoctrine()->getManager();

        $matrixAccounts = $em->getRepository('AppBundle:MatrixAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $matrix_account_id = $request->get('matrixAccount');
            $count_child_type = $em->getRepository('AppBundle:ChildAccount')->findBy(['matrix_account' => $em->getRepository('AppBundle:MatrixAccount')->findOneById($request->get('matrixAccount'))]);
            $counti = count($count_child_type) + 1;

            $childAccount->setCode("$matrix_account_id.$counti");
            $childAccount->setName($request->get('name'));
            $childAccount->setMatrixAccount($em->getRepository('AppBundle:MatrixAccount')->findOneById($request->get('matrixAccount')));
            $em->persist($childAccount);
            $em->flush();

            return $this->redirectToRoute('childaccount_index');
        }

        return $this->render('AppBundle:childaccount:edit.html.twig', array(
            'childAccount' => $childAccount,
            'matrixAccounts'=>$matrixAccounts
        ));
    }

    /**
     * Deletes a childAccount entity.
     *
     */
    public function deleteAction(Request $request, ChildAccount $childAccount)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($childAccount);
        $em->flush($childAccount);

        return $this->redirectToRoute('childaccount_index');
    }

    /**
     * Creates a form to delete a childAccount entity.
     *
     * @param ChildAccount $childAccount The childAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ChildAccount $childAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('childaccount_delete', array('id' => $childAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function getDataAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $count_child_type = $em->getRepository('AppBundle:ChildAccount')->findBy(['matrix_account' => $request->get('matrixAccount')]);
        $counti = count($count_child_type) + 1;
        
        return new Response($counti, 200);
    }

}
