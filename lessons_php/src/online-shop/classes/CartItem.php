<?php
class CartItem
{
  protected Product $product;
  protected float $quantity;

  public function __construct(Product $product, float $quantity)
  {
    $this->product = $product;
    $this->quantity = $quantity;
  }

  public function setQuantity(float $value): void
  {
    if ($value > 0 && $value <= 15) {
      $this->quantity = $value;
    }
  }

  public function increaseQuantity(float $value): void
  {
    $this->setQuantity($this->quantity + $value);
  }

  public function getData(): array
  {
    return [
      'productId' => $this->product->getData()['uuid'],
      'product' => $this->product,
      'quantity' => $this->quantity,
      'totalPrice' => $this->product->getData()['price'] * $this->quantity
    ];
  }
}
