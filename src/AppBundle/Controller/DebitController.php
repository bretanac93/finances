<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Debit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Debit controller.
 *
 */
class DebitController extends Controller
{
    /**
     * Lists all debit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $debits = $em->getRepository('AppBundle:Debit')->findAll();

        return $this->render('AppBundle:debit:index.html.twig', array(
            'debits' => $debits,
        ));
    }

    /**
     * Creates a new debit entity.
     *
     */
    public function newAction(Request $request)
    {
        $debit = new Debit();
        $form = $this->createForm('AppBundle\Form\DebitType', $debit);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($debit);
            $em->flush($debit);

            return $this->redirectToRoute('debit_index');
        }

        // print_r("Todo Mal");

        return $this->render('AppBundle:debit:new.html.twig', array(
            'debit' => $debit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a debit entity.
     *
     */
    public function showAction(Debit $debit)
    {
        $deleteForm = $this->createDeleteForm($debit);

        return $this->render('debit/show.html.twig', array(
            'debit' => $debit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing debit entity.
     *
     */
    public function editAction(Request $request, Debit $debit)
    {
        $deleteForm = $this->createDeleteForm($debit);
        $editForm = $this->createForm('AppBundle\Form\DebitType', $debit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('debit_edit', array('id' => $debit->getId()));
        }

        return $this->render('AppBundle:debit:edit.html.twig', array(
            'debit' => $debit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        
        ));
    }

    /**
     * Deletes a debit entity.
     *
     */
    public function deleteAction(Request $request, Debit $debit)
    {
        $form = $this->createDeleteForm($debit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($debit);
            $em->flush($debit);
        }

        return $this->redirectToRoute('debit_index');
    }

    /**
     * Creates a form to delete a debit entity.
     *
     * @param Debit $debit The debit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Debit $debit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('debit_delete', array('id' => $debit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
