<?php require_once('includes.php');

AuthManager::goTo('/home-private.php', !AuthManager::hasRole(Role::ROOT, Role::ADMIN));
AuthManager::handleSignOut();

$id = $_GET['id'] ?? -1;
$userModel = new UserModel();

if ($userModel->isDefaultAdmin($_GET)) {
  $_SESSION['alert'] = ['content' => "❌ You can't update the default admin!", 'type' => 'danger'];
  AuthManager::goTo('/users-crud/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)$_POST['id'];
  $isUpdated = $userModel->update($id, $_POST);

  if ($isUpdated) {
    $_SESSION['alert'] = ['content' => "✔ User (ID: $id) updated successfully!", 'type' => 'success'];
    AuthManager::reAuthUser($id);
  }
}else {
  $user = $userModel->read((int)$id);
  FormValidator::setData($user);
  AuthManager::goTo('/404.php', !$user);
}

$pageTitle = 'Users CRUD | Update User';
require_once('./../page-head.php');
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-y-auto">
  <?php require_once('html/loader.php') ?>
  <div class="container-lg h-100 py-3">
    <div class="card h-100 shadow-lg">
      <header class="card-header hstack justify-content-between">
        <a class="fs-3 fw-medium link-body-emphasis text-decoration-none" href="/users-crud/">👪 Users CRUD</a>
        <?php require_once('./../theme-switch.php'); ?>
      </header>
      <main class="card-body h-100 overflow-y-auto">
        <div class="row my-3">
          <div class="col-12 text-center">
            <h1>Update User</h1>
            <p class="lead text-body-secondary">
              Edit fields values in the form below to update the data for the selected user in the database.
            </p>
            <?php require_once('html/alert.php'); ?>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-lg-8">
            <form class="row justify-content-center gy-4 small" id="user-form" action="update.php" method="POST" novalidate>
              <input type="hidden" name="id" value="<?= $id ?>">
              <fieldset class="col-12 col-md">
                <legend class="h5 p-2 bg-gradient rounded-top border border-bottom-0 mb-0">Personal Information</legend>
                <div class="d-grid gap-2 p-2 border rounded-bottom">
                  <div class="row">
                    <label for="name" class="col col-form-label fw-medium">Name:</label>
                    <div class="col-6 flex-grow-1">
                      <input type="text" class="form-control <?= FormValidator::hasError('name') ? 'is-invalid' : '' ?>" value="<?= FormValidator::value('name') ?>" id="name" name="name" placeholder="e.g. John Doe" required>
                      <div class="invalid-feedback" role="alert"><?= FormValidator::error('name') ?></div>
                    </div>
                  </div>
                  <div class="row">
                    <label for="country" class="col col-form-label fw-medium">Country:</label>
                    <div class="col-6 flex-grow-1">
                      <select class="form-select <?= FormValidator::hasError('country') ? 'is-invalid' : '' ?>" id="country" name="country">
                        <option value="">Choose...</option>
                        <?php foreach (Country::cases() as $country) : ?>
                          <option value="<?= $country->value ?>" <?= FormValidator::value('country') === $country->value ? 'selected' : '' ?>><?= $country->label() ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="invalid-feedback" role="alert"><?= FormValidator::error('country') ?></div>
                    </div>
                  </div>
                  <div class="row">
                    <label for="dob" class="col col-form-label fw-medium">Date of Birth:</label>
                    <div class="col-6 flex-grow-1">
                      <input type="date" class="form-control <?= FormValidator::hasError('date_of_birth') ? 'is-invalid' : '' ?>" id="dob" name="date_of_birth" placeholder="yyyy-mm-dd" value="<?= FormValidator::value('date_of_birth') ?>">
                      <div class="invalid-feedback" role="alert"><?= FormValidator::error('date_of_birth') ?></div>
                    </div>
                  </div>
                  <fieldset class="row align-items-center">
                    <legend class="col col-form-label fw-medium">Gender:</legend>
                    <div class="col-6 flex-grow-1">
                      <?php foreach (Gender::cases() as $gender) : ?>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input <?= FormValidator::hasError('gender') ? 'is-invalid' : '' ?>" type="radio" id="gender-<?= $gender->value ?>" name="gender" value="<?= $gender->value ?>" <?= FormValidator::value('gender') === $gender->value ? 'checked' : '' ?>>
                          <label class="form-check-label me-2" for="gender-<?= $gender->value ?>">
                            <?= $gender->label() ?>
                          </label>
                          <div class="invalid-feedback" role="alert"><?= FormValidator::error('gender') ?></div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </fieldset>
                </div>
              </fieldset>
              <fieldset class="col-12 col-md">
                <legend class="h5 p-2 bg-gradient rounded-top border border-bottom-0 mb-0">Account Credentials</legend>
                <div class="d-grid gap-2 p-2 border rounded-bottom">
                  <div class="row align-items-center">
                    <label for="email" class="col col-form-label fw-medium">Email:</label>
                    <div class="col-6 flex-grow-1">
                      <input type="email" class="form-control <?= FormValidator::hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="e.g. john@example.com" value="<?= FormValidator::value('email') ?>" required>
                      <div class="invalid-feedback" role="alert"><?= FormValidator::error('email') ?></div>
                    </div>
                  </div>
                  <fieldset class="row">
                    <legend class="col col-form-label fw-medium">Password:</legend>
                    <div class="col-6 flex-grow-1">
                      <input type="password" class="form-control mb-1 <?= FormValidator::hasError('password') ? 'is-invalid' : '' ?>" name="password" placeholder="Enter password" required>
                      <div class="invalid-feedback" role="alert"><?= FormValidator::error('password') ?></div>
                      <input type="password" class="form-control <?= FormValidator::hasError('confirmPassword') ? 'is-invalid' : '' ?>" name="confirmPassword" placeholder="Confirm password" required>
                      <div class="invalid-feedback" role="alert"><?= FormValidator::error('confirmPassword') ?></div>
                    </div>
                  </fieldset>
                  <div class="row">
                    <label for="role" class="col col-form-label fw-medium">Role:</label>
                    <div class="col-6 flex-grow-1">
                      <select class="form-select <?= FormValidator::hasError('role') ? 'is-invalid' : '' ?>" id="role" name="role" required>
                        <option value="">Choose...</option>
                        <?php foreach (Role::withoutRoot() as $role) : ?>
                          <option value="<?= $role->value ?>" <?= FormValidator::value('role') === $role->value ? 'selected' : '' ?>><?= $role->label() ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </fieldset>
              <?php FormValidator::clearErrors() ?>
            </form>
          </div>
        </div>
      </main>
      <footer class="card-footer hstack gap-3 overflow-x-auto text-nowrap flex-shrink-0">
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="./index.php">🔙 Users List</a>
        <div class="vr"></div>
        <button class="btn bg-success bg-gradient bg-opacity-10 link-body-emphasis fw-medium px-3 order-first order-sm-0 mx-auto" type="submit" form="user-form">✔ Submit Form Data</button>
        <div class="vr"></div>
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="?signout">Sign Out &raquo;</a>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>