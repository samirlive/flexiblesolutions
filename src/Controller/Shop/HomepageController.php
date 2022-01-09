<?php

declare(strict_types=1);

namespace App\Controller\Shop;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HomepageController
{
    /** @var Environment */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function indexAction(): Response
    {
        
        return new Response($this->twig->render('@SyliusShop/Homepage/index.html.twig',["message"=>"Hello team flexible !"]));
    }

    public function customAction(): Response
    {
        return new Response($this->twig->render('website/contact.html.twig'));
    }
}