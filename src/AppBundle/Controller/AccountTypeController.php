<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Accounttype controller.
 *
 */
class AccountTypeController extends Controller
{
    /**
     * Lists all accountType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accountTypes = $em->getRepository('AppBundle:AccountType')->findAll();

        return $this->render('AppBundle:accounttype:index.html.twig', array(
            'accountTypes' => $accountTypes,
        ));
    }

    /**
     * Creates a new accountType entity.
     *
     */
    public function newAction(Request $request)
    {
        $accountType = new Accounttype();
        $form = $this->createForm('AppBundle\Form\AccountTypeType', $accountType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($accountType);
            $em->flush($accountType);

            return $this->redirectToRoute('accounttype_show', array('id' => $accountType->getId()));
        }

        return $this->render('AppBundle:accounttype:new.html.twig', array(
            'accountType' => $accountType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a accountType entity.
     *
     */
    public function showAction(AccountType $accountType)
    {
        $deleteForm = $this->createDeleteForm($accountType);

        return $this->render('AppBundle:accounttype:show.html.twig', array(
            'accountType' => $accountType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accountType entity.
     *
     */
    public function editAction(Request $request, AccountType $accountType)
    {
        $deleteForm = $this->createDeleteForm($accountType);
        $editForm = $this->createForm('AppBundle\Form\AccountTypeType', $accountType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accounttype_edit', array('id' => $accountType->getId()));
        }

        return $this->render('AppBundle:accounttype:edit.html.twig', array(
            'accountType' => $accountType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a accountType entity.
     *
     */
    public function deleteAction(Request $request, AccountType $accountType)
    {
        $form = $this->createDeleteForm($accountType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accountType);
            $em->flush($accountType);
        }

        return $this->redirectToRoute('accounttype_index');
    }

    /**
     * Creates a form to delete a accountType entity.
     *
     * @param AccountType $accountType The accountType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccountType $accountType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accounttype_delete', array('id' => $accountType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
