<?php
session_start();
require_once('functions.php');

if (isset($_SESSION['is_auth'])) {
  redirect('home-private.php');
}

$validationRules = [
  'name' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'Name is required'
    ],
    [
      'check' => function ($value) {
        return mb_strlen($value) < 3;
      },
      'error_msg' => 'Name must be at least 3 characters'
    ],
    [
      'check' => function ($value) {
        return mb_strlen($value) > 255;
      },
      'error_msg' => 'Name must be less than 255 characters'
    ]
  ],
  'email' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'Email is required'
    ],
    [
      'check' => function ($value) {
        return !filter_var($value, FILTER_VALIDATE_EMAIL);
      },
      'error_msg' => 'Enter a valid email.'
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
        return mb_strlen($value) < 8;
      },
      'error_msg' => 'Password must be at least 8 characters'
    ],
    [
      'check' => function ($value) {
        return !preg_match('/^[a-zA-Z0-9]+$/', $value);
      },
      'error_msg' => 'Password must include only letters and numbers'
    ]
  ],
  'country' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'Please select your country'
    ]
  ],
  'gender' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'Please select your gender'
    ]
  ],
  'terms' => [
    [
      'check' => function ($value) {
        return empty($value);
      },
      'error_msg' => 'You must agree with the terms and conditions'
    ]
  ]
];

[$fields, $errors] = resetFormFields($validationRules);
$result_alert = ['status' => null, 'message' => null];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  validateForm($validationRules, $fields, $errors);

  if (empty(array_filter($errors))) {
    $result_alert = ['status' => 'success', 'message' => 'Form submitted successfully!🎉'];
    [$fields, $errors] = resetFormFields($validationRules);
  } else {
    $result_alert = ['status' => 'danger', 'message' => 'Form submission failed 😕. Please check the errors below.'];
  }
}

$pageTitle = 'Registration Page';
require_once('page-head.php');
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-hidden">
  <main class="flex-grow-1">
    <div class="container h-100 position-relative">
      <div class="row h-100">
        <div class="col-11 col-sm-10 col-md-7 col-lg-5 col-xl-4 m-auto">
          <div class="card overflow-hidden">
            <div class="card-header p-0 text-center small">
              <small class="d-block bg-gradient text-muted fw-medium py-1 mb-1">🌟 Welcome to our platform 🌟</small>
              <h1 class="card-title fs-2 lh-1">Create An Account</h1>
              <p class="text-body-secondary lh-1">Fill in the form below to get started 🚀</p>
            </div>
            <div class="card-body">
              <?php if ($result_alert['status']) : ?>
                <div class="alert alert-<?= $result_alert['status'] ?> py-1 hstack justify-content-between" role="alert"><?= $result_alert['message'] ?>
                  <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <form class="d-grid gap-2" action="signup.php" method="POST" novalidate>
                <div class="row">
                  <label for="name" class="col col-form-label fw-medium">Name:</label>
                  <div class="col-6 flex-fill">
                    <input type="text" class="form-control <?= validationClass('name', $errors) ?>" id="name" name="name" value="<?= $fields['name'] ?>" required>
                    <?= displayError('name', $errors) ?>
                  </div>
                </div>
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
                <div class="row">
                  <label for="country" class="col col-form-label fw-medium">Country:</label>
                  <div class="col-6 flex-fill">
                    <select class="form-select <?= validationClass('country', $errors) ?>" id="country" name="country" required>
                      <option value="">Select ...</option>
                      <?php foreach ([
                        'ca' => 'Canada',
                        'fr' => 'France',
                        'de' => 'Germany',
                        'it' => 'Italy',
                        'uk' => 'Ukraine',
                        'us' => 'United States',
                        'other' => 'Other',
                      ] as $key => $value) : ?>
                        <option value="<?= $key ?>" <?php if ($fields['country'] == $key) echo 'selected' ?>>
                          <?= $value ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <?= displayError('country', $errors) ?>
                  </div>
                </div>
                <div class="row align-items-center">
                  <label for="gender" class="col col-form-label fw-medium">Gender:</label>
                  <div class="col-6 flex-fill">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input <?= validationClass('gender', $errors) ?>" type="radio" name="gender" id="gender-male" value="male" required <?php if ($fields['gender'] == 'male') echo 'checked' ?>>
                      <label class="form-check-label" for="gender-male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input <?= validationClass('gender', $errors) ?>" type="radio" name="gender" id="gender-female" value="female" required <?php if ($fields['gender'] == 'female') echo 'checked' ?>>
                      <label class="form-check-label" for="gender-female">Female</label>
                      <?= displayError('gender', $errors) ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-auto">
                    <div class="form-check small">
                      <input class="form-check-input <?= validationClass('terms', $errors) ?>" type="checkbox" name="terms" id="terms" value="1" required <?php if ($fields['terms'] == '1') echo 'checked' ?>>
                      <label class="form-check-label small" for="terms">I agree to the <a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover fw-semibold" href="#">Terms and Conditions</a></label>
                      <?= displayError('terms', $errors) ?>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-success bg-gradient fw-medium mt-2">Register Now </button>
              </form>
            </div>
            <div class="card-footer py-1 text-center">
              <span class="small text-muted">
                Already a member?
                <a href="signin.php" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover fw-semibold">
                  Sign In
                </a>
              </span>
            </div>
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