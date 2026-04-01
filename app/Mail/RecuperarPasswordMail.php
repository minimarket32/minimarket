<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperarPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $url;

    public function __construct($usuario, $url)
    {
        $this->usuario = $usuario;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('emails.recuperar')
                    ->subject('Restablecer Contraseña - MiniMarket')
                    ->with([
                        'nombre' => $this->usuario->nombre,
                        'url' => $this->url,
                    ]);
    }
}