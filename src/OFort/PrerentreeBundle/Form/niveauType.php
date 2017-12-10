<?php

namespace OFort\PrerentreeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class niveauType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array(
                      'label' => 'Nom',
                      'required' => false))
                ->add('nomCourt', TextType::class, array(
                      'label' => 'Nom court',
                      'required' => false))
                ->add('annotation', TextareaType::class, array(
                      'label'  => 'Commentaire',
                      'required' => false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OFort\PrerentreeBundle\Entity\niveau'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ofort_prerentreebundle_niveau';
    }


}
