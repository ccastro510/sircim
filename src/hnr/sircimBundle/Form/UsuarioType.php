<?php

namespace hnr\sircimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usLogin',null, array('label'=>'Login'))
            ->add('usCorreo','email', array('label'=>'Correo'))
            ->add('usContrasena', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Las contraseñas deben ser iguales.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options'  => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repetir contraseña')))
            // ->add('usActualizarContrasena')


            // ->add('usEstadoActivo', 'checkbox', array(
            //         'required'  => true,
            //         'attr' => array('name' => 'check',
            //                         'id' => 'slideThree',
            //                         'value' => 'None'
            //         )))


            // ->add('usEstadoBloqueado', 'checkbox', array(
            //         'label'     => 'Bloqueado/Desbloqueado',
            //         'required'  => true,
            //         'attr' => array('class' => 'slide2')))

            // ->add('idempleado')
            // ->add('usUsuarioCreacion')
            // ->add('usUsuarioModificacion')
            // ->add('usFechaCreacion')
            // ->add('usFechaModificacion')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hnr\sircimBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'hnr_sircimbundle_usuariotype';
    }
}
