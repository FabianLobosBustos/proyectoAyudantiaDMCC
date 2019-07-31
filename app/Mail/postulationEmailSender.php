<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Postulation;
use App\Subject;
use App\Assistant;
use App\Phase;

class postulationEmailSender extends Mailable
{
    use Queueable, SerializesModels;

    public $postulation;
    //subject es palabra reservada!!!, usar asignatura
    public $asignatura;
    public $assistant;
    public $phase;

    public $assistantScoreSendArray;
    public $requirementSendArray;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Postulation $postulation, Subject $asignatura, Assistant $assistant, Phase $phase,$assistantScoreSendArray,$requirementSendArray)
    {
        $this->postulation = $postulation;
        $this->asignatura = $asignatura;
        $this->assistant = $assistant;
        $this->phase = $phase;
        $this->assistantScoreSendArray = $assistantScoreSendArray;
        $this->requirementSendArray = $requirementSendArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('postulationEmail')->subject('Comprobante postulación');
    }
}
