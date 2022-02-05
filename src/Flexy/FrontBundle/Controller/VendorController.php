<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop/vendors')]
class VendorController extends AbstractController
{
    #[Route('/single-vendor/{id}', name: 'single_vendor')]
    public function single(Vendor $vendor,ProductFrontRepository $productFrontRepository): Response
    {

        return $this->render('@Flexy\FrontBundle/templates/vendors/singleVendor.html.twig', [
            'vendor' => $vendor,
            'products'=>$productFrontRepository->findBy(["vendor"=>$vendor])

        ]);
    }
}
