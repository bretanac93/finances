<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Accounttype controller.
 *
 */
class AccountTypeController extends Controller
{
    /**
     * Lists all accountType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accountTypes = $em->getRepository('AppBundle:AccountType')->findAll();

        return $this->render('AppBundle:accounttype:index.html.twig', array(
            'accountTypes' => $accountTypes,
        ));
    }

    /**
     * Creates a new accountType entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $accountType = new AccountType();
            $accountType->setName($request->get('name'));
            $accountType->setRequiredBalance($request->get('required_balance'));
            $em->persist($accountType);
            $em->flush();

            return $this->redirectToRoute('accounttype_index');
        }

        return $this->render('AppBundle:accounttype:new.html.twig');
    }

    /**
     * Finds and displays a accountType entity.
     *
     */
    public function showAction(AccountType $accountType)
    {
        $deleteForm = $this->createDeleteForm($accountType);

        return $this->render('AppBundle:accounttype:show.html.twig', array(
            'accountType' => $accountType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accountType entity.
     *
     */
    public function editAction(Request $request, AccountType $accountType)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $accountType->setName($request->get('name'));
            $accountType->setRequiredBalance($request->get('required_balance'));
            $em->persist($accountType);
            $em->flush();

            return $this->redirectToRoute('accounttype_index');
        }

        return $this->render('AppBundle:accounttype:edit.html.twig', array(
            'accountType'=>$accountType
            ));
    }

    /**
     * Deletes a accountType entity.
     *
     */
    public function deleteAction(Request $request, AccountType $accountType)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($accountType);
        $em->flush($accountType);

        return $this->redirectToRoute('accounttype_index');
    }

    /**
     * Creates a form to delete a accountType entity.
     *
     * @param AccountType $accountType The accountType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccountType $accountType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accounttype_delete', array('id' => $accountType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
