<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;

use App\Flexy\ShopBundle\Entity\Product\AttributValue;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use App\Flexy\ShopBundle\Form\ImageProductType;
use App\Flexy\ShopBundle\Form\Product\AttributValueType;
use App\Flexy\ShopBundle\Form\Product\ProductVariantType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;



use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }



    
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {

        $em = $this->getDoctrine()->getManager();

        

        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);



        $vendor = $em->getRepository(Vendor::class)->findOneBy(["user"=>$this->getUser()]);
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere("entity.vendor = :vendor");
        $response->setParameter("vendor",$vendor);
        return $response;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Details de produit'),
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name',"Nom de produit"),
            TextField::new('skuCode',"Code SKU"),
            ChoiceField::new('productType',"Type de produit")->setChoices(
                [
                    "Simple"=>"simple",
                    "Produit Variable"=>"variable"
                ]
            ),
            ImageField::new('image',"Image principale")->setUploadDir("public/uploads")->setBasePath("/uploads"),
            TextEditorField::new('description'),

            FormField::addTab('Tarification'),
            MoneyField::new('price',"Prix de vente")->setCurrency("MAD"),
            MoneyField::new('oldPrice',"Ancien prix")->setCurrency("MAD"),
            AssociationField::new("promotion"),
            BooleanField::new('isPriceReducedPerPercent',"Réduction pourcentage"),
            PercentField::new('percentReduction',"Reduction prix"),
            NumberField::new('quantity',"Stock disponible"),
            
            FormField::addTab('Associations'),
            AssociationField::new('categoriesProduct',"Categories"),
            CollectionField::new('attributValues')->setEntryType(AttributValueType::class)->setEntryIsComplex(true),
            
            FormField::addTab('Section SEO'),
            TextField::new('metaTitle'),
            TextareaField::new('metaDescription'),
            ArrayField::new('metaKeywords'),
            
            FormField::addTab('Gallerie images'),
            CollectionField::new('images')->setEntryType(ImageProductType::class),
            
            FormField::addTab('Variations de produit'),
            CollectionField::new('productVariants',"Ajouter des variations produit")->setEntryType(ProductVariantType::class)->setEntryIsComplex(true),
        ];
    }
    
}