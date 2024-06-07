<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poll Types | Edit Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="min-vh-100 bg-primary-subtle d-flex">
  <div class="container my-auto py-4">
    <div class="card shadow-sm border-0 col-lg-8 mx-auto">
      <div class="card-header">
        <h2 class="card-title text-center">Edit Poll Type</h2>
      </div>
      <div class="card-body">
        <?php
        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['errors'], $_SESSION['old']);
        ?>
        <?php if ($errors) : ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form action="/poll-types/update" method="POST" id="poll-type-create" class="row g-3 row-cols-1 row-cols-md-auto">
          <div class="col col-lg-4">
            <div class="form-floating">
              <input type="text" name="name" id="name" class="form-control <?= $errors['name'] ?? '' ? 'is-invalid' : '' ?>" value="<?= $old['name'] ?? $pollType->name ?? '' ?>" placeholder="Enter name">
              <label for="name" class="form-label">Name</label>
            </div>
          </div>
          <div class="col flex-grow-1">
            <div class="form-floating">
              <input type="text" name="description" id="description" class="form-control <?= $errors['description'] ?? '' ? 'is-invalid' : '' ?>" value="<?= $old['description'] ?? $pollType->description ?? '' ?>" placeholder="Enter description">
              <label for="description" class="form-label">Description</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating">
              <select name="status" id="status" class="form-select <?= $errors['status'] ?? '' ? 'is-invalid' : '' ?>">
                <option value="" selected disabled>-- Choose --</option>
                <?php foreach ($statuses as $value => $label) : ?>
                  <option value="<?= $value ?>" <?= ($old['status'] ?? $pollType->status) === $value ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
              </select>
              <label for="status" class="form-label">Status</label>
            </div>
          </div>
        </form>
      </div>
      
      <div class="card-footer hstack justify-content-between gap-2">
        <button type="submit" form="poll-type-create" class="btn btn-dark fw-medium text-nowrap" name="id" value="<?= $pollType->id ?>">✔ Submit Form</button>
        <a href="/poll-types" class="btn bg-light fw-medium text-nowrap link-body-emphasis">📃 Poll Types &rarr;</a>
      </div>
    </div>
  </div>
</body>

</html>