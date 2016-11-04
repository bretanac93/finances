<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SavingPlan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Savingplan controller.
 *
 */
class SavingPlanController extends Controller
{
    /**
     * Lists all savingPlan entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $savingPlans = $em->getRepository('AppBundle:SavingPlan')->findAll();

        return $this->render('AppBundle:savingplan:index.html.twig', array(
            'savingPlans' => $savingPlans,
        ));
    }

    /**
     * Creates a new savingPlan entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $savingPlan = new SavingPlan();
        $form = $this->createForm('AppBundle\Form\SavingPlanType', $savingPlan);
        $form->handleRequest($request);

        $all_saving_plans = $em->getRepository('AppBundle:SavingPlan')->findAll();
        $total = 0;
        foreach ($all_saving_plans as $item) {
            $total += $item->getOpeningBalance();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($savingPlan);
            $em->flush($savingPlan);

            return $this->redirectToRoute('savingplan_index');
        }

        return $this->render('AppBundle:savingplan:new.html.twig', array(
            'savingPlan' => $savingPlan,
            'total' => $total,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a savingPlan entity.
     *
     */
    public function showAction(SavingPlan $savingPlan)
    {
        $deleteForm = $this->createDeleteForm($savingPlan);

        return $this->render('savingplan/show.html.twig', array(
            'savingPlan' => $savingPlan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing savingPlan entity.
     *
     */
    public function editAction(Request $request, SavingPlan $savingPlan)
    {
        $deleteForm = $this->createDeleteForm($savingPlan);
        $editForm = $this->createForm('AppBundle\Form\SavingPlanType', $savingPlan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('savingplan_index');
        }

        return $this->render('AppBundle:savingplan:edit.html.twig', array(
            'savingPlan' => $savingPlan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a savingPlan entity.
     *
     */
    public function deleteAction(Request $request, SavingPlan $savingPlan)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($savingPlan);
            $em->flush($savingPlan);


        return $this->redirectToRoute('savingplan_index');
    }

    /**
     * Creates a form to delete a savingPlan entity.
     *
     * @param SavingPlan $savingPlan The savingPlan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SavingPlan $savingPlan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('savingplan_delete', array('id' => $savingPlan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
