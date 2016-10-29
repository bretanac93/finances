<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChildAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $childAccount = new Childaccount();
        $form = $this->createForm('AppBundle\Form\ChildAccountType', $childAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($childAccount);
            $em->flush($childAccount);

            return $this->redirectToRoute('childaccount_show', array('id' => $childAccount->getId()));
        }

        return $this->render('AppBundle:childaccount:new.html.twig', array(
            'childAccount' => $childAccount,
            'form' => $form->createView(),
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
        $deleteForm = $this->createDeleteForm($childAccount);
        $editForm = $this->createForm('AppBundle\Form\ChildAccountType', $childAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('childaccount_edit', array('id' => $childAccount->getId()));
        }

        return $this->render('AppBundle:childaccount:edit.html.twig', array(
            'childAccount' => $childAccount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a childAccount entity.
     *
     */
    public function deleteAction(Request $request, ChildAccount $childAccount)
    {
        $form = $this->createDeleteForm($childAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($childAccount);
            $em->flush($childAccount);
        }

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
}
