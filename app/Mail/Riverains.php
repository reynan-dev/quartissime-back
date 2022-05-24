<?php

namespace App\Mail;

use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class Riverains extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(request $request)
    {
       $comiteMail= $request->comiteMail;
        $comiteName = $request->comiteName;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $email = $request->email;
        $adresse = $request->adresse;
       
        return $this->view('mail/welcomemail',compact('comiteName','nom','prenom','email','adresse'));
    }
}
