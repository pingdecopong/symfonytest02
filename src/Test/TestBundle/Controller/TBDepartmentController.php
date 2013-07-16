<?php

namespace Test\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Test\TestBundle\Entity\TBDepartment;
use Test\TestBundle\Form\TBDepartmentType;

/**
 * TBDepartment controller.
 *
 * @Route("/tbdepartment")
 */
class TBDepartmentController extends Controller
{

    /**
     * Lists all TBDepartment entities.
     *
     * @Route("/", name="tbdepartment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TestTestBundle:TBDepartment')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TBDepartment entity.
     *
     * @Route("/", name="tbdepartment_create")
     * @Method("POST")
     * @Template("TestTestBundle:TBDepartment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new TBDepartment();
        $form = $this->createForm(new TBDepartmentType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tbdepartment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new TBDepartment entity.
     *
     * @Route("/new", name="tbdepartment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TBDepartment();
        $form   = $this->createForm(new TBDepartmentType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TBDepartment entity.
     *
     * @Route("/{id}", name="tbdepartment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestTestBundle:TBDepartment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TBDepartment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TBDepartment entity.
     *
     * @Route("/{id}/edit", name="tbdepartment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestTestBundle:TBDepartment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TBDepartment entity.');
        }

        $editForm = $this->createForm(new TBDepartmentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TBDepartment entity.
     *
     * @Route("/{id}", name="tbdepartment_update")
     * @Method("PUT")
     * @Template("TestTestBundle:TBDepartment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestTestBundle:TBDepartment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TBDepartment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TBDepartmentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tbdepartment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TBDepartment entity.
     *
     * @Route("/{id}", name="tbdepartment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TestTestBundle:TBDepartment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TBDepartment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tbdepartment'));
    }

    /**
     * Creates a form to delete a TBDepartment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
