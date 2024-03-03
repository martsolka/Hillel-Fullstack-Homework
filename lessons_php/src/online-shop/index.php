<?php require_once('./includes.php');
checkAuth();
handleSignout();

$productsManager = new ProductsSessionManager();
$cartManager = new CartSessionManager();
$ordersManager = new OrdersSessionManager();

$products = $productsManager->getAll();
$productsInCart = $cartManager->getAll();
$orders = $ordersManager->getAll();

$pageTitle = 'Online Grocery Shop | Products List';
require_once('./../page-head.php');
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-y-auto">
  <div class="container-lg h-100 py-3">
    <div class="card h-100 shadow-lg">
      <header class="card-header hstack justify-content-between">
        <a class="fs-3 text-uppercase fw-medium link-body-emphasis text-decoration-none" href="/online-shop/">🥦🍐 Grocery shop</a>
        <?php require_once('./../theme-switch.php'); ?>
      </header>

      <main class="card-body vstack align-items-center h-100 overflow-y-auto">
        <h1 class="text-center mb-3">Available Products</h1>

        <?php if (!empty($_SESSION['alert'])) : ?>
          <div class="alert alert-<?= array_keys($_SESSION['alert'])[0] ?> py-1 fade show" role="alert">
            <?= array_values($_SESSION['alert'])[0] ?>
            <button type="button" class="btn-close btn-sm float-end ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['alert']); ?>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3">
          <?php foreach ($products as $product) : ?>
            <?php ['uuid' => $uuid, 'name' => $name, 'price' => $price, 'image' => $image] = $product->getData(); ?>
            <div class="col">
              <div class="card h-100">
                <img class="card-img-top flex-grow-1" src="<?= $image ?>" alt="<?= $name ?>">
                <div class="card-body row gy-2">
                  <div class="col small">
                    <h5 class="card-title"><?= $name ?></h5>
                  </div>
                  <div class="col text-end">
                    <span class="fs-5 fw-medium">$<?= $price ?></span>
                    <small class="text-muted">/ kg</small>
                  </div>
                  <div class="col-12">
                    <form action="./cart-action.php" method="post">
                      <input type="hidden" name="add" value="<?= $uuid ?>">
                      <div class="input-group flex-nowrap">
                        <input class="form-control" type="number" name="quantity" class="form-control" min="0.05" max="10" step="0.05" value="1" placeholder="Qnt">
                        <span class="input-group-text bg-transparent">kg</span>
                        <button class="btn bg-success bg-gradient bg-opacity-10 link-body-emphasis fw-medium flex-fill" type="submit">
                          Add to 🛒
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </main>

      <footer class="card-footer hstack gap-2">
        <button class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium lh-1 fs-5" type="button" data-bs-toggle="modal" data-bs-target="#orders" title="View orders">
          📃<sup>(<?= count($orders) ?>)</sup>
        </button>

        <button class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium lh-1 fs-5" type="button" data-bs-toggle="modal" data-bs-target="#cart" title="View cart">
          🛒<sup>(<?= count($productsInCart) ?>)</sup>
        </button>

        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3 ms-auto" href="?signout">Sign Out &raquo;</a>
      </footer>
    </div>
  </div>

  <?php require_once('./cart-modal.php'); ?>
  <?php require_once('./orders-modal.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>