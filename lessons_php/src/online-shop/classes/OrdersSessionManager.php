<?php
class OrdersSessionManager extends SessionManager
{
  /** @var array<string, Order> */
  protected array $orders;
  public function __construct()
  {
    parent::__construct('orders');
    $this->orders = $this->load() ?? [];
  }

  public function add(Order $order): bool
  {
    $orderNumber = $order->getSummary()['number'];
    return $this->processOrder($orderNumber, fn () => $this->orders[$orderNumber] = $order, false);
  }

  public function updateStatus(string $orderNumber, string $status): bool
  {
    return $this->processOrder($orderNumber, fn () => $this->orders[$orderNumber]->updateStatus($status));
  }

  public function removeProduct(string $orderNumber, string $productId): bool
  {
    return $this->processOrder($orderNumber, fn () => $this->orders[$orderNumber]->removeProduct($productId));
  }

  public function remove(string $orderNumber): bool
  {
    return $this->processOrder($orderNumber, function () use ($orderNumber) {
      unset($this->orders[$orderNumber]);
    });
  }

  private function processOrder(string $orderNumber, callable $action, bool $expectExistence = true): bool
  {
    if (isset($this->orders[$orderNumber]) === $expectExistence) {
      $action();
      $this->save($this->orders);
      return true;
    }
    return false;
  }

  public function getAll(): array
  {
    return $this->orders;
  }
}
