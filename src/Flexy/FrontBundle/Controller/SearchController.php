<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Product\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop/search')]
class SearchController extends AbstractController
{

    #[Route('/', name: "front_search")]
    public function search(Request $request,ProductFrontRepository $productFrontRepository): Response
    {

        $keyword = $request->query->get("keyword");


        $products = $productFrontRepository->findAll();

        if(count($productFrontRepository->findByKeyWord($keyword)) > 0){
            $products = $productFrontRepository->findByKeyWord($keyword);
        }

        return $this->render('@Flexy\FrontBundle/templates/search/search.html.twig',[
            "products"=>$products
        ]);
    }
}
