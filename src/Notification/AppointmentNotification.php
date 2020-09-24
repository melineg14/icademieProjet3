<?php

namespace App\Notification;

use App\Entity\Appointment;
use Swift_Mailer;
use Twig\Environment;

class AppointmentNotification
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

    public function notify(Appointment $app)
    {
        $message = (new \Swift_Message('RCP électronic : l\'entreprise ' . $app->getCompany() . ' souhaite prendre rendez-vous avec vous !'))
            ->setFrom('noreply@rcp-electronic.fr')
            ->setTo('contact@rcpelec.gan-sabarat.fr');
        $img = $message->embed(\Swift_Image::fromPath('images/logo.png'));
        $message->setBody($this->renderer->render('emails/appointment.html.twig', [
            'appointment' => $app,
            'img' => $img
        ]), 'text/html');
        $this->mailer->send($message);
    }

    public function abstract(Appointment $app)
    {
        $message = (new \Swift_Message('RCP électronic : résumé de votre demande de prise de rendez-vous.'))
            ->setFrom('noreply@rcp-electronic.fr')
            ->setTo($app->getMail());
        $img = $message->embed(\Swift_Image::fromPath('images/logo.png'));
        $message->setBody($this->renderer->render('emails/appointmentAbstract.html.twig', [
            'appointment' => $app,
            'img' => $img
        ]), 'text/html');
        $this->mailer->send($message);
    }
}
