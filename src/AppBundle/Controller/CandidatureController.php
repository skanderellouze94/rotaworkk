<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Candidature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Candidature controller.
 *
 */
class CandidatureController extends Controller
{
    /**
     * Lists all candidature entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $candidatures = $em->getRepository('AppBundle:Candidature')->findAll();

        return $this->render('AppBundle:candidature:index.html.twig', array(
            'candidatures' => $candidatures,
        ));
    }

    /**
     * Creates a new candidature entity.
     *
     */
    public function newAction(Request $request)
    {
        $candidature = new Candidature();
        $form = $this->createForm('AppBundle\Form\CandidatureType', $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($candidature);
            $em->flush();

            return $this->redirectToRoute('candidature_show', array('id' => $candidature->getId()));
        }

        return $this->render('AppBundle:candidature:new.html.twig', array(
            'candidature' => $candidature,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a candidature entity.
     *
     */
    public function showAction(Candidature $candidature)
    {
        $deleteForm = $this->createDeleteForm($candidature);

        return $this->render('AppBundle:candidature:show.html.twig', array(
            'candidature' => $candidature,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing candidature entity.
     *
     */
    public function editAction(Request $request, Candidature $candidature)
    {
        $deleteForm = $this->createDeleteForm($candidature);
        $editForm = $this->createForm('AppBundle\Form\CandidatureType', $candidature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidature_edit', array('id' => $candidature->getId()));
        }

        return $this->render('AppBundle:candidature:edit.html.twig', array(
            'candidature' => $candidature,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a candidature entity.
     *
     */
    public function deleteAction(Request $request, Candidature $candidature)
    {
        $form = $this->createDeleteForm($candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($candidature);
            $em->flush();
        }

        return $this->redirectToRoute('candidature_index');
    }

    /**
     * Creates a form to delete a candidature entity.
     *
     * @param Candidature $candidature The candidature entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Candidature $candidature)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('candidature_delete', array('id' => $candidature->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
