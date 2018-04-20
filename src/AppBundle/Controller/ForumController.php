<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commentaireforum;
use AppBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    public function insertAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $f = new Forum();
        $form = $this->createForm('AppBundle\Form\ForumType', $f);
        $form->handleRequest($request);
        if ($form->isValid()) {


            /**
             *@var UploadedFile $file
             */
            $file=$f->getPhoto();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $f->setCont(substr(strip_tags($f->getContenu()),0,400));
            $f->setPhoto($fileName);
            $f->setDate(new \DateTime('now'));
            $f->setUser($this->getUser());
            $em->persist($f);
            $em->flush();
        }
        return $this->render('AppBundle:ForumViews:insert.html.twig', array(
            'form' => $form->createView()

        ));
    }
    public function indexAction(Request $request)
    {
        $f = new Forum();
        $em    = $this->getDoctrine()->getManager();

        $dql   = "SELECT m FROM AppBundle:Forum m ";
        $query = $em->createQuery($dql);



        $paginator  = $this->get('knp_paginator');
        $f = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('AppBundle:ForumViews:index.html.twig',
            array('forums'=>$f));
    }

    public function showAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();

        $forum = $em->getRepository(("AppBundle:Forum"))
            ->find("$id");

        $cf = new Commentaireforum();
        $ccf = new Commentaireforum();

        $cf = $em->getRepository(("AppBundle:Commentaireforum"))->findBy(['forum'=>$id]);


        $form = $this->createForm('AppBundle\Form\CommentaireforumType', $ccf);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $ccf->setDate(new \DateTime('now'));
            $ccf->setUser($this->getUser());
            $ccf->setForum($forum);
            $em->persist($ccf);
            $em->flush();
            return $this->redirect($request->getUri());

        }
        return $this->render('AppBundle:ForumViews:show.html.twig', array('cf' => $cf,'f'=>$forum,
            'form' => $form->createView()));
    }
}
