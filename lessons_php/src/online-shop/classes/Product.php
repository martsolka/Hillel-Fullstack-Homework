<?php
class Product
{
  protected string $uuid;
  protected string $name;
  protected float $price;
  protected ?string $image;

  public function __construct(string $name, string $image = null)
  {
    $this->uuid = uniqid("product_");
    $this->name = $name;
    $this->price = 0;
    $this->image = $image;
  }

  public function setPrice(float $price): Product
  {
    $this->price = $price;
    return $this;
  }

  public function setImage(string $image): Product
  {
    $this->image = $image;
    return $this;
  }

  public function getData(): array
  {
    return [
      'uuid' => $this->uuid, 
      'name' => $this->name,
      'price' => $this->price, 
      'image' => $this->image
    ];
  }
}
