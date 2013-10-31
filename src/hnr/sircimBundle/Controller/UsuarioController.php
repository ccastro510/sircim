<?php

namespace hnr\sircimBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use hnr\sircimBundle\Entity\Usuario;
use hnr\sircimBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="usuario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('hnrsircimBundle:Usuario')->findAll();

        $empleados=$this->extraerDatos("\"Idempleado\",\"Nombre\"");
        $empleado=array();
        
        for ($i = 0; $i < count($entities); $i++){
            $emp=$entities[$i]->getIdEmpleado();
            for ($j = 0; $j < count($empleados); $j++){
                
                $emp2=$empleados[$j]['Idempleado'];
                
                
                if($emp==$emp2){
                    $empleado[$i]= $empleados[$j]['Nombre'];
                }
            }
        
        }
        
        return array(
            'entities' => $entities,
            'empleados'=> $empleado,   
        );
    }

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/", name="usuario_create")
     * @Method("POST")
     * @Template("hnrsircimBundle:Usuario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Usuario();
        $entity->setUsUsuarioCreacion("MCastro");
        $entity->setUsFechaCreacion(new \DateTime('now'));
        $entity->setUsActualizarContrasena(1);
        $l=$_POST["listaempleado"];        
        $entity->setIdempleado($l);
        $empleados=$this->extraerDatos("*");
        $form = $this->createForm(new UsuarioType(), $entity);
    
        $form->bind($request);
        
        if (isset($_POST['estado1'])) {
            
            $entity->setUsEstadoActivo(1);
        } 
        else {
           
            $entity->setUsEstadoActivo(0);
        }
        if (isset($_POST['estado2'])) {
            
            $entity->setUsEstadoBloqueado(1);
        } 
        else {
           
            $entity->setUsEstadoBloqueado(0);
        }
            
        if ($form->isValid()) {
            echo "sdcdsc;";
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('usuario_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'empleados'=> $empleados,   
        );
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Usuario();
        $form   = $this->createForm(new UsuarioType(), $entity);
        $empleados=$this->extraerDatos("*");
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'empleados' => $empleados,
        );
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('hnrsircimBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('hnrsircimBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}", name="usuario_update")
     * @Method("PUT")
     * @Template("hnrsircimBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('hnrsircimBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UsuarioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('hnrsircimBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    private function extraerDatos($campos){
        $campos=$campos;
        $conn = $this->get('doctrine.dbal.siap_connection'); 
        $empleados = $conn->fetchAll("select ".$campos." from vw_empleado_info");        
        return $empleados;
    }


}
