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
        $em = $this->getDoctrine()->getManager();

        $all_right_benefits = $em->getRepository('AppBundle:RightGoods')->findAll();
        $total = 0;
        foreach ($all_right_benefits as $item) {
            $total += $item->getOpeningBalance();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rightGood);
            $em->flush($rightGood);

            return $this->redirectToRoute('rightgoods_index');
        }

        return $this->render('AppBundle:rightgoods:new.html.twig', array(
            'rightGood' => $rightGood,
            'total' => $total,
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
        $em = $this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rightgoods_index');
        }

        $all_right_benefits = $em->getRepository('AppBundle:RightGoods')->findAll();
        $total = 0;
        foreach ($all_right_benefits as $item) {
            $total += $item->getOpeningBalance();
        }

        return $this->render('AppBundle:rightgoods:edit.html.twig', array(
            'rightGood' => $rightGood,
            'edit_form' => $editForm->createView(),
            'total' => $total,
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
