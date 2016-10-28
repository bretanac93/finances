<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Debit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Debit controller.
 *
 * @Route("debit")
 */
class DebitController extends Controller
{
    /**
     * Lists all debit entities.
     *
     * @Route("/", name="debit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $debits = $em->getRepository('AppBundle:Debit')->findAll();

        return $this->render('debit/index.html.twig', array(
            'debits' => $debits,
        ));
    }

    /**
     * Creates a new debit entity.
     *
     * @Route("/new", name="debit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $debit = new Debit();
        $form = $this->createForm('AppBundle\Form\DebitType', $debit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($debit);
            $em->flush($debit);

            return $this->redirectToRoute('debit_show', array('id' => $debit->getId()));
        }

        return $this->render('debit/new.html.twig', array(
            'debit' => $debit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a debit entity.
     *
     * @Route("/{id}", name="debit_show")
     * @Method("GET")
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
     * @Route("/{id}/edit", name="debit_edit")
     * @Method({"GET", "POST"})
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

        return $this->render('debit/edit.html.twig', array(
            'debit' => $debit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a debit entity.
     *
     * @Route("/{id}", name="debit_delete")
     * @Method("DELETE")
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
