<?php
class CartSessionManager extends SessionManager
{
  /** @var array<string, CartItem> */
  protected array $cartItems;

  public function __construct()
  {
    parent::__construct('cart');
    $this->cartItems = $this->load() ?? [];
  }

  public function add(CartItem $cartItem): bool
  {
    $productId = $cartItem->getData()['productId'];
    return $this->processCartItem($productId, fn () => $this->cartItems[$productId] = $cartItem, false);
  }

  public function remove(string $productId): bool
  {
    return $this->processCartItem($productId, function () use ($productId) {
      unset($this->cartItems[$productId]);
    });
  }

  public function update(string $productId, float $quantity, bool $increase = false): bool
  {
    return $this->processCartItem(
      $productId,
      fn () => $increase ? $this->cartItems[$productId]->increaseQuantity($quantity) : $this->cartItems[$productId]->setQuantity($quantity)
    );
  }

  private function processCartItem(string $productId, callable $callback, bool $expectExistence = true): bool
  {
    if (isset($this->cartItems[$productId]) === $expectExistence) {
      $callback();
      $this->save($this->cartItems);
      return true;
    }
    return false;
  }

  public function getAll(): array
  {
    return $this->cartItems;
  }

  public function get(string $productId): ?CartItem
  {
    return $this->cartItems[$productId] ?? null;
  }
}
