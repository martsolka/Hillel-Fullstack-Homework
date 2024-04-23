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
        @if (session('alert.message'))
        <div class="alert alert-{{ session('alert.type', 'success') }} alert-dismissible fade show" role="alert">
          {{session('alert.message')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-bordered align-middle text-center">
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
              @forelse ($pollTypes as $pollType)
              <tr>
                <td>{{ $pollType->id }}</td>
                <td>{{ $pollType->name }}</td>
                <td>{{ $pollType->description ?? '➖' }}</td>
                <td><span class="badge bg-{{ $pollType->status->color() }}-subtle text-{{ $pollType->status->color() }}-emphasis">{{ $pollType->status->label() }}</span></td>
                <td>
                  <small class="text-body-secondary">{{ $pollType->created_at }} / {{ $pollType->updated_at ?? '➖' }}</small>
                </td>
                <td>
                  <a class="btn btn-sm bg-light-subtle me-1" href="{{ route('poll-types.edit', $pollType) }}">✏️</a>
                  <a class="btn btn-sm bg-light-subtle" href="#">❌</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">👀 No data found in the database ...</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>