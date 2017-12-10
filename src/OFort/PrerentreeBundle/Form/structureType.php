<?php

namespace OFort\PrerentreeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class structureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',          TextType::class)
            ->add('description',   TextareaType::class, array(
                'required' => false))
            ->add('commentaire',   TextareaType::class, array(
                'required' => false))
            ->add('version',      TextType::class, array(
                'required' => false))
            ->add('rentree',      TextType::class)
            ->add('dateCreation', DateType::class, array(
                'required' => false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OFort\PrerentreeBundle\Entity\structure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ofort_prerentreebundle_structure';
    }


}
