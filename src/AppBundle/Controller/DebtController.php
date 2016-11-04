<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Debt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Debt controller.
 *
 */
class DebtController extends Controller
{
    /**
     * Lists all debt entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $debts = $em->getRepository('AppBundle:Debt')->findAll();

        return $this->render('AppBundle:debt:index.html.twig', array(
            'debts' => $debts,
        ));
    }

    /**
     * Creates a new debt entity.
     *
     */
    public function newAction(Request $request)
    {
        $debt = new Debt();
        $form = $this->createForm('AppBundle\Form\DebtType', $debt);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $all_debts = $em->getRepository('AppBundle:Debt')->findAll();
        $total = 0;
        foreach ($all_debts as $item) {
            $total += $item->getOpeningBalance();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($debt);
            $em->flush($debt);

            return $this->redirectToRoute('debt_index');
        }

        return $this->render('AppBundle:debt:new.html.twig', array(
            'debt' => $debt,
            'total' => $total,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a debt entity.
     *
     */
    public function showAction(Debt $debt)
    {
        $deleteForm = $this->createDeleteForm($debt);

        return $this->render('debt/show.html.twig', array(
            'debt' => $debt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing debt entity.
     *
     */
    public function editAction(Request $request, Debt $debt)
    {
        $deleteForm = $this->createDeleteForm($debt);
        $editForm = $this->createForm('AppBundle\Form\DebtType', $debt);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $all_debts = $em->getRepository('AppBundle:Debt')->findAll();
        $total = 0;
        foreach ($all_debts as $item) {
            $total += $item->getOpeningBalance();
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('debt_index');
        }

        return $this->render('AppBundle:debt:edit.html.twig', array(
            'debt' => $debt,
            'total' => $total,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a debt entity.
     *
     */
    public function deleteAction(Request $request, Debt $debt)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($debt);
            $em->flush($debt);

        return $this->redirectToRoute('debt_index');
    }

    /**
     * Creates a form to delete a debt entity.
     *
     * @param Debt $debt The debt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Debt $debt)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('debt_delete', array('id' => $debt->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
