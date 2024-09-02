<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

class AddMyCorpHeaderListener
{
    public function addHeader(ResponseEvent $e): void  
    {
        $response = $e->getResponse();

        $response->headers->add([
            'X-DEVELOPED-BY' => 'xX_OsciLeKiki_Xx'
        ]);
    }
}