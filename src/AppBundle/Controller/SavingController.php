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

        return $this->render('AppBundle:saving:index.html.twig', array(
            'savings' => $savings,
        ));
    }

    /**
     * Creates a new saving entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {

            $saving = new Saving();
            
            $saving->setSavingAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('savingAccount')));
            $saving->setPlanned($request->get('planned'));
            $saving->setTotalSaving(0);
            $saving->setBalance(0);

            $em->persist($saving);
            $em->flush();

            return $this->redirectToRoute('saving_index');
        }

        return $this->render('AppBundle:saving:new.html.twig', array(
            'childAccounts'=>$childAccounts            
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
        $em = $this->getDoctrine()->getManager();
        $childAccounts = $em->getRepository('AppBundle:ChildAccount')->findAll();

        if ($request->getMethod() == "POST") {

            
            
            $saving->setSavingAccount($em->getRepository('AppBundle:ChildAccount')->findOneById($request->get('savingAccount')));
            $saving->setPlanned($request->get('planned'));
            $saving->setTotalSaving(0);
            $saving->setBalance(0);

            $em->persist($saving);
            $em->flush();

            return $this->redirectToRoute('saving_index');
        }

        return $this->render('AppBundle:saving:edit.html.twig', array(
            'saving'=>$saving,
            'childAccounts'=>$childAccounts            
        ));
    }

    /**
     * Deletes a saving entity.
     *
     */
    public function deleteAction(Request $request, Saving $saving)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($saving);
        $em->flush($saving);
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
