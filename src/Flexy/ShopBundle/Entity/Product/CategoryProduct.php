<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Repository\Product\CategoryProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=CategoryProductRepository::class)
 * @Table(name="flexy_categoryproduct")

 */
#[ApiResource]
class CategoryProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="categoriesProduct",cascade={"persist"})
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryProduct::class, inversedBy="subCategories")
     */
    private $parentCategory;


    /**
     * @ORM\OneToMany(targetEntity=CategoryProduct::class, mappedBy="parentCategory")
     */
    private $subCategories;

    /**
     * @ORM\ManyToMany(targetEntity=Attribut::class, inversedBy="categoriesProduct")
     */
    private $attributes;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getParentCategory(): ?self
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?self $parentCategory): self
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

    /**
     * Get the value of subCategories
     */ 
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * Set the value of subCategories
     *
     * @return  self
     */ 
    public function setSubCategories($subCategories)
    {
        $this->subCategories = $subCategories;

        return $this;
    }

    /**
     * @return Collection|Attribut[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribut $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(Attribut $attribute): self
    {
        $this->attributes->removeElement($attribute);

        return $this;
    }
}
