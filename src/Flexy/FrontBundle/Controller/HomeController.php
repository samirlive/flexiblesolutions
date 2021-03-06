<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\CategoryProductFrontRepository;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use App\Flexy\FrontBundle\Repository\PubBannerRepository;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'front_home')]
    public function index(
        ProductFrontRepository $productRepository,
        MasterSliderRepository $masterSliderRepository,
        PubBannerRepository $pubBannerRepository,
        CategoryProductFrontRepository $categoryProductFrontRepository
        
        ): Response
    {


        $deals = $productRepository->findDeals();

        return $this->render('@Flexy\FrontBundle/templates/home/index.html.twig', [
            'products' => $productRepository->findAll(),
            'masterSliders'=> $masterSliderRepository->findBy(["isEnabled"=>true]),
            'pubBanners'=> $pubBannerRepository->findBy(["isEnabled"=>true]),
            'deals'=>$deals,
            'categoriesProduct'=> $categoryProductFrontRepository->findBy(["parentCategory"=>null])
        ]);
    }



    #[Route('/contact', name: 'contact')]
    public function contact(ProductRepository $productRepository): Response
    {
        

        return $this->render('@Flexy\FrontBundle/templates/home/contact.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
}
