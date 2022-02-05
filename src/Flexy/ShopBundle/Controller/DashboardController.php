<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Controller\Admin\ProductCrudController;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Promotion\Coupon;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Payment\PaymentMethod;
use App\Flexy\ShopBundle\Entity\Product\Attribut;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Promotion\Promotion; 
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::section('Market Place');
        
        yield MenuItem::linkToCrud("Produits","fas fa-list",Product::class);
        yield MenuItem::linkToCrud("Attributs","fas fa-list",Attribut::class);
        yield MenuItem::linkToCrud("Vendeurs","fas fa-list",Vendor::class);
        yield MenuItem::linkToCrud("Client","fas fa-list",Customer::class);
        yield MenuItem::linkToCrud("Commandes","fas fa-list",Order::class);
        yield MenuItem::linkToCrud("Modes paiements","fas fa-list",PaymentMethod::class);
        yield MenuItem::linkToCrud("Promotions","fas fa-list",Promotion::class);
        yield MenuItem::linkToCrud("Coupon","fas fa-list",Coupon::class);
        yield MenuItem::linkToCrud("CategoryProduct","fas fa-list",CategoryProduct::class);
        
        
        
        

        
    }
}
