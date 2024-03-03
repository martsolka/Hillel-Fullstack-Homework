<?php
class Order
{
  /** @var CartItem[] */
  protected array $products = [];
  protected string $number;
  protected DateTime $createdAt;
  protected string $status;

  public function __construct()
  {
    $this->number = uniqid('o-');
    $this->createdAt = new DateTime('now', new DateTimeZone('Europe/Kiev'));
    $this->status = 'Placed';
  }

  public function addProduct(CartItem $cartItem): void
  {
    $productId = $cartItem->getData()['productId'];
    if (!isset($this->products[$productId])) {
      $this->products[$productId] = $cartItem;
    }
  }

  public function removeProduct(string $productId): void
  {
    if (isset($this->products[$productId])) {
      unset($this->products[$productId]);
    }
  }

  public function calculateTotal(): float
  {
    return array_reduce($this->products, fn ($acc, $item) => $acc + $item->getData()['totalPrice'], 0);
  }

  public function updateStatus(string $status): void
  {
    if (in_array($status, ['Placed', 'Processing', 'Delivered', 'Cancelled'])) {
      $this->status = $status;
    }
  }

  public function getSummary(): array
  {
    return [
      'number' => $this->number,
      'createdAt' => $this->createdAt->format('d.m.Y H:i'),
      'status' => $this->status,
      'total' => $this->calculateTotal(),
      'productsData' => array_map(fn ($item) => $item->getData(), $this->products),
    ];
  }
}
