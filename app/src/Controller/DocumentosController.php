<?php

namespace App\Controller;

use App\Entity\Documentos;
use App\Entity\TipoDocumento;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DocumentosController extends AbstractController
{
    /**
     * @Route("/documentos", name="documentos")
     */
    public function index(): Response
    {
        $documentos = $this->getDoctrine()->getRepository(Documentos::class)->findAll();

        return $this->render('documentos/index.html.twig', [
            'documentos' => $documentos
        ]);
    }
    
    /**
     * @Route("/documentos/cadastro",name="cadastro_documentos")
     * @Method({"GET","POST"})
     */
    public function cadastro(Request $request)
    {
        $documentos = new Documentos();
        $form = $this->createFormBuilder($documentos)
            ->add('titulo', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('tipo_id', EntityType::class, [
                'class' => TipoDocumento::class,
                'choice_label' => 'nome_tipo',
                'choice_value' => 'id'
            ])
            ->add('nome_arquivo', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $documentos = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documentos);
            $entityManager->flush();
            return $this->redirectToRoute('documentos');
        }
        return $this->render('documentos/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/documentos/edit/{id}",name="editar_documentos")
     * @Method({"GET","POST"})
     */
    public function edit(Request $request, $id)
    {
        $documento = $this->getDoctrine()->getRepository(Documentos::class)->find($id);
        $form = $this->createFormBuilder($documento)
            ->add('titulo', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('tipo_id', EntityType::class, [
                'class' => TipoDocumento::class,
                'choice_label' => 'nome_tipo',
                'choice_value' => 'id'
            ])
            ->add('nome_arquivo', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Atualizar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('documentos');
        }
        return $this->render('documentos/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/documentos/{id}",name="mostrar_documentos")
     */
    public function show($id)
    {
        $documento = $this->getDoctrine()->getRepository(Documentos::class)->find($id);
        return $this->render('documentos/show.html.twig', array('documento' => $documento));
    }

    /**
     * @Route("/documentos/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $documento = $this->getDoctrine()->getRepository(Documentos::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($documento);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}
