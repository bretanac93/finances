<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MatrixAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Matrixaccount controller.
 *
 */
class MatrixAccountController extends Controller
{
    /**
     * Lists all matrixAccount entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matrixAccounts = $em->getRepository('AppBundle:MatrixAccount')->findAll();

        return $this->render('AppBundle:matrixaccount:index.html.twig', array(
            'matrixAccounts' => $matrixAccounts,
        ));
    }

    /**
     * Creates a new matrixAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $matrixAccount = new Matrixaccount();
        $form = $this->createForm('AppBundle\Form\MatrixAccountType', $matrixAccount);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $accountTypes = $em->getRepository('AppBundle:AccountType')->findAll();
        
        if ($form->isSubmitted()) {
            
            $em->persist($matrixAccount);
            $em->flush($matrixAccount);

            return $this->redirectToRoute('matrixaccount_index');
        }

        return $this->render('AppBundle:matrixaccount:new.html.twig', array(
            'matrixAccount' => $matrixAccount,
            'accountTypes'=>$accountTypes,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a matrixAccount entity.
     *
     */
    public function showAction(MatrixAccount $matrixAccount)
    {
        $deleteForm = $this->createDeleteForm($matrixAccount);

        return $this->render('matrixaccount/show.html.twig', array(
            'matrixAccount' => $matrixAccount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing matrixAccount entity.
     *
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('AppBundle\Form\MatrixAccountType', $matrixAccount);
        $accountTypes = $em->getRepository('AppBundle:AccountType')->findAll();

        if($request->getMethod() == "POST") {
            $data = $editForm->getData();
            $data->setAccountType($em->getRepository('AppBundle:AccountType')->findOneById($request->get('account_type')));

            $editForm2 = $this->createForm('AppBundle\Form\MatrixAccountType', $data);

            if ($editForm2->isValid()) {
                $em->flush();

                return $this->redirectToRoute('matrixaccount_index');
            }
            return $this->redirectToRoute('matrixaccount_edit', ['id' => $matrixAccount->getId()]);
        }

        return $this->render('AppBundle:matrixaccount:edit.html.twig', array(
            'matrixAccount' => $matrixAccount,
            'edit_form' => $editForm->createView(),
            'accountTypes'=>$accountTypes,
        ));
    }

    /**
     * Deletes a matrixAccount entity.
     *
     */
    public function deleteAction(Request $request, MatrixAccount $matrixAccount)
    {
        $form = $this->createDeleteForm($matrixAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($matrixAccount);
            $em->flush($matrixAccount);
        }

        return $this->redirectToRoute('matrixaccount_index');
    }

    /**
     * Creates a form to delete a matrixAccount entity.
     *
     * @param MatrixAccount $matrixAccount The matrixAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MatrixAccount $matrixAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('matrixaccount_delete', array('id' => $matrixAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
