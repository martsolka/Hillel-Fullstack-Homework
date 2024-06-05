<?php require_once('users-crud/includes.php');

AuthManager::goTo('/home-private.php', AuthManager::isSignedIn());
AuthManager::handleSignOut();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  AuthManager::goTo('/home-private.php', AuthManager::signIn($_POST));
}

$pageTitle = 'Authorization Page';
require_once('page-head.php');
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-y-auto">
  <main class="flex-grow-1">
    <div class="container h-100 position-relative">
      <div class="row h-100">
        <div class="col-11 col-sm-10 col-md-7 col-lg-5 col-xl-4 py-3 m-auto">
          <div class="card overflow-hidden">
            <div class="card-header p-0 text-center small">
              <small class="d-block bg-gradient text-muted fw-medium py-1 mb-1">🌟 Welcome back 🌟</small>
              <h1 class="card-title fs-2 lh-1">Sign In</h1>
              <p class="text-body-secondary lh-1">Enter your credentials below to get access 🚀</p>
            </div>
            <div class="card-body">
              <form class="d-grid gap-2" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" novalidate>
                <div class="row">
                  <label for="email" class="col col-form-label fw-medium">Email:</label>
                  <div class="col-6 flex-fill">
                    <input type="email" class="form-control <?= FormValidator::hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= FormValidator::value('email') ?>" required>
                    <div class="invalid-feedback" role="alert"><?= FormValidator::error('email') ?></div>
                  </div>
                </div>
                <div class="row">
                  <label for="password" class="col col-form-label fw-medium">Password:</label>
                  <div class="col-6 flex-fill">
                    <input type="password" class="form-control <?= FormValidator::hasError('password') ? 'is-invalid' : '' ?>" name="password" required>
                    <div class="invalid-feedback" role="alert"><?= FormValidator::error('password') ?></div>
                  </div>
                </div>
                <button type="submit" class="btn btn-success bg-gradient fw-medium mt-2">Access Account</button>
                <?php FormValidator::clearErrors() ?>
              </form>
            </div>
            <div class="card-footer py-1 text-center">
              <span class="small text-muted">
                New to this website?
                <a href="signup.php" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover fw-semibold">
                  Sign Up
                </a>
              </span>
            </div>
          </div>
          <div class="card card-body small my-2">
            <h2 class="fs-6 mb-1">Demo Account</h2>
            <p class="text-muted small mb-1">Use this credentials for quick testing:</p>
            <ul class="list-group list-group-horizontal small">
              <li class="list-group-item flex-grow-1">📧Email: <strong><?= UserModel::DEFAULT_ADMIN['email'] ?></strong></li>
              <li class="list-group-item flex-grow-1">🔐Password: <strong><?= UserModel::DEFAULT_ADMIN['password'] ?></strong></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="position-absolute top-0 end-0 m-3 m-lg-5 z-3">
        <?php require_once('theme-switch.php'); ?>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>