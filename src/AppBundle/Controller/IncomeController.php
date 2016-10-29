<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Income;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Income controller.
 *
 */
class IncomeController extends Controller
{
    /**
     * Lists all income entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $incomes = $em->getRepository('AppBundle:Income')->findAll();

        return $this->render('AppBundle:income:index.html.twig', array(
            'incomes' => $incomes,
        ));
    }

    /**
     * Creates a new income entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $income = new Income();
            $income->setAmount($request->get('amount'));
            $income->setCashEntry($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashEntry')));
            $income->setEntryReason($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('entryReason')));
            $income->setBriefDescription($request->get('briefDescription'));
            $income->setAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('entryReason')));
            $em->persist($income);
            $em->flush();

            return $this->redirectToRoute('income_index');
        }

        return $this->render('AppBundle:income:new.html.twig', array(
            // 'income' => $income,
            'childAccounts'=>$childAccounts,
        ));
    }

    /**
     * Finds and displays a income entity.
     *
     */
    public function showAction(Income $income)
    {
        $deleteForm = $this->createDeleteForm($income);

        return $this->render('AppBundle:income:show.html.twig', array(
            'income' => $income,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing income entity.
     *
     */
    public function editAction(Request $request, Income $income)
    {
        $em = $this->getDoctrine()->getManager();
        // $income = $em->getRepository('AppBundle:Income')->findOneById($id);
        
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $income->setAmount($request->get('amount'));
            $income->setCashEntry($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashEntry')));
            $income->setEntryReason($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('entryReason')));
            $income->setBriefDescription($request->get('briefDescription'));
            $income->setAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('entryReason')));
            $em->persist($income);
            $em->flush();

            return $this->redirectToRoute('income_index');
        }

        return $this->render('AppBundle:income:edit.html.twig', array(
            'income' => $income,
            'childAccounts'=>$childAccounts,
        ));
    }

    /**
     * Deletes a income entity.
     *
     */
    public function deleteAction(Request $request, Income $income)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($income);
        $em->flush($income);

        return $this->redirectToRoute('income_index');
    }

    /**
     * Creates a form to delete a income entity.
     *
     * @param Income $income The income entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Income $income)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('income_delete', array('id' => $income->getId())))
            // ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
