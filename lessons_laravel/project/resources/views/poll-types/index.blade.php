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
        <a href="{{ route('poll-types.create') }}" class="btn btn-dark fw-medium text-nowrap">➕ Create New</a>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-striped table-bordered align-middle text-center">
            <thead class="table-dark text-uppercase align-middle small">
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At / Updated At</th>
                <th>Edit / Delete</th>
              </tr>
            </thead>
            <tbody>
              @if (count($pollTypes) > 0)
              @foreach ($pollTypes as $pollType)
              <tr>
                <td>{{ $pollType->id }}</td>
                <td>{{ $pollType->name }}</td>
                <td>{{ $pollType->description ?? '➖' }}</td>
                <td><span class="badge bg-dark-subtle text-dark-emphasis text-uppercase">{{ $pollType->status }}</span></td>
                <td>
                  <small class="text-body-secondary">{{ $pollType->created_at }} / {{ $pollType->updated_at ?? '➖' }}</small>
                </td>
                <td>
                  <a class="btn btn-sm btn-outline-warning me-1" href="#">✏️</a>
                  <a class="btn btn-sm btn-outline-danger" href="#">❌</a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6" class="text-center">👀 No data found in the database ...</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>