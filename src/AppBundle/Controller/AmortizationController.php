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
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            $amortization = new Amortization();
            
            $amortization->setAmortizationAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('amortizationAccount')));
            $amortization->setPlanned($request->get('planned'));
            $amortization->setTotalAmortization(0);
            $amortization->setTotalExcessive(0);

            $em->persist($amortization);
            $em->flush();

            return $this->redirectToRoute('amortization_index');
        }

        return $this->render('AppBundle:amortization:new.html.twig', array(
            'childAccounts'=>$childAccounts            
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
        $em = $this->getDoctrine()->getManager();

        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {
            
            $amortization->setAmortizationAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('amortizationAccount')));
            $amortization->setPlanned($request->get('planned'));
            $amortization->setTotalAmortization(0);
            $amortization->setTotalExcessive(0);

            $em->persist($amortization);
            $em->flush();

            return $this->redirectToRoute('amortization_index');
        }

        return $this->render('AppBundle:amortization:edit.html.twig', array(
            'childAccounts'=>$childAccounts,
            'amortization'=>$amortization
        ));
    }

    /**
     * Deletes a amortization entity.
     *
     */
    public function deleteAction(Request $request, Amortization $amortization)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($amortization);
        $em->flush($amortization);
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
