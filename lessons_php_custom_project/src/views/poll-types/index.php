<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poll Types | Index Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="min-vh-100 bg-primary-subtle d-flex">
  <div class="container-lg my-auto py-4">
    <div class="card shadow-sm border-0">
      <div class="card-header hstack justify-content-between flex-wrap">
        <h2 class="card-title">📃 Poll Types</h2>
        <a href="/poll-types/create" class="btn btn-dark fw-medium text-nowrap">➕ Create New</a>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered align-middle text-center">
            <thead class="table-dark text-uppercase align-middle small">
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At / Updated At</th>
              </tr>
            </thead>
            <tbody>
              <?php /** @var app\Models\PollType[] $pollTypes */
              if (!empty($pollTypes)) : ?>
                <?php
                foreach ($pollTypes as $pollType) : ?>
                  <tr>
                    <td><?= $pollType->id ?></td>
                    <td><?= $pollType->name ?></td>
                    <td><?= $pollType->description ?? '➖' ?></td>
                    <td>
                      <span class="badge bg-<?= $pollType->status()->color(); ?>-subtle text-<?= $pollType->status()->color(); ?>-emphasis"><?= $pollType->status ?></span>
                    </td>
                    <td>
                      <small class="text-body-secondary"><?= $pollType->created_at ?> / <?= $pollType->updated_at ?? '➖' ?></small>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else : ?>
                <tr>
                  <td colspan="5" class="text-center">👀 No data found in the database ...</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>