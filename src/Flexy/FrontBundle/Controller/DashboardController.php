<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Entity\MasterSlider;
use App\Flexy\FrontBundle\Entity\PubBanner;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::section('Frontend');
        yield MenuItem::linkToCrud('Master Slider',"fas fa-eye",MasterSlider::class);
        yield MenuItem::linkToCrud('Banniéres pubs',"fas fa-eye",PubBanner::class);
        yield MenuItem::linkToRoute('Marketplace enligne',"fas fa-eye","front_home");
        
        
        
        

        
    }
}
