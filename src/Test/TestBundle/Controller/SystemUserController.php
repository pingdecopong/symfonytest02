<?php

namespace Test\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use pingdecopong\PagerBundle\Pager\Pager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Test\TestBundle\Entity\SystemUser;
use Test\TestBundle\Form\SystemUserType;

/**
 * SystemUser controller.
 *
 * @Route("/systemuser")
 */
class SystemUserController extends Controller
{

    /**
     * Lists all SystemUser entities.
     *
     * @Route("/", name="systemuser")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        $formFactory = $this->get('form.factory');
        $validator = $this->get('validator');
        $pager = new Pager($formFactory, $validator);

        //pager setting
        $pager
            ->addColumn('id', array(
                'label' => 'id',
                'sort_enable' => true,
                'db_column_name' => 'id',
            ))
            ->addColumn('email', array(
                'label' => 'email',
                'sort_enable' => true,
                'db_column_name' => 'email',
            ))
        ;

        $form = $pager->getFormBuilder()
            ->getForm();
        $form->bind($request);

        //pager
        $formView = $form->createView();
        $pager->setAllFormView($formView);
        $pager->setPagerFormView($formView);
        $pager->setLinkRouteName($request->get('_route'));

        if(!$form->isValid())
        {
            return $this->redirect($this->generateUrl($request->get('_route')));
        }

        //db
        $queryBuilder = $this->getDoctrine()
            ->getRepository('TestTestBundle:SystemUser')
            ->createQueryBuilder('u');

        //全件数取得
        $queryBuilderCount = clone $queryBuilder;
        $queryBuilderCount = $queryBuilderCount->select('count(u.id)');
        $queryCount = $queryBuilderCount->getQuery();
        $allCount = $queryCount->getSingleScalarResult();
        $pager->setAllCount($allCount);

        //ソート
        $pageSortName = $pager->getSortName();
        $pageSortType = $pager->getSortType();
        if($pageSortName != null && $pageSortType != null)
        {
            switch($pageSortName)
            {
                default:
                    $sortColumn = $pager->getColumn($pageSortName);
                    $queryBuilder = $queryBuilder->orderBy('u.'.$sortColumn['db_column_name'], $pageSortType);
                    break;
            }
        }

        //ページング
        $pageSize = $pager->getPageSize();
        $pageNo = $pager->getPageNo();
        if($pager->getMaxPageNum() < $pageNo){
            return $this->redirect($this->generateUrl($request->get('_route')));
        }
        $queryBuilder = $queryBuilder->setFirstResult($pageSize*($pageNo-1))
            ->setMaxResults($pageSize);

        //クエリー実行
        $entities = $queryBuilder->getQuery()->getResult();

        return array(
            'form' => $formView,
            'pager' => $pager->createView(),
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SystemUser entity.
     *
     * @Route("/", name="systemuser_create")
     * @Method("POST")
     * @Template("TestTestBundle:SystemUser:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SystemUser();
        $form = $this->createForm(new SystemUserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('systemuser_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * SystemUser新規作成
     *
     * @Route("/new", name="systemuser_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction()
    {
        $entity = new SystemUser();
        $form   = $this->createForm(new SystemUserType(), $entity);

        $request = $this->getRequest();
        $formModel = new SystemUser();
        $formType = new SystemUserType();

        /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
        $builder = $this->get('form.factory')->createBuilder($formType, $formModel);
        $form = $builder->getForm();

        if($request->isMethod('POST'))
        {
            $form->bind($request);

            //button_action
            $buttonAction = $request->request->get('_button_action');

            if($buttonAction == "confirm" || $buttonAction == "submit")
            {
                if($form->isValid())
                {
                    if($buttonAction == "confirm")
                    {
                        //確認画面
                        $builder->setAttribute('freeze', true);
                        $confirmForm = $builder->getForm();

                        return array(
                            'mode' => "confirm",
                            'entity' => $formModel,
                            'form' => $confirmForm->createView(),
                        );

                    }else if($buttonAction == "submit")
                    {
                        //登録実行
                        try{
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($formModel);
                            $em->flush();

                        }catch (\Exception $e){
                            throw $e;
                        }
                        return $this->redirect($this->generateUrl('systemuser_show', array('id' => $formModel->getId())));                    }
                }
            }else
            {
                //ドロップダウンなどのポストバック
                $builder->setAttribute('novalidation', true);
                $form = $builder->getForm();
            }
        }

        return array(
            'mode' => "input",
            'validate' => false,
            'entity' => $formModel,
            'form' => $form->createView(),
        );
    }

    /**
     * SystemUser詳細
     *
     * @Route("/{id}", name="systemuser_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestTestBundle:SystemUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SystemUser entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing SystemUser entity.
     *
     * @Route("/edit/{id}", name="systemuser_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction($id)
    {
        $request = $this->getRequest();
        $formType = new SystemUserType();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TestTestBundle:SystemUser')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SystemUser entity.');
        }

        /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
        $builder = $this->get('form.factory')->createBuilder($formType, $entity);
        $form = $builder->getForm();

        if($request->isMethod('POST'))
        {
            $form->bind($request);

            //button_action
            $buttonAction = $request->request->get('_button_action');

            if($buttonAction == "confirm" || $buttonAction == "submit")
            {
                if($form->isValid())
                {
                    if($buttonAction == "confirm")
                    {
                        //確認画面
                        $builder->setAttribute('freeze', true);
                        $confirmForm = $builder->getForm();

                        return array(
                            'mode' => "confirm",
                            'entity' => $entity,
                            'form' => $confirmForm->createView(),
                        );

                    }else if($buttonAction == "submit")
                    {
                        //登録実行
                        try{
                            $em->persist($entity);
                            $em->flush();

                        }catch (\Exception $e){
                            throw $e;
                        }
                    return $this->redirect($this->generateUrl('systemuser_show', array('id' => $entity->getId())));                    }
                }
            }else
            {
                //ドロップダウンなどのポストバック
                $builder->setAttribute('novalidation', true);
                $form = $builder->getForm();
            }
        }

        return array(
            'mode' => "input",
            'validate' => false,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Edits an existing SystemUser entity.
     *
     * @Route("/{id}", name="systemuser_update")
     * @Method("PUT")
     * @Template("TestTestBundle:SystemUser:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestTestBundle:SystemUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SystemUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SystemUserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('systemuser_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SystemUser entity.
     *
     * @Route("/delete/{id}", name="systemuser_delete")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function deleteAction($id)
    {
        $request = $this->getRequest();
        $form = $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TestTestBundle:SystemUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SystemUser entity.');
        }

        if($request->isMethod('POST'))
        {
            $form->bind($request);
            if ($form->isValid()) {

                try{
                    $em->remove($entity);
                    $em->flush();

                }catch (\Exception $e){
                    throw $e;
                }
                return $this->redirect($this->generateUrl('systemuser'));
            }
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }


}
