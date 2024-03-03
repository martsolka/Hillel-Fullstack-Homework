<?php
session_start();
require_once('functions.php');

if (isset($_SESSION['is_auth'])) {
  redirect('home-private.php');
}

$demoAccount = [
  'email' => 'demo123@gmail',
  'password' => '65d4f620',
];

$validationRules = [
  'email' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'Email is required'
    ],
    [
      'check' => function ($value) {
        global $demoAccount;
        return $value !== $demoAccount['email'];
      },
      'error_msg' => 'Email is not registered',
    ]
  ],
  'password' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'Password is required'
    ],
    [
      'check' => function ($value) {
        global $demoAccount;
        return $value !== $demoAccount['password'];
      },
      'error_msg' => 'Password is incorrect'
    ],
  ]
];

[$fields, $errors] = resetFormFields($validationRules);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  validateForm($validationRules, $fields, $errors);

  if (empty(array_filter($errors))) {
    $_SESSION['is_auth'] = true;
    [$fields, $errors] = resetFormFields($validationRules);
    redirect();
  }
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
                    <input type="email" class="form-control <?= validationClass('email', $errors) ?>" id="email" name="email" value="<?= $fields['email'] ?>" required>
                    <?= displayError('email', $errors) ?>
                  </div>
                </div>
                <div class="row">
                  <label for="password" class="col col-form-label fw-medium">Password:</label>
                  <div class="col-6 flex-fill">
                    <input type="password" class="form-control <?= validationClass('password', $errors) ?>" id="password" name="password">
                    <?= displayError('password', $errors) ?>
                  </div>
                </div>
                <button type="submit" class="btn btn-success bg-gradient fw-medium mt-2">Access Account</button>
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
              <li class="list-group-item flex-grow-1">📧Email: <strong><?= $demoAccount['email'] ?></strong></li>
              <li class="list-group-item flex-grow-1">🔐Password: <strong><?= $demoAccount['password'] ?></strong></li>
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