<?php

namespace App\Notification;

use App\Entity\Quotation;
use Swift_Mailer;
use Twig\Environment;

class QuotationNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Quotation $quote)
    {
        $message = (new \Swift_Message('RCP électronic : l\'entreprise ' . $quote->getCompany() . ' vous demande un devis !'))
            ->setFrom('noreply@rcp-electronic.fr')
            ->setTo('contact@rcp-electronic.fr');
        $img = $message->embed(\Swift_Image::fromPath('images/logo.png'));
        $quote_img = $message->embed(\Swift_Image::fromPath('images/quotations/' . $quote->getImageName()));
        $message->setBody($this->renderer->render('emails/quotation.html.twig', [
            'quotation' => $quote,
            'img' => $img,
            'quote_img' => $quote_img
        ]), 'text/html');
        $this->mailer->send($message);
    }

    public function abstract(Quotation $quote)
    {
        $message = (new \Swift_Message('RCP électronic : résumé de votre demande de devis'))
            ->setFrom('noreply@rcp-electronic.fr')
            ->setTo($quote->getMail());
        $img = $message->embed(\Swift_Image::fromPath('images/logo.png'));
        $quote_img = $message->embed(\Swift_Image::fromPath('images/quotations/' . $quote->getImageName()));
        $message->setBody($this->renderer->render('emails/quotationAbstract.html.twig', [
            'quotation' => $quote,
            'img' => $img,
            'quote_img' => $quote_img
        ]), 'text/html');
        $this->mailer->send($message);
    }
}
