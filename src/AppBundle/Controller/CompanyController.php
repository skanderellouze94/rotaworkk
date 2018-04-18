<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Company controller.
 *
 */
class CompanyController extends Controller
{
    /**
     * Lists all company entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companies = $em->getRepository('AppBundle:Company')->findAll();

        return $this->render('AppBundle:company:index.html.twig', array(
            'companies' => $companies,
        ));
    }

    /**
     * Creates a new company entity.
     *
     */
    public function newAction(Request $request)
    {
        $company = new Company();
        $form = $this->createForm('AppBundle\Form\CompanyType', $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('company_show', array('id' => $company->getId()));
        }

        return $this->render('AppBundle:company:new.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a company entity.
     *
     */
    public function showAction(Company $company)
    {
        $deleteForm = $this->createDeleteForm($company);

        return $this->render('AppBundle:company:show.html.twig', array(
            'company' => $company,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing company entity.
     *
     */
    public function editAction(Request $request, Company $company)
    {
        $deleteForm = $this->createDeleteForm($company);
        $editForm = $this->createForm('AppBundle\Form\CompanyType', $company);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_edit', array('id' => $company->getId()));
        }

        return $this->render('AppBundle:company:edit.html.twig', array(
            'company' => $company,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a company entity.
     *
     */
    public function deleteAction(Request $request, Company $company)
    {
        $form = $this->createDeleteForm($company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('company_index');
    }

    /**
     * Creates a form to delete a company entity.
     *
     * @param Company $company The company entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Company $company)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('company_delete', array('id' => $company->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function registerAction(Request $request)
    {
        $company = new Company();
        $form = $this->createForm(\AppBundle\Form\CompanyRegisterType::class,$company);
        $em    = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /**
             *@var UploadedFile $file
             */
            $file=$company->getPhoto();

            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $company = $form->getData();

            $user = new User();
            $user->setEmail($form->get('email')->getData());
            $user->setUserName($form->get('login')->getData());
            $user->setPlainPassword($form->get('password')->getData());
            $user->setRoles(array('ROLE_PARTENAIRE'));
            $user->setEnabled(1);

            $company->setUser($user);
            $company->setPhoto($fileName);
            $em->persist($user);

            $em->persist($company);

            $em->flush();


        }

        return $this->render('AppBundle:Registration:company_register.html.twig',
            array('form'=>$form->createView())
        );

    }
}
