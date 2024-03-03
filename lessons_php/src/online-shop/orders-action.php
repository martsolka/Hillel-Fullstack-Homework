<?php require_once('./includes.php');
$ordersManager = new OrdersSessionManager();
/**
 * REMOVE PRODUCT FROM ORDER
 */
if (isset($_POST['remove-from-order'])) {
  [$orderNumber, $productId] = [array_key_first($_POST['remove-from-order']), array_values($_POST['remove-from-order'])[0]];

  if ($ordersManager->removeProduct($orderNumber, $productId)) {
    $_SESSION['alert']['info'] = "🛈 Product removed from order #{$orderNumber}.";
  }
}
/**
 * CANCEL ORDER
 */
if (isset($_POST['cancel-order'])) {
  $orderNumber = $_POST['cancel-order'];

  if ($ordersManager->updateStatus($orderNumber, 'Cancelled')) {
    $_SESSION['alert']['info'] = "🛈 Order #{$orderNumber} cancelled.";
  }
}
/**
 * DELETE ORDER
 */
if (isset($_POST['delete-order'])) {
  $orderNumber = $_POST['delete-order'];

  if ($ordersManager->remove($orderNumber)) {
    $_SESSION['alert']['info'] = "🛈 Order #{$orderNumber} deleted from your history.";
  }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
