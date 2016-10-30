<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expenditure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Expenditure controller.
 *
 */
class ExpenditureController extends Controller
{
    /**
     * Lists all expenditure entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $expenditures = $em->getRepository('AppBundle:Expenditure')->findAll();

        return $this->render('expenditure/index.html.twig', array(
            'expenditures' => $expenditures,
        ));
    }

    /**
     * Creates a new expenditure entity.
     *
     */
    public function newAction(Request $request)
    {
        $expenditure = new Expenditure();
        $form = $this->createForm('AppBundle\Form\ExpenditureType', $expenditure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expenditure);
            $em->flush($expenditure);

            return $this->redirectToRoute('expenditure_show', array('id' => $expenditure->getId()));
        }

        return $this->render('expenditure/new.html.twig', array(
            'expenditure' => $expenditure,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a expenditure entity.
     *
     */
    public function showAction(Expenditure $expenditure)
    {
        $deleteForm = $this->createDeleteForm($expenditure);

        return $this->render('expenditure/show.html.twig', array(
            'expenditure' => $expenditure,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing expenditure entity.
     *
     */
    public function editAction(Request $request, Expenditure $expenditure)
    {
        $deleteForm = $this->createDeleteForm($expenditure);
        $editForm = $this->createForm('AppBundle\Form\ExpenditureType', $expenditure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expenditure_edit', array('id' => $expenditure->getId()));
        }

        return $this->render('expenditure/edit.html.twig', array(
            'expenditure' => $expenditure,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a expenditure entity.
     *
     */
    public function deleteAction(Request $request, Expenditure $expenditure)
    {
        $form = $this->createDeleteForm($expenditure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expenditure);
            $em->flush($expenditure);
        }

        return $this->redirectToRoute('expenditure_index');
    }

    /**
     * Creates a form to delete a expenditure entity.
     *
     * @param Expenditure $expenditure The expenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Expenditure $expenditure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expenditure_delete', array('id' => $expenditure->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
