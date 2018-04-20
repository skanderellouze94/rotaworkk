<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Company controller.
 *
 */
class MemberController extends Controller
{
    public function registerAction(Request $request)
    {
        $member = new Member();
        $form = $this->createForm(\AppBundle\Form\MemberRegisterType::class,$member);
        $em    = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /**
             *@var UploadedFile $file
             */
            $file=$member->getCv();
            $file2=$member->getPhoto();

            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $fileName2=md5(uniqid()).'.'.$file2->guessExtension();
            $file->move(
                $this->getParameter('cv_directory'),$fileName
            );
            $file2->move(
                $this->getParameter('image_directory'),$fileName2
            );

            $member = $form->getData();

            $user = new User();
            $user->setEmail($form->get('email')->getData());
            $user->setUserName($form->get('login')->getData());
            $user->setPlainPassword($form->get('password')->getData());
            $user->setRoles(array('ROLE_USER'));
            $user->setEnabled(1);

            $member->setUser($user);
            $member->setCv($fileName);
            $member->setPhoto($fileName2);
            $em->persist($user);

            $em->persist($member);

            $em->flush();
            return $this->redirectToRoute('fos_user_security_login');


        }

        return $this->render('AppBundle:Registration:member_register.html.twig',
            array('form'=>$form->createView())
        );

    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $members = $em->getRepository('AppBundle:Member')->findAll();

        return $this->render('AppBundle:Member:index.html.twig', array(
            'members' => $members,
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('AppBundle:Member')->find($id);
        return $this->render('AppBundle:Member:show.html.twig', array(
            'm' => $member,

        ));
    }
}
