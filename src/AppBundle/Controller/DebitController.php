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
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $debit = new Debit();
            
            $debit->setCashWithdrawal($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashWithdrawal')));
            $debit->setWithdrawalReason($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('withdrawalReason')));
            $debit->setAmount($request->get('amount'));
            $debit->setAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashWithdrawal')));
            $debit->setBriefDescription($request->get('briefDescription'));

            $em->persist($debit);
            $em->flush();

            return $this->redirectToRoute('debit_index');
        }

        return $this->render('AppBundle:debit:new.html.twig', array(
            'childAccounts'=>$childAccounts            
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
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();
        
        if ($request->getMethod() == "POST") {
            $debit->setCashWithdrawal($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashWithdrawal')));
            $debit->setWithdrawalReason($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashWithdrawal')));
            $debit->setAmount($request->get('amount'));
            $debit->setAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('cashWithdrawal')));

            $em->persist($debit);
            $em->flush();

            return $this->redirectToRoute('debit_index');
        }

        return $this->render('AppBundle:debit:edit.html.twig', array(
            'debit' => $debit,
            'childAccounts'=>$childAccounts,
        ));
    }

    /**
     * Deletes a debit entity.
     *
     */
    public function deleteAction(Request $request, Debit $debit)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($debit);
        $em->flush($debit);
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
