<?php

namespace App\Controller;

use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/question/ask/', name: 'question_form')]
    public function index(Request $request): Response
    {
        // Create the form thanks to the formType which is called below with createForm method
        $formQuestion = $this->createForm(QuestionType::class);

        // handleRequest is the method to check steps related to request parameters
        $formQuestion->handleRequest($request);

        // we use isSubmitted and is valid thanks to the handle request
        // these 2 methods check if form submit data with POST method and isValid checks input data are valid
        if ($formQuestion->isSubmitted() && $formQuestion->isValid()) {
            // getData method retrieves input data after all safety checks
            dump($formQuestion->getData());
        }

        return $this->render('question/index.html.twig', [
            // createView methods renders the form data
            'form' => $formQuestion->createView(),
        ]);
    }
}
