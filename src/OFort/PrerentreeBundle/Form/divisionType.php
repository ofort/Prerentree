<?php

namespace OFort\PrerentreeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use OFort\PrerentreeBundle\Entity\maquette;
use OFort\PrerentreeBundle\Entity\filiere;
use OFort\PrerentreeBundle\Entity\niveauFormation;

class divisionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',          TextType::class)
            ->add('nomCourt',     TextType::class)
            ->add('classeDedoublee',    CheckboxType::class, array(
                'required' => false))
            ->add('classeDetriplee',    CheckboxType::class, array(
                'required' => false))
            ->add('effectif',     NumberType::class, array(
                'required' => false))
            ->add('maquette', EntityType::class, array(
                'class' => 'OFortPrerentreeBundle:maquette',
                'choice_label' => 'nom'))
            ->add('filiere', EntityType::class, array(
                'class' => 'OFortPrerentreeBundle:filiere',
                'choice_label' => 'nomCourt'))
            ->add('niveauFormation', EntityType::class, array(
                'class' => 'OFortPrerentreeBundle:niveauFormation',
                'choice_label' => 'nom'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OFort\PrerentreeBundle\Entity\division'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ofort_prerentreebundle_division';
    }


}
