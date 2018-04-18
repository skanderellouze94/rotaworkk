<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Advert controller.
 *
 */
class AdvertController extends Controller
{
    /**
     * Lists all advert entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findAll();

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }

    public function indexITAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>1]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexManagmentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>2]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexDCAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>3]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexAccAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>4]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexSMAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>5]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexLJAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>6]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexBankAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>7]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }
    public function indexDAAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('AppBundle:Advert')->findBy(['categorie'=>8]);

        return $this->render('AppBundle:advert:index.html.twig', array(
            'adverts' => $adverts,
        ));
    }


    /**
     * Creates a new advert entity.
     *
     */
    public function newAction(Request $request)
    {
        $advert = new Advert();
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('AppBundle:Company')->findOneBy(['user'=>$this->getUser()]);

        $form = $this->createForm('AppBundle\Form\AdvertType', $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $advert->setStatus(0);
            $advert->setCompany($company);
            $advert->setPublicationDate(new \DateTime('now'));
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('advert_show', array('id' => $advert->getId()));
        }

        return $this->render('AppBundle:advert:new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a advert entity.
     *
     */
    public function showAction(Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);

        return $this->render('AppBundle:advert:show.html.twig', array(
            'advert' => $advert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing advert entity.
     *
     */
    public function editAction(Request $request, Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);
        $editForm = $this->createForm('AppBundle\Form\AdvertType', $advert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advert_edit', array('id' => $advert->getId()));
        }

        return $this->render('AppBundle:advert:edit.html.twig', array(
            'advert' => $advert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a advert entity.
     *
     */
    public function deleteAction(Request $request, Advert $advert)
    {
        $form = $this->createDeleteForm($advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('advert_index');
    }

    /**
     * Creates a form to delete a advert entity.
     *
     * @param Advert $advert The advert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Advert $advert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('advert_delete', array('id' => $advert->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
