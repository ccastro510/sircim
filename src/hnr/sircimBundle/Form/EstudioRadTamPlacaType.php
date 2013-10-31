<?php

namespace hnr\sircimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudioRadTamPlacaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('idEstudioRadiologico',new EstudioRadiologicoType(13),array('label'=>' '))
            //->add('idEstudioRadiologico')
            ->add('idTamano',null,array('label' => 'Tamaño', 'empty_value' => 'Seleccione...'))
            ->add('ertpAceptadas',null,array('label' => 'Aceptadas'))
            ->add('ertpDescartadas',null,array('label' => 'Descartadas'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hnr\sircimBundle\Entity\EstudioRadTamPlaca'
        ));
    }

    public function getName()
    {
        return 'hnr_sircimbundle_estudioradtamplacatype';
    }
}
