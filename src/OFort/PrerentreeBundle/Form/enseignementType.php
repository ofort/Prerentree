<?php

namespace OFort\PrerentreeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class enseignementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',          TextType::class)
            ->add('duree',        NumberType::class,
                    array(
                        'label' => 'Durée élève totale (cours + TD + TP)'))
            ->add('dureeDedoublee', NumberType::class,
                    array(
                        'label' => 'Pour une classe dédoublée, quelle durée serait dédoublée (TD + TP)'))
                        ->add('dureeDetriplee', NumberType::class,
                    array(
                        'label' => 'Pour une classe détriplée, quelle durée serait détriplée (TP)'))
            ->add('commentaire',  TextareaType::class, array(
                        'label' => 'Commentaire',
                        'required' => false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OFort\PrerentreeBundle\Entity\enseignement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ofort_prerentreebundle_enseignement';
    }


}
