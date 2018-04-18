<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MemberRegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label'=>'Prénom'))
            ->add('prenom',null,array('label'=>'Nom'))
            ->add('adresse',null,array('label'=>'adresse'))
            ->add('dateNaissance',DateType::class,array('widget'=>'single_text','label'=>'Date de naissance'))
            ->add('numero',null,array('label'=>'Téléphone'))
            ->add('login',null,array('mapped'=>false))
            ->add('password',PasswordType::class,array('mapped'=>false))
            ->add('email',null,array('mapped'=>false))
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
            ->add('cv', FileType::class, array('label' => 'CV Pro (PDF file)','data_class'=>null))
            ->add('photo', FileType::class, array('label' => 'photo','data_class'=>null))



        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Member'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_member_register';
    }


}
