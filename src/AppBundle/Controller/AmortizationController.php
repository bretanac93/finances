<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Amortization;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Amortization controller.
 *
 */
class AmortizationController extends Controller
{
    /**
     * Lists all amortization entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $amortizations = $em->getRepository('AppBundle:Amortization')->findAll();

        return $this->render('AppBundle:amortization:index.html.twig', array(
            'amortizations' => $amortizations,
        ));
    }

    /**
     * Creates a new amortization entity.
     *
     */
    public function newAction(Request $request)
    {
        $amortization = new Amortization();
        $form = $this->createForm('AppBundle\Form\AmortizationType', $amortization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amortization);
            $em->flush($amortization);

            return $this->redirectToRoute('amortization_show', array('id' => $amortization->getId()));
        }

        return $this->render('AppBundle:amortization:new.html.twig', array(
            'amortization' => $amortization,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a amortization entity.
     *
     */
    public function showAction(Amortization $amortization)
    {
        $deleteForm = $this->createDeleteForm($amortization);

        return $this->render('amortization/show.html.twig', array(
            'amortization' => $amortization,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing amortization entity.
     *
     */
    public function editAction(Request $request, Amortization $amortization)
    {
        $deleteForm = $this->createDeleteForm($amortization);
        $editForm = $this->createForm('AppBundle\Form\AmortizationType', $amortization);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amortization_edit', array('id' => $amortization->getId()));
        }

        return $this->render('aAppBundle:amortization:edit.html.twig', array(
            'amortization' => $amortization,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a amortization entity.
     *
     */
    public function deleteAction(Request $request, Amortization $amortization)
    {
        $form = $this->createDeleteForm($amortization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($amortization);
            $em->flush($amortization);
        }

        return $this->redirectToRoute('amortization_index');
    }

    /**
     * Creates a form to delete a amortization entity.
     *
     * @param Amortization $amortization The amortization entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Amortization $amortization)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('amortization_delete', array('id' => $amortization->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
