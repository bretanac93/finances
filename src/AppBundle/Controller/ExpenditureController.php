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

        return $this->render('AppBundle:expenditure:index.html.twig', array(
            'expenditures' => $expenditures,
        ));
    }

    /**
     * Creates a new expenditure entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $expenditure = new Expenditure();
            
            $expenditure->setExpenditureAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('expenditureAccount')));
            $expenditure->setPlanned($request->get('planned'));
            $expenditure->setTotalExpenditure(0);
            $expenditure->setTotalExcessive(0);
            $expenditure->setSubTotalExcessive(0);

            $em->persist($expenditure);
            $em->flush();

            return $this->redirectToRoute('expenditure_index');
        }

        return $this->render('AppBundle:expenditure:new.html.twig', array(
            'childAccounts'=>$childAccounts            
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
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            
            $expenditure->setExpenditureAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('expenditureAccount')));
            $expenditure->setPlanned($request->get('planned'));
            $expenditure->setTotalExpenditure(0);
            $expenditure->setTotalExcessive(0);
            $expenditure->setSubTotalExcessive(0);

            $em->persist($expenditure);
            $em->flush();

            return $this->redirectToRoute('expenditure_index');
        }

        return $this->render('AppBundle:expenditure:edit.html.twig', array(
            'childAccounts'=>$childAccounts,
            'expenditure'=>$expenditure      
        ));
    }

    /**
     * Deletes a expenditure entity.
     *
     */
    public function deleteAction(Request $request, Expenditure $expenditure)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($expenditure);
        $em->flush($expenditure);
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
