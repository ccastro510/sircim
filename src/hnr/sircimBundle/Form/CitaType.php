<?php

namespace hnr\sircimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CitaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ciEdadPaciente',null,array('label'=>'Edad'))
            ->add('ciEstado',null,array('label'=>'Estado'))
            ->add('idSolicitud',new SolicitudType(13),array('label'=>' '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hnr\sircimBundle\Entity\Cita'
        ));
    }

    public function getName()
    {
        return 'hnr_sircimbundle_citatype';
    }
}
