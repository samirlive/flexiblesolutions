<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PromotionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
