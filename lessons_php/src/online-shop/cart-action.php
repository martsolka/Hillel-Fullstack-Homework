<?php require_once('./includes.php');
$cartManager = new CartSessionManager();
/**
 * ADD PRODUCT(s) TO CART OR UPDATE QUANTITY IF ALREADY IN CART 
 */
if (isset($_POST['add'])) {
  $productId = $_POST['add'];
  $quantity = $_POST['quantity'];

  $productsManager = new ProductsSessionManager();
  $targetProduct = $productsManager->get($productId);

  if ($targetProduct) {
    if (!$cartManager->add(new CartItem($targetProduct, $quantity))) {
      if ($cartManager->update($productId, $quantity, true)) {
        $_SESSION['alert']['info'] = "🛈 Product '" . $targetProduct->getData()['name'] . "' quantity updated in your cart!";
      }
    } else {
      $_SESSION['alert']['success'] = "✔ Product '" . $targetProduct->getData()['name'] . "' added to your cart!";
    }
  }
}
/**
 * REMOVE PRODUCT(s) FROM CART
 */
if (isset($_POST['remove'])) {
  $productIds = $_POST['products'] ?? [];

  if (empty($productIds)) {
    $_SESSION['alert']['warning'] = '⚠️ Nothing to remove... Please select products to remove from cart.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  $i = count($productIds);

  foreach ($productIds as $productId) {
    if ($cartManager->remove($productId)) {
      $i--;
    }
  }

  if ($i === 0) {
    $_SESSION['alert']['success'] = '✔ ' . count($productIds) . ' selected products removed from your cart!';
  }
}
/**
 * UPDATE PRODUCT(s) QUANTITY
 */
if (isset($_POST['edit'])) {
  $productIds = $_POST['products'] ?? [];

  if (empty($productIds)) {
    $_SESSION['alert']['warning'] = '⚠️ Nothing to update... Please select products to update quantity in your cart.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  $i = count($productIds);

  foreach ($productIds as $productId) {
    $quantity = floatval($_POST['quantities'][$productId]);
    if ($cartManager->update($productId, $quantity)) {
      $i--;
    }
  }

  if ($i === 0) {
    $_SESSION['alert']['success'] = '✔ Quantity updated for ' . count($productIds) . ' selected products in your cart!';
  }
}
/**
 * PLACE ORDER WITH SELECTED PRODUCT(s) AND CLEAR CART
 */
if (isset($_POST['order'])) {
  $productIds = $_POST['products'] ?? [];

  if (empty($productIds)) {
    $_SESSION['alert']['warning'] = '⚠️ Nothing to order... Please select products from your cart.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  $ordersManager = new OrdersSessionManager();
  $order = new Order();
  $i = count($productIds);

  foreach ($productIds as $productId) {
    $product = $cartManager->get($productId);
    if ($product) {
      $order->addProduct($product);
      $cartManager->remove($productId);
      $i--;
    }
  }

  if ($i === 0 && $ordersManager->add($order)) {
    $_SESSION['alert']['success'] = '✔ Order placed successfully. You can see it in your orders history.';
  }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
