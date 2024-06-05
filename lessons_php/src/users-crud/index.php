<?php require_once('includes.php');

AuthManager::goTo('/home-private.php', !AuthManager::hasRole(Role::ROOT, Role::ADMIN));
AuthManager::handleSignOut();

$users = (new UserModel)->read();
$currentUser = AuthManager::currentUser();

$pageTitle = 'Users CRUD | All Users';
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
            <h1>Manage Users</h1>
            <p class="lead text-body-secondary">Here is a list of all registered accounts in the database.</p>
            <?php require_once('html/alert.php'); ?>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8">
            <div class="table-responsive">
              <table class="table table-bordered text-center align-middle text-nowrap">
                <thead class="bg-gradient">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                      <?php $userRole = Role::fromValue($user['role']); ?>
                      <tr <?php if ($currentUser['id'] === $user['id']) echo 'class="table-active"' ?>>
                        <th scope="row"><?= $user['id'] ?></th>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                          <small class="<?= $userRole->bsClass() ?>"><?= $userRole->label() ?></small>
                        </td>
                        <td>
                          <div class="hstack w-auto gap-2 justify-content-center" role="group" aria-label="User Actions">
                            <a class="btn btn-sm flex-fill bg-gradient link-body-emphasis fw-medium" href="./read.php?id=<?= $user['id'] ?>">👁<span class="d-none d-sm-inline ms-1">View</span>
                            </a>
                            <a class="btn btn-sm flex-fill bg-gradient link-body-emphasis fw-medium" href="./update.php?id=<?= $user['id'] ?>">✏️<span class="d-none d-sm-inline ms-1">Edit</span>
                            </a>
                            <button class="btn btn-sm flex-fill bg-gradient link-body-emphasis fw-medium" data-bs-toggle="modal" data-bs-target="#delete-user-modal" data-bs-user-id="<?= $user['id'] ?>" data-bs-user-name="<?= $user['name'] ?>">
                              ❌<span class=" d-none d-sm-inline ms-1">Delete</span>
                            </button>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

      <footer class="card-footer hstack gap-3 overflow-x-auto text-nowrap flex-shrink-0">
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="/home-private.php">🏠 Home</a>
        <div class="vr"></div>
        <a class="btn bg-success bg-gradient bg-opacity-10 link-body-emphasis fw-medium px-3 mx-auto" href="create.php">➕ Add New User</a>
        <div class="vr"></div>
        <a class="btn backdrop-filter bg-gradient link-body-emphasis fw-medium px-3" href="?signout">Sign Out &raquo;</a>
      </footer>
    </div>
  </div>

  <?php require_once('html/delete-user-modal.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>