<?php

namespace hnr\sircimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use hnr\sircimBundle\Entity\EstudioRadTamPlaca;

class EstudioRadiologicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('erEdadPaciente',null,array('label'=>'Edad'))
            ->add('idempleado',null,array('label'=>'Empleado'))
            ->add('idSolicitud',new SolicitudType(13),array('label'=>' '))
            ->add('placas','collection',array(
                'type' => new EstudioRadTamPlacaType(),
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                ))            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hnr\sircimBundle\Entity\EstudioRadiologico'
        ));
    }

    public function getName()
    {
        return 'hnr_sircimbundle_estudioradiologicotype';
    }
}
