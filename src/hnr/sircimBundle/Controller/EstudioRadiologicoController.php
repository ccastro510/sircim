<?php

namespace hnr\sircimBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use hnr\sircimBundle\Entity\EstudioRadiologico;
use hnr\sircimBundle\Entity\EstudioRadTamPlaca;
use hnr\sircimBundle\Form\EstudioRadiologicoType;

/**
 * EstudioRadiologico controller.
 *
 * @Route("/estudioradiologico")
 */
class EstudioRadiologicoController extends Controller
{
    /**
     * Lists all EstudioRadiologico entities.
     *
     * @Route("/", name="estudioradiologico")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('hnrsircimBundle:EstudioRadiologico')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new EstudioRadiologico entity.
     *
     * @Route("/", name="estudioradiologico_create")
     * @Method("POST")
     * @Template("hnrsircimBundle:EstudioRadiologico:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new EstudioRadiologico();
        // $placa1 = new EstudioRadTamPlaca();
        // // //$placa1->setertpIdTamano(4);
        // $placa2 = new EstudioRadTamPlaca();
        // // //$placa1->setertpidTamano(2);
        // $entity->getPlacas()->add($placa1);
        // $entity->getPlacas()->add($placa2);
        // $entity->setPlacas($entity->getPlacas());
        $form = $this->createForm(new EstudioRadiologicoType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            //$em->persist($entity->getPlacas());
            $em->flush();
            return $this->redirect($this->generateUrl('estudioradiologico_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new EstudioRadiologico entity.
     *
     * @Route("/new", name="estudioradiologico_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EstudioRadiologico();
        // $placa1 = new EstudioRadTamPlaca();
        // // //$placa1->setertpIdTamano(4);
        // $placa2 = new EstudioRadTamPlaca();
        // // //$placa1->setertpidTamano(2);
        // $entity->getPlacas()->add($placa1);
        // $entity->getPlacas()->add($placa2);
        $form   = $this->createForm(new EstudioRadiologicoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EstudioRadiologico entity.
     *
     * @Route("/{id}", name="estudioradiologico_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('hnrsircimBundle:EstudioRadiologico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstudioRadiologico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EstudioRadiologico entity.
     *
     * @Route("/{id}/edit", name="estudioradiologico_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        // $placa1 = new EstudioRadTamPlaca();
        // $placa2 = new EstudioRadTamPlaca();
        // $entity->getPlacas()->add($placa1);
        // $entity->getPlacas()->add($placa2);
        // $placas = $em->getRepository('hnrsircimBundle:EstudioRadTamPlaca')->findAll();
        $entity = $em->getRepository('hnrsircimBundle:EstudioRadiologico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstudioRadiologico entity.');
        }

        $originalPlacas = array();

        // Create an array of the current Tag objects in the database
        foreach ($entity->getPlacas() as $placa) {
            $originalPlacas[] = $placa;
        }

        $editForm = $this->createForm(new EstudioRadiologicoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        // filter $originalTags to contain tags no longer present
        foreach ($entity->getPlacas() as $placa) {
            foreach ($originalPlacas as $key => $toDel) {
                if ($toDel->getId() === $placa->getId()) {
                    unset($originalPlacas[$key]);
                }
            }
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EstudioRadiologico entity.
     *
     * @Route("/{id}", name="estudioradiologico_update")
     * @Method("PUT")
     * @Template("hnrsircimBundle:EstudioRadiologico:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('hnrsircimBundle:EstudioRadiologico')->find($id);

        if (!$task) {
            throw $this->createNotFoundException('No task found for is '.$id);
        }

        $originalTags = array();

        // Create an array of the current Tag objects in the database
        foreach ($task->getPlacas() as $tag) {
            $originalTags[] = $tag;
        }

        $editForm = $this->createForm(new EstudioRadiologicoType(), $task);

        
            $editForm->bind($this->getRequest());

            if ($editForm->isValid()) {

                // filter $originalTags to contain tags no longer present
                foreach ($task->getPlacas() as $tag) {
                    foreach ($originalTags as $key => $toDel) {
                        if ($toDel->getId() === $tag->getId()) {
                            unset($originalTags[$key]);
                        }
                    }
                }

                // remove the relationship between the tag and the Task
                foreach ($originalTags as $tag) {
                    // remove the Task from the Tag
                    // $tag->getPlacas()->removeElement($task);

                    // if it were a ManyToOne relationship, remove the relationship like this
                    // $tag->setTask(null);

                    $em->persist($tag);

                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($tag);
                }

            $em->persist($task);
            $em->flush();

            // redirect back to some edit page
            return $this->redirect($this->generateUrl('estudioradiologico_edit', array('id' => $id)));
        }
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EstudioRadiologico entity.
     *
     * @Route("/{id}", name="estudioradiologico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('hnrsircimBundle:EstudioRadiologico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EstudioRadiologico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estudioradiologico'));
    }

    /**
     * Creates a form to delete a EstudioRadiologico entity by id.
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
}
