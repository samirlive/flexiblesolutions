<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Order\OrderItem;
use App\Flexy\ShopBundle\Entity\Product\ProductShop;
use App\Flexy\ShopBundle\Repository\Customer\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Flexy\ShopBundle\Repository\Payment\PaymentMethodRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/shop/checkout')]
class CheckoutController extends AbstractController
{
    #[Route('/', name: 'checkout')]
    public function cart(PaymentMethodRepository $paymentMethodRepository): Response
    {
        $paymentMethods = $paymentMethodRepository->findBy(["isEnabled"=>true]);
        return $this->render('@Flexy\FrontBundle/templates/checkout/checkout.html.twig',[
            "paymentMethods"=>$paymentMethods
        ]);
    }

    #[Route('/confirm/ajax', name: 'confirm_checkout_ajax')]
    public function confirmChcekout(
        Request $request,
        PaymentMethodRepository $paymentMethodRepository,
        ProductFrontRepository $productFrontRepository,
        CustomerRepository $customerRepository
     ): Response
    {


        $currentUser = $this->getUser();

        if($currentUser){
            $customer = $customerRepository->findBy(["user"=>$currentUser]);
            if(!$customer){
                $customer = new Customer();
            }
        }



        $order = new Order();

        

        $order->setFirstName($request->query->get("firstName"));
        $order->setLastName($request->query->get("lastName"));
        $order->setCompanyName($request->query->get("companyName"));
        $order->setAddress($request->query->get("address"));
        $order->setCity($request->query->get("city"));
        $order->setCountry("Maroc");
        $order->setDepartment($request->query->get("department"));
        $order->setPostcode($request->query->get("postcode"));
        $order->setEmail($request->query->get("email"));
        $order->setTel($request->query->get("tel"));
        $order->setComment($request->query->get("comment"));
        foreach((array)$request->query->get("orderItems") as $singleOrderItem){
            $orderItem = new OrderItem();
            $product = $productFrontRepository->find((int)$singleOrderItem["id"]);
            $orderItem->setProduct($product);
            $orderItem->setPrice($product->getPrice());
            $orderItem->setQuantity($singleOrderItem["quantity"]);
            $order->addOrderItem($orderItem);
        }

        $customer->setFirstName($request->query->get("firstName"));
        $customer->setLastName($request->query->get("lastName"));
        $customer->setAddress($request->query->get("address"));
        $customer->setEmail($request->query->get("email"));
        $customer->setCompanyName($request->query->get("companyName"));
        $customer->setPhone($request->query->get("tel"));

        $order->setCustomer($customer);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();
        



        $paymentMethods = $paymentMethodRepository->findBy(["isEnabled"=>true]);
        return $this->render('@Flexy\FrontBundle/templates/checkout/ajax/_paymentResult.html.twig',[
            "order"=>$order
        ]);
    }

}
