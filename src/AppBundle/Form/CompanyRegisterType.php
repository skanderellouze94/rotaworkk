<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CompanyRegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null,array('label'=>'nom'))
            ->add('adresse',null,array('label'=>'adresse'))
            ->add('phone',null,array('label'=>'Téléphone'))
            ->add('fax',null,array('label'=>'fax'))
            ->add('siteweb',null,array('label'=>'site web'))
            ->add('pagefb',null,array('label'=>'page facebook'))
            ->add('login',null,array('mapped'=>false))
            ->add('password',PasswordType::class,array('mapped'=>false))
            ->add('email',null,array('mapped'=>false))
            ->add('photo', FileType::class, array('label' => 'CV Pro (PDF file)','data_class'=>null))



        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_company_register';
    }


}
