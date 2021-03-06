<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/messages")
 */
class MessagesController extends AbstractController
{
    /**
     * @Route("/", name="message_index")
     */
    public function index(MessagesRepository $messagesRepository): Response
    {
        return $this->render('messages/index.html.twig', [
            'message' => $messagesRepository->findAll(),
        ]);
    }
    
/**
     * @Route("/formulaireMessages", name = "formulaireMessages_index", methods={"GET","POST"})
     */
    public function formulaireMessages(Request $request): Response
    {
        $messages = new Messages();
        
        $form = $this->createForm(MessagesType::class, $messages);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();

            return $this->redirectToRoute('message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/formulaireMessages.html.twig', [
            'message' => $messages,
            'formMessages' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nouveauMessages", name="nouveauMessage_index", methods={"GET","POST"})
     */
    public function nouveauMessages(Request $request): Response
    {
        $messages = new Messages();
        $form = $this->createForm(MessagesType::class, $messages);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();

            return $this->redirectToRoute('message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/nouveauMessage.html.twig', [
            'message' => $messages,
            'formMessages' => $form->createView(),
        ]);
    }

    /**
     * @Route("/afficherMessage/{id}", name="afficherMessage_index", methods={"GET"})
     */
    public function afficherMessage(Messages $messages): Response
    {
        return $this->render('messages/afficherMessage.html.twig', [
            'message' => $messages,
        ]);
    }

/**
     * @Route("/modifierMessages/{id}", name="modifierMessage_index", methods={"GET","POST"})
     */
    public function modifierMessages(Request $request, Messages $messages): Response
    {
        $form = $this->createForm(MessagesType::class, $messages);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();

            return $this->redirectToRoute('message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/modifierMessage.html.twig', [
            'message' => $messages,
            'formMessages' => $form->createView(),
        ]);
    }

// SUPPRESSION D'UN MESSAGE :
    /**
     * @Route("/supprimerMessages/{id}" , name="supprimerMessage_index", methods= {"GET","POST"})
     */
    public function supprimerMessages(Request $request, Messages $messages , EntityManagerInterface $entityManager) : Response 
    {           
            $entityManager->remove($messages);
            $entityManager->flush();
            return $this->redirectToRoute('message_index'); 
    }


/**
     * @Route("/messagesEnvoyer", name="messagesEnvoyer_index")
     */
    public function messageEnvoyer(Request $request): Response
    {
        $messages = new Messages();
        $form = $this->createForm(MessagesType::class, $messages);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $messages->setExpediteur($this->getUtilisateurs());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();

                    $this->addFlash("message", "Message envoy?? avec succ??s.");
            return $this->redirectToRoute("message_index");
        }

        return $this->render("messages/index.html.twig", [
            'message' => $messages,
                        "formMessages" => $form->createView()
        ]);
    }

    /**
     * @Route("/messagesRecu", name="messagesRecu_index")
     */
    public function messageRe??u(): Response
    {
        return $this->render('messages/messagesRe??u.html.twig'[
]);
    }

    /**
     * @Route("/listeMessagesEnvoyer", name="listeMessagesEnvoyer_index")
     */
    public function listeMessagesEnvoyer(): Response
    {
        return $this->render('messages/listeMessagesEnvoyer.html.twig');
    }

    /**
     * @Route("/messagesLu/{id}", name="messagesLu_index")
     */
    public function messageLu(Messages $messages): Response
    {
        $messages->setSiMessageLu(true);

        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();

        return $this->render('messages/messagesLu.html.twig', compact("message")[
]);
    }



}
