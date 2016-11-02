<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RightGoods;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rightgood controller.
 *
 */
class RightGoodsController extends Controller
{
    /**
     * Lists all rightGood entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rightGoods = $em->getRepository('AppBundle:RightGoods')->findAll();

        return $this->render('AppBundle:rightgoods:index.html.twig', array(
            'rightGoods' => $rightGoods,
        ));
    }

    /**
     * Creates a new rightGood entity.
     *
     */
    public function newAction(Request $request)
    {
        $rightGood = new RightGoods();
        $form = $this->createForm('AppBundle\Form\RightGoodsType', $rightGood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rightGood);
            $em->flush($rightGood);

            return $this->redirectToRoute('rightgoods_index');
        }

        return $this->render('AppBundle:rightgoods:new.html.twig', array(
            'rightGood' => $rightGood,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rightGood entity.
     *
     */
    public function showAction(RightGoods $rightGood)
    {
        $deleteForm = $this->createDeleteForm($rightGood);

        return $this->render('AppBundle:rightgoods:show.html.twig', array(
            'rightGood' => $rightGood,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rightGood entity.
     *
     */
    public function editAction(Request $request, RightGoods $rightGood)
    {
        $deleteForm = $this->createDeleteForm($rightGood);
        $editForm = $this->createForm('AppBundle\Form\RightGoodsType', $rightGood);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rightgoods_index');
        }

        return $this->render('AppBundle:rightgoods:edit.html.twig', array(
            'rightGood' => $rightGood,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rightGood entity.
     *
     */
    public function deleteAction(Request $request, RightGoods $rightGood)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($rightGood);
            $em->flush($rightGood);


        return $this->redirectToRoute('rightgoods_index');
    }

    /**
     * Creates a form to delete a rightGood entity.
     *
     * @param RightGoods $rightGood The rightGood entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RightGoods $rightGood)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rightgoods_delete', array('id' => $rightGood->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
