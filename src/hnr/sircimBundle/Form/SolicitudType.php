<?php

namespace hnr\sircimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use hnr\sircimBundle\Repositorio\EstudioAreaRepository;

class SolicitudType extends AbstractType
{

    private $postIdArea;
     
    public function __construct($postIdArea = null)
    {
        $this->postIdArea = $postIdArea;
    }     

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idprueba = $this->postIdArea;
        $builder
            ->add('soTipo')
            ->add('soFecha', 'date', array(
            'input'  => 'datetime',
            'widget' => 'single_text',))
            
            //->add('soRegion','choice',array('label'=>'Región'))
            // ->add('soRegion', 'entity', array('empty_value' => 'Seleccione una region...',
            //         'class' => 'hnrsircimBundle:Region',
            //         'query_builder' => function(EntityRepository $er) {
            //             return $er->createQueryBuilder('e')
            //                       ->select('e.reNombre');
            //         },
            // ))
            ->add('soPosicion','text',array('label'=>'Posición'))
            ->add('idMntExpediente','text',array('label'=>'Expediente'))
            ->add('idMntAtenAreaModEstab')
            ->add('idEstudioArea',
                  'entity',
                  array( 'class'=>'hnrsircimBundle:EstudioArea',
                         'property'=>'idestudio',
                         'label' => 'Estudio',
                         'query_builder' => function(EstudioAreaRepository $r) use ($idprueba){
                            $r->idArea=$idprueba;
                            return $r->getEstudios();
                         },
                       )
                 )
            ->add('soRegion','choice',
                array('empty_value' => 'Seleccionar región...','label'=>'Región','choices' => array('R1' => 'Reg1', 'R2' => 'Reg2')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hnr\sircimBundle\Entity\Solicitud'
        ));
    }

    public function getName()
    {
        return 'hnr_sircimbundle_solicitudtype';
    }
}
