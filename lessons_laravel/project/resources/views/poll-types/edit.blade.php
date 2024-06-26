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
        @include('poll-types.form-errors')
        <form action="{{ route('poll-types.update', $pollType) }}" method="POST" id="poll-type-update" class="row g-3 row-cols-1 row-cols-md-auto">
          @csrf
          @method('PUT')
          <div class="col col-lg-4">
            <div class="form-floating">
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $pollType->name) }}" placeholder="Enter name">
              <label for="name" class="form-label">Name</label>
            </div>
          </div>
          <div class="col flex-grow-1">
            <div class="form-floating">
              <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $pollType->description) }}" placeholder="Enter description">
              <label for="description" class="form-label">Description</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating">
              <select name="status" id="status" class="form-select">
                <option value="" selected disabled>Choose...</option>
                @foreach (\App\Enums\PollTypeStatus::cases() as $status)
                <option value="{{ $status->value }}" @selected(old('status', $pollType->status->value) === $status->value)>
                  {{ $status->label() }}
                </option>
                @endforeach
              </select>
              <label for="status" class="form-label">Status</label>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer hstack justify-content-between gap-2">
        <button type="submit" form="poll-type-update" class="btn btn-dark fw-medium text-nowrap">✔ Submit Form</button>
        <a href="{{ route('poll-types.index') }}" class="btn bg-light fw-medium text-nowrap link-body-emphasis">📃 Poll Types &rarr;</a>
      </div>
    </div>
  </div>
</body>

</html>
