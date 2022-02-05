<?php 
# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\Flexy\ShopBundle\EventSubscriber;

use App\Entity\BlogPost;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Product\ProductShop;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $security;
    private $passwordEncoder;
    private $em;

    public function __construct(Security $security,UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManagerInterface)
{
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $entityManagerInterface;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['beforePersist'],
            BeforeEntityUpdatedEvent::class => ['beforeUpdated'],
        ];
    }

    public function beforePersist(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        

        if ($entity instanceof Vendor) {

            

            $entity->getUser()->setRoles(["ROLE_VENDOR"]);
            $entity->getUser()->setPassword(
                $this->passwordEncoder->encodePassword(
                         $entity->getUser(),
                         $entity->getUser()->getPassword()
             ));
             //dd($entity);
        }
        if ($entity instanceof Product ) {

            $vendor = $this->em->getRepository(Vendor::class)->findOneBy(["user"=>$this->security->getUser()]);
            
            $entity->setVendor($vendor);
           
        }

     
    }


    public function beforeUpdated(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        

        if ($entity instanceof Vendor) {
            //dd($entity->getUser()->getPassword());
            
            /*$entity->getUser()->setRoles(["ROLE_VENDOR"]);
            $entity->getUser()->setPassword(
                $this->passwordEncoder->encodePassword(
                         $entity->getUser(),
                         $entity->getUser()->getPassword()
             ));*/
        }

        if ($entity instanceof Product ) {

            $vendor = $this->em->getRepository(Vendor::class)->findOneBy(["user"=>$this->security->getUser()]);
            
            
           
        }

     
    }

}