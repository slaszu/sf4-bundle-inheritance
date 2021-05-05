<?php

declare(strict_types=1);

namespace App\PageExtendBundle\Controller;

use App\PageExtendBundle\Service\RandomNumberService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request, string $name = ''): Response
    {
        dump('PAGE EXTENDED CONTROLLER !!!!!');
        $random = $this->get(RandomNumberService::class);
        return $this->render('@Page/default/index.html.twig',[
            'controller' => __CLASS__,
            'name' => $name,
            'params' => (string)$random
        ]);
    }
}