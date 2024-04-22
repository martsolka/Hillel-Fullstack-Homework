<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poll Types | Create Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="min-vh-100 bg-primary-subtle d-flex">
  <div class="container my-auto py-4">
    <div class="card shadow-sm border-0 col-lg-8 mx-auto">
      <div class="card-header">
        <h2 class="card-title text-center">Create Poll Type</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('poll-types.store') }}" method="POST" id="poll-type-create" class="row g-3 row-cols-1 row-cols-md-auto">
          @csrf
          <div class="col col-lg-4">
            <div class="form-floating">
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter name">
              <label for="name" class="form-label">Name</label>
            </div>
          </div>
          <div class="col flex-grow-1">
            <div class="form-floating">
              <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" placeholder="Enter description">
              <label for="description" class="form-label">Description</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating">
              <select name="status" id="status" class="form-select">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
              <label for="status" class="form-label">Status</label>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer hstack justify-content-between gap-2">
        <button type="submit" form="poll-type-create" class="btn btn-dark fw-medium text-nowrap">✔ Submit Form</button>
        <a href="{{ route('poll-types.index') }}" class="btn bg-light fw-medium text-nowrap link-body-emphasis">📃 Poll Types &rarr;</a>
      </div>
    </div>
  </div>
</body>

</html>