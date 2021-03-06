<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryProduct::class;
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
