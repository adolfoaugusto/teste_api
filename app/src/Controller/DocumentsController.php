<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\TipoDocumento;
use App\Entity\TypeDocument;
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

class DocumentsController extends AbstractController
{
    /**
     * @Route("/documents", name="documents")
     */
    public function index(): Response
    {
        $documents = $this->getDoctrine()->getRepository(Document::class)->findAll();
        // dd($documents);
        return $this->render('documents/index.html.twig', [
            'documents' => $documents
        ]);
    }
    
    /**
     * @Route("/documents/cadastro",name="cadastro_documents")
     * @Method({"GET","POST"})
     */
    public function cadastro(Request $request)
    {
        $documents = new Document();
        $form = $this->createFormBuilder($documents)
            ->add('title', TextType::class, array('label' => 'Título', 'attr' => array('class' => 'form-control')))
            ->add('type', EntityType::class, [
                'class' => TypeDocument::class,
                'choice_label' => 'name_type',
                'choice_value' => 'id'
            ])
            ->add('name_archive', TextareaType::class, array('label' => 'Nome do Arquivo', 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $documents = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documents);
            $entityManager->flush();
            return $this->redirectToRoute('documents');
        }
        return $this->render('documents/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/documents/edit/{id}",name="editar_documents")
     * @Method({"GET","POST"})
     */
    public function edit(Request $request, $id)
    {
        $document = $this->getDoctrine()->getRepository(Document::class)->find($id);
        $form = $this->createFormBuilder($document)
        ->add('title', TextType::class, array('label' => 'Título', 'attr' => array('class' => 'form-control')))
        ->add('type', EntityType::class, [
            'class' => TypeDocument::class,
            'choice_label' => 'name_type',
            'choice_value' => 'id'
        ])
        ->add('name_archive', TextareaType::class, array('label' => 'Nome do Arquivo', 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Atualizar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('documents');
        }
        return $this->render('documents/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/documents/{id}",name="mostrar_documents")
     */
    public function show($id)
    {
        $document = $this->getDoctrine()->getRepository(Document::class)->find($id);
        return $this->render('documents/show.html.twig', array('document' => $document));
    }

    /**
     * @Route("/documents/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $documento = $this->getDoctrine()->getRepository(Document::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($documento);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('documents');
    }
}
