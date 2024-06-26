<?php require_once('users-crud/includes.php');

AuthManager::goTo('/signin.php', !AuthManager::isSignedIn());
AuthManager::handleSignOut();

$currentUser = AuthManager::currentUser();
$pageTitle = 'Home | Private Page';

require_once('page-head.php');
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-y-auto">
  <div class="container-lg h-100 py-3">
    <div class="card h-100 shadow-lg">
      <header class="card-header hstack justify-content-between">
        <strong>Header</strong>
        <?php require_once('theme-switch.php'); ?>
      </header>
      <main class="card-body vstack h-100">
        <strong>Content</strong>
        <div class="m-auto text-body-secondary text-center">
          <h1>Welcome Back, <?= $currentUser['name'] ?>!</h1>
          <p class="lead">This is a private area. You can only see this if you are logged in <strong class="text-body">as <?= Role::fromValue($currentUser['role'])->label() ?></strong>.</p>
          <?php if (AuthManager::hasRole(Role::ROOT, Role::ADMIN)) : ?>
            <a class="btn btn-success bg-gradient fw-medium fs-5 px-4 m-2" href="/users-crud/">👨‍👩‍👦 Users CRUD&rarr;</a>
          <?php endif; ?>
          <a class="btn btn-success bg-gradient fw-medium fs-5 px-4 m-2" href="/online-shop/">🛍 Grocery Shop &rarr;</a>
        </div>
      </main>
      <footer class="card-footer hstack justify-content-between">
        <strong>Footer</strong>
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="?signout">Sign Out &raquo;</a>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>