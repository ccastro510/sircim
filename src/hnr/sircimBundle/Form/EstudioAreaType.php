<?php

namespace hnr\sircimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \hnr\sircimBundle\Entity\Estudio;

class EstudioAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idEstudio', new EstudioType(),array('label'=>' '))
            ->add('estadoEstudioArea','text',array('label'=>'Estado área'))
            ->add('idArea',null,
                array('label'=>'Área',
                      'empty_value'=>'Seleccione un área...'
                    ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hnr\sircimBundle\Entity\EstudioArea'
        ));
    }

    public function getName()
    {
        return 'hnr_sircimbundle_estudioareatype';
    }
}
