<?php require_once('includes.php');

AuthManager::goTo('/home-private.php', !AuthManager::hasRole(Role::ROOT, Role::ADMIN));
AuthManager::handleSignOut();

$id = $_GET['id'] ?? -1;

$data = [
  'name' => '👤 Name',
  'email' => '📧 Email',
  'country' => '🌎 Country',
  'date_of_birth' => '🎂 Date of Birth',
  'role' => '👑 Role',
  'created_at' => '🕒 Created At',
  'updated_at' => '🔄 Updated At',
  'gender' => '👨‍👧‍👦 Gender',
];

$user = (new UserModel)->read((int)$id, array_keys($data));
AuthManager::goTo('/404.php', !$user);

$user['role'] = Role::fromValue($user['role'])->label();
$user['gender'] = $user['gender'] ? Gender::fromValue($user['gender'])->label() : '';
$user['country'] = $user['country'] ? Country::fromValue($user['country'])->label() : '';


$pageTitle = 'Users CRUD | User Details';
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
            <h1>User Details</h1>
            <p class="lead text-body-secondary">More information about the selected user.</p>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8">
            <dl class="row row-cols-2 fs-5">
              <?php foreach ($data as $fieldName => $label) : ?>
                <dt class="col-5 border-bottom m-0 p-2"><?= $label ?></dt>
                <dd class="col border-bottom m-0 p-2"><?= $user[$fieldName] ?></dd>
              <?php endforeach; ?>
            </dl>
          </div>
        </div>
      </main>
      <footer class="card-footer hstack gap-3 overflow-x-auto text-nowrap flex-shrink-0">
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="./index.php">🔙 Users List</a>
        <div class="vr"></div>
        <a class="btn bg-success bg-gradient bg-opacity-10 link-body-emphasis fw-medium px-3 mx-auto" href="update.php?id=<?= $id ?>">✏️ Edit Current User</a>
        <div class="vr"></div>
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="?signout">Sign Out &raquo;</a>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>