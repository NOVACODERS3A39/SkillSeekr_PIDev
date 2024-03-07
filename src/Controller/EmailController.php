<?php

// src/Controller/EmailController.php

namespace App\Controller;

use App\Form\CustomEmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    #[Route('/send-email', name: 'app_send_email')]
    public function sendSecondModal(Request $request, MailerInterface $mailer): Response
    {
        // Create a form instance and handle the request
        $form = $this->createForm(CustomEmailType::class);
        $form->handleRequest($request);

        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the form data
            $formData = $form->getData();

            // Create the email message
            $email = (new Email())
                ->from('sarah.henia@esprit.tn')
                ->to($formData['email']) // Access 'email' field from form data
                ->subject($formData['subject']) // Access 'subject' field from form data
                ->text($formData['message']); // Access 'message' field from form data

            // Send the email
            $mailer->send($email);

            // Redirect to a success page
            return $this->redirectToRoute('email_sent');
        }

        // Render the form template if not submitted or invalid
        return $this->render('Front/Offer/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
