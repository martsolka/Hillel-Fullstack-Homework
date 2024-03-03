<?php
class ProductsSessionManager extends SessionManager
{
  protected array $products;

  public function __construct()
  {
    parent::__construct('products');
    $this->products = $this->load() ?? $this->getDefault();
  }

  public function add(Product $product): void
  {
    if (!isset($this->products[$product->getData()['uuid']])) {
      $this->products[$product->getData()['uuid']] = $product;
      $this->save($this->products);
    }
  }

  public function getAll(): array
  {
    return $this->products;
  }

  public function get(string $productId): ?Product
  {
    foreach ($this->products as $product) {
      if ($product->getData()['uuid'] === $productId) {
        return $product;
      }
    }
    return null;
  }

  protected function getDefault(): array
  {
    $data = [['Banana', 'banana.jpg'], ['Red Apple', 'red-apple.jpg'], ['Carrot', 'carrot.jpg'], ['Cucumber', 'cucumber.jpg'], ['Onion', 'onion.jpg'], ['Potato', 'potato.jpg'], ['Tomato (cherry)', 'cherry-tomato.jpg'], ['Lemon', 'lemon.jpg'], ['Grapes', 'grapes.jpg'], ['Avocado', 'avocado.jpg'], ['Strawberry', 'strawberry.jpg']];
    $products = [];

    foreach ($data as [$name, $imgName]) {
      $imageUrl = '/online-shop/img/' . $imgName;
      $product = new Product($name, $imageUrl);
      $product->setPrice(rand(100, 500) / 100);
      $products[] = $product;
    }
    $this->save($products);
    return $products;
  }
}
