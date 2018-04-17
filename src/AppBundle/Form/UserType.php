<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('prenom')
        ->add('cv',FileType::class, array('data_class'=>null ,'label' => false))
        ->add('cvr',FileType::class, array('data_class'=>null ,'label' => false))
            ->add('niveauEtude',ChoiceType::class,array('choices'=>array(
                'Bac'=>'Bac',
                'Master'=>'Master'),'label'=>false))
        ->add('rotaract',ChoiceType::class,
            array(
                'choices' => array(
                    'Sidi bousaid' => "Sidi bousaid" ,
                    'Sidi bousaid el beji' => "Sidi bousaid el beji",
                    'Marsa carthage' => 'Marsa carthage ',
                    'Tanit carthage' => 'Tanit carthage ',
                    'Marsa plage' => 'Marsa plage ',
                    'Carthage amilcar' => 'Carthage amilcar',
                    'Tunis golf' => 'Tunis golf ',
                    'Tunis el bey' => 'Tunis el bey ',
                    'Tunis les berges du lac' => 'Tunis les berges du lac ',
                    'Rades' => 'Rades ',
                    'Hammam-lif' => 'Hammam-lif',
                    'Megrine' => 'Megrine ',
                    'TBS' => 'TBS ',
                    'Ariana la rose' => 'Ariana la rose',
                    'Technopole ghazela' => 'Technopole ghazela',
                    'Tunis ennaser' => 'Tunis ennaser ',
                    'Cosmo politain' => 'Cosmo politain ',
                    'Mannouba carthage' => 'Mannouba carthage',
                    'Tunis doyen' => 'Tunis doyen ',
                    'Big south' => 'Big south ',
                    'ESSEC tunis' => 'ESSEC tunis',
                    'IHEC carthage' => 'IHEC carthage',
                    'ISG' => 'ISG ',
                    'Université centrale' => 'Université centrale',
                    'Nabeul neapolis' => 'Nabeul neapolis ',
                    'Marina bizerte' => 'Marina bizerte ',
                    'Kairaouan' => 'Kairaouan ',
                    'Kaserine' => 'Kaserine ',
                    'Sousse' => 'Sousse ',
                    'Pragma kantaoui' => 'Pragma kantaoui',
                    'Mounastir' => 'Mounastir ',
                    'Mahdia' => 'Mahdia ',
                    'Sfax doyen' => 'Sfax doyen',
                    'Sfax metropole' => 'Sfax metropole',
                    'Sfax flambeau' => 'Sfax flambeau ',
                    'Sfax el borj' => 'Sfax el borj ',
                    'Sfax taparoura' => 'Sfax taparoura')
                ,'label' => false))
        ->add('numero')
        ->add('dateNaissance',BirthdayType::class, array(
            'input' => 'datetime',
            'widget' => 'choice',
            'format' =>'dd/MM/yyyy'))

    ;
    }


    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()

    {
        return 'app_user_registration';
    }


    public function getName()

    {
        return $this->getBlockPrefix();
    }


}
