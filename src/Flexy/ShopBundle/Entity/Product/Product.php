<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Order\OrderItem;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Table(name="product")
 * @Entity
 * @InheritanceType("JOINED")
 */
#[ApiResource]
class Product
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=CategoryProduct::class, inversedBy="products",cascade={"persist"})
     */
    private $categoriesProduct;

    /**
     * @ORM\OneToMany(targetEntity=AttributValue::class, mappedBy="product", cascade={"persist"})
     */
    private $attributValues;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $oldPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metaTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metaDescription;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $metaKeywords = [];

    /**
     * @ORM\OneToMany(targetEntity=ImageProduct::class, mappedBy="product", cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"name"})
    */
    
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ProductVariant::class, mappedBy="product",cascade={"persist"})
     */
    private $productVariants;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPriceReducedPerPercent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $percentReduction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skuCode;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="product")
     */
    private $orderItems;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="products")
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity=Vendor::class, inversedBy="products")
     */
    private $vendor;


    public function __construct()
    {
        $this->categoriesProduct = new ArrayCollection();
        $this->attributValues = new ArrayCollection();
        $this->productType = "simple";
        $this->createdAt = new \DateTimeImmutable();
        $this->images = new ArrayCollection();
        $this->productVariants = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
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


    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    /**
     * Get the value of image
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|CategoryProduct[]
     */
    public function getCategoriesProduct(): Collection
    {
        return $this->categoriesProduct;
    }

    public function addCategoryProduct(CategoryProduct $categoryProduct): self
    {
        if (!$this->categoriesProduct->contains($categoryProduct)) {
            $this->categoriesProduct[] = $categoryProduct;
            $categoryProduct->addProduct($this);
        }

        return $this;
    }

    public function removeCategoryProduct(CategoryProduct $categoryProduct): self
    {
        if ($this->categoriesProduct->removeElement($categoryProduct)) {
            $categoryProduct->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|AttributValue[]
     */
    public function getAttributValues(): Collection
    {
        return $this->attributValues;
    }

    public function addAttributValue(AttributValue $attributValue): self
    {
        if (!$this->attributValues->contains($attributValue)) {
            $this->attributValues[] = $attributValue;
            $attributValue->setProduct($this);
        }

        return $this;
    }

    public function removeAttributValue(AttributValue $attributValue): self
    {
        if ($this->attributValues->removeElement($attributValue)) {
            // set the owning side to null (unless already changed)
            if ($attributValue->getProduct() === $this) {
                $attributValue->setProduct(null);
            }
        }

        return $this;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function setOldPrice(?float $oldPrice): self
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProductType(): ?string
    {
        return $this->productType;
    }

    public function setProductType(?string $productType): self
    {
        $this->productType = $productType;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaKeywords(): ?array
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?array $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return Collection|ImageProduct[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImageProduct $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(ImageProduct $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|ProductVariant[]
     */
    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    public function addProductVariant(ProductVariant $productVariant): self
    {
        if (!$this->productVariants->contains($productVariant)) {
            $this->productVariants[] = $productVariant;
            $productVariant->setProduct($this);
        }

        return $this;
    }

    public function removeProductVariant(ProductVariant $productVariant): self
    {
        if ($this->productVariants->removeElement($productVariant)) {
            // set the owning side to null (unless already changed)
            if ($productVariant->getProduct() === $this) {
                $productVariant->setProduct(null);
            }
        }

        return $this;
    }

    public function getIsPriceReducedPerPercent(): ?bool
    {
        return $this->isPriceReducedPerPercent;
    }

    public function setIsPriceReducedPerPercent(?bool $isPriceReducedPerPercent): self
    {
        $this->isPriceReducedPerPercent = $isPriceReducedPerPercent;

        return $this;
    }

    public function getPercentReduction(): ?float
    {
        return $this->percentReduction;
    }

    public function setPercentReduction(?float $percentReduction): self
    {
        $this->percentReduction = $percentReduction;

        return $this;
    }

    public function getSkuCode(): ?string
    {
        return $this->skuCode;
    }

    public function setSkuCode(?string $skuCode): self
    {
        $this->skuCode = $skuCode;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }


    public function getFormattedPrice(){
        return $this->price / 100;
    }

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }



}
