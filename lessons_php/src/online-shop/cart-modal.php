<div class="modal modal-lg fade" id="cart" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <form class="modal-content backdrop-filter" action="./cart-action.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="cartLabel"> 🛒 Your Grocery Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if (count($productsInCart)) : ?>
          <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">
                    <input class="form-check-input" type="checkbox" id="selectAll" onclick="document.querySelectorAll('input[name=\'products[]\']').forEach((el) => el.checked = this.checked)">
                  </th>
                  <th style="min-width: 200px" class="text-start" scope="col">Product</th>
                  <th class="col-2" style="min-width: 120px" scope="col">Quantity</th>
                  <th scope="col">Price</th>
                  <th scope="col">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                /** @var array<string, CartItem> $productsInCart */
                $i = 1;
                ?>
                <?php foreach ($productsInCart as $productId => $cartItem) : ?>
                  <?php
                  /** @var Product $product */
                  [
                    'product' => $product,
                    'quantity' => $quantity,
                    'totalPrice' => $subtotal
                  ] = $cartItem->getData();
                  [
                    'uuid' => $uuid,
                    'name' => $name,
                    'price' => $price,
                    'image' => $image
                  ] = $product->getData();
                  ?>
                  <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td>
                      <input class="form-check-input" type="checkbox" name="products[]" value="<?= $uuid ?>">
                    </td>
                    <td class="position-relative text-start">
                      <img class="img-fluid rounded me-2 object-fit-cover" src="<?= $image ?>" alt="<?= $name ?>" width="64" height="64">
                      <a class="link-body-emphasis fw-medium stretched-link" href="#"><?= $name ?></a>
                    </td>
                    <td>
                      <div class="input-group flex-nowrap">
                        <input type="number" class="form-control bg-transparent text-center" name="quantities[<?= $uuid ?>]" value="<?= $quantity ?>" min="0.05" max="15" step="0.05">
                        <span class="input-group-text bg-transparent">kg</span>
                      </div>
                    </td>
                    <td>$<?= $price ?></td>
                    <td>$<?= $subtotal ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="6">
                    <div class="hstack gap-2">
                      <small class="text-muted me-auto text-start" colspan="6">Select ☝ products for&nbsp;actions 👉</small>
                      <button class="btn bg-success bg-gradient bg-opacity-10 link-body-emphasis fw-medium" type="submit" name="order">✔ Order Now</button>
                      <button class="btn bg-warning bg-gradient bg-opacity-10 link-body-emphasis fw-medium" type="submit" name="edit">✏ Edit Quantities</button>
                      <button class="btn bg-danger bg-gradient bg-opacity-10 link-body-emphasis fw-medium" type="submit" name="remove">❌ Remove From Cart</button>
                    </div>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        <?php else : ?>
          <p class="text-center text-muted lead">You don't have any products yet 😔</p>
        <?php endif; ?>
      </div>
    </form>
  </div>
</div>