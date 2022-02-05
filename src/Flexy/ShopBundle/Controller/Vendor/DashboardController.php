<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;

use App\Flexy\ShopBundle\Controller\Vendor\ProductCrudController;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\CategoryProductShop;
use App\Flexy\ShopBundle\Entity\Promotion\Coupon;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Payment\PaymentMethod;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use App\Flexy\ShopBundle\Entity\Shipping\ShippingMethod;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Flexy\ShopBundle\Controller\Vendor\ProductCrudController as VendorProductCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;



/**
     * @Route("/vendor/admin")
     * @IsGranted("ROLE_VENDOR")
     */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="shop_vendor")
     * @IsGranted("ROLE_VENDOR")
     */
    public function index(): Response
    {
        return parent::index();
    }




    public function configureDashboard(): Dashboard
    {

        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneBy(["user"=>$this->getUser()]);


        if($vendor){
            $urlImage ="../uploads/".$vendor->getImage();

        }else{
            $urlImage ="../omall/logo.png";
        }
        
        return Dashboard::new()

        ->setTitle('
        <img  style="margin:10px 0 0px 20px" src="/omall/logo.png" width="130px" />
        <img  style="margin:0 0 0 35px" src="'.$urlImage.'" width="120px" />
        ')
       // ->setFaviconPath('flexy/img/favicon-flexy-white.png')
        ->setTranslationDomain('admin')
        
        
        ;
    }

    public function configureMenuItems(): iterable
    {

        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneBy(["user"=>$this->getUser()]);
        yield MenuItem::section('Market Place');
        yield MenuItem::linkToCrud("Mes commandes","fas fa-list",Order::class);


        yield MenuItem::section('Marketing');

        yield MenuItem::section('Parametres boutique');

        yield MenuItem::linkToCrud("Mes produits","fas fa-list",Product::class)->setController(VendorProductCrudController::class);
        yield MenuItem::linkToCrud("Mes promotions","fas fa-list",Promotion::class);
        yield MenuItem::linkToCrud("Coupons","fas fa-list",Coupon::class);
        yield MenuItem::linkToCrud("Mes Commandes","fas fa-list",Order::class);
        yield MenuItem::linkToCrud("livraisons","fas fa-list",ShippingMethod::class);
        if($vendor){
            yield MenuItem::linkToCrud("Editer mon profil","fas fa-list",Vendor::class)->setController(VendorCrudController::class)->setAction('edit')->setEntityId($vendor->getId());
        }
        
        //yield MenuItem::linkToCrud("Modes paiements","fas fa-list",PaymentMethod::class);

        



        if($vendor){
            yield MenuItem::linkToRoute('Ma boutique', 'fas fa-eye',"single_vendor", ['id' => $vendor->getId()]);
        }
        
    }
}
