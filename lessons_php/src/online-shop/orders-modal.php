<div class="modal fade" id="orders" tabindex="-1" aria-labelledby="ordersLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content backdrop-filter">
      <div class="modal-header">
        <h5 class="modal-title" id="ordersLabel">📃 My Orders</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if (count($orders)) : ?>
          <div class="accordion" id="accordionOrders">
            <form action="./orders-action.php" method="post">
              <?php foreach ($orders as $order) : ?>
                <?php /** @var Order $order */
                [
                  'number' => $number,
                  'createdAt' => $created,
                  'status' => $status,
                  'total' => $total,
                  'productsData' => $productsData
                ] = $order->getSummary();
                ?>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $number ?>" aria-expanded="false" aria-controls="collapse<?= $number ?>">
                      <span class="fw-medium">Order #<?= $number ?></span>
                      <span class="vr mx-2"></span>
                      <small class="opacity-75">
                        <small>Created: <?= $created ?></small>
                      </small>
                    </button>
                  </h2>
                  <div id="collapse<?= $number ?>" class="accordion-collapse collapse" data-bs-parent="#accordionOrders">
                    <div class="accordion-body px-0 py-1">
                      <ul class="list-group list-group-flush">
                        <?php foreach ($productsData as $productId => $productData) : ?>
                          <?php
                          [
                            'quantity' => $quantity,
                            'totalPrice' => $subtotal,
                            'product' => $product
                          ] = $productData;
                          [
                            'uuid' => $uuid,
                            'name' => $name,
                            'price' => $price,
                            'image' => $image
                          ] = $product->getData();
                          ?>
                          <li class="list-group-item hstack gap-3 bg-transparent">
                            <div class="col-2">
                              <img class="img-fluid rounded" src="<?= $image ?>" alt="<?= $name ?>">
                            </div>
                            <div class="col small">
                              <a class="link-body-emphasis stretched-link fw-medium" href="#?<?= $uuid ?>"><?= $name ?></a>
                              <span class="d-block opacity-75 mt-1"><?= $quantity ?>kg x $<?= $price ?></span>
                            </div>
                            <div class="col-2 z-3">
                              <p class="text-center mb-0 lh-1 fw-medium">$<?= $subtotal ?></p>
                              <button class="btn link-danger border-0 w-100" type="submit" name="remove-from-order[<?= $number ?>]" value="<?= $uuid ?>" <?php if ($status !== 'Placed') echo 'disabled' ?>>Remove</button>
                            </div>
                          </li>
                        <?php endforeach; ?>
                        <li class="list-group-item hstack gap-2 bg-transparent">
                          <small>
                            <small class="opacity-75 me-1">Total:</small>
                            <strong>$<?= $total ?></strong>
                          </small>
                          <span class="vr my-1"></span>
                          <small>
                            <small class="opacity-75 me-1">Status:</small>
                            <strong><?= $status ?></strong>
                          </small>
                          <span class="vr my-1"></span>
                          <?php if ($status === 'Placed') : ?>
                            <a class="btn bg-success bg-gradient bg-opacity-25 link-body-emphasis fw-medium" href="#">Checkout</a>
                            <span class="vr my-1"></span>
                            <button class="btn bg-danger bg-gradient bg-opacity-25 link-body-emphasis fw-medium flex-fill" type="submit" name="cancel-order" value="<?= $number ?>">Cancel</button>
                          <?php else : ?>
                            <button class="btn bg-secondary bg-gradient bg-opacity-25 link-body-emphasis fw-medium flex-fill" type="submit" name="delete-order" value="<?= $number ?>">Delete From History</button>
                          <?php endif; ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </form>
          </div>
        <?php else : ?>
          <p class="text-center text-muted lead">🙈 No orders yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>