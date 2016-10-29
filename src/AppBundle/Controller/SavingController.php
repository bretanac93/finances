<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Saving;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Saving controller.
 *
 */
class SavingController extends Controller
{
    /**
     * Lists all saving entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $savings = $em->getRepository('AppBundle:Saving')->findAll();

        return $this->render('saving/index.html.twig', array(
            'savings' => $savings,
        ));
    }

    /**
     * Creates a new saving entity.
     *
     */
    public function newAction(Request $request)
    {
        $saving = new Saving();
        $form = $this->createForm('AppBundle\Form\SavingType', $saving);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($saving);
            $em->flush($saving);

            return $this->redirectToRoute('saving_show', array('id' => $saving->getId()));
        }

        return $this->render('saving/new.html.twig', array(
            'saving' => $saving,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a saving entity.
     *
     */
    public function showAction(Saving $saving)
    {
        $deleteForm = $this->createDeleteForm($saving);

        return $this->render('saving/show.html.twig', array(
            'saving' => $saving,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing saving entity.
     *
     */
    public function editAction(Request $request, Saving $saving)
    {
        $deleteForm = $this->createDeleteForm($saving);
        $editForm = $this->createForm('AppBundle\Form\SavingType', $saving);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('saving_edit', array('id' => $saving->getId()));
        }

        return $this->render('saving/edit.html.twig', array(
            'saving' => $saving,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a saving entity.
     *
     */
    public function deleteAction(Request $request, Saving $saving)
    {
        $form = $this->createDeleteForm($saving);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($saving);
            $em->flush($saving);
        }

        return $this->redirectToRoute('saving_index');
    }

    /**
     * Creates a form to delete a saving entity.
     *
     * @param Saving $saving The saving entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Saving $saving)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('saving_delete', array('id' => $saving->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
