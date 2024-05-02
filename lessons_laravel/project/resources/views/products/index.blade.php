<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products | Index Page</title>
  <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css')}} " rel="stylesheet">
</head>

<body class="vh-100 bg-body-secondary d-flex">
  <div class="container-lg my-auto py-4 h-100">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-header">
        <div class="row align-items-center justify-content-between row-gap-2">
          <div class="col-auto col-md">
            <h1 class="mb-0 fs-3 text-nowrap"><a class="text-decoration-none" href="{{ route('products.index') }}" title="Product Listing">📃</a> Product Listing</h1>
          </div>

          <div class="col-md order-last order-md-0">
            <div class="input-group flex-nowrap">
              <form action="{{ route('products.index') }}" method="GET" role="search" id="search-form" class="input-group mb-0">
                <label for="search" class="input-group-text">🔎</label>
                <input type="text" name="name" id="search" class="form-control shadow-none rounded-end-0" placeholder="Search by name..." value="{{ request()->get('name') }}" autocomplete="off" required>
                @if(request()->has('name'))
                <a href="{{ route('products.index') }}" class="btn link-dark fw-medium text-nowrap">Clear</a>
                @endif
              </form>

              <button class="btn btn-dark fw-medium text-nowrap dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Filters</button>

              <div class="dropdown-menu dropdown-menu-lg-end p-0 border-0 mh-px-400 overflow-y-auto">
                <div class="card">
                  <div class="card-header position-sticky top-0 z-3 bg-light">
                    <ul class="nav nav-tabs card-header-tabs flex-nowrap" id="filterTabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link link-body-emphasis fw-medium active" id="category-tab" data-bs-toggle="tab" data-bs-target="#category-tab-pane" type="button" role="tab" aria-controls="category-tab-pane" aria-selected="true">📁 Category</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link link-body-emphasis fw-medium" id="status-tab" data-bs-toggle="tab" data-bs-target="#status-tab-pane" type="button" role="tab" aria-controls="status-tab-pane" aria-selected="false">⚫ Status</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link link-body-emphasis fw-medium" id="tag-tab" data-bs-toggle="tab" data-bs-target="#tag-tab-pane" type="button" role="tab" aria-controls="tag-tab-pane" aria-selected="false">🏷 Tag</button>
                      </li>
                    </ul>
                  </div>

                  <form action="{{ route('products.index') }}" method="GET" class="tab-content overflow-y-auto" id="filterTabsForm">
                    <div class="tab-pane fade show active" id="category-tab-pane" role="tabpanel" aria-labelledby="category-tab" tabindex="0">
                      <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                        <li class="list-group-item list-group-item-action hstack gap-3">
                          <input type="checkbox" class="form-check-input" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}" @checked(in_array($category->id, request()->input('categories', [])))>
                          <label class="form-check-label flex-grow-1" for="category-{{ $category->id }}">
                            {{ $category->name }}
                          </label>
                          <span class="badge bg-dark bg-opacity-10 text-dark-emphasis">
                            {{ $category->products_count }}
                          </span>
                        </li>
                        @endforeach
                      </ul>
                    </div>

                    <div class="tab-pane fade" id="status-tab-pane" role="tabpanel" aria-labelledby="status-tab" tabindex="0">
                      <ul class="list-group list-group-flush">
                        @foreach(\App\Enums\ProductStatus::cases() as $status)
                        <li class="list-group-item list-group-item-action hstack gap-3">
                          <input type="checkbox" class="form-check-input" name="statuses[]" id="status-{{ $status->value }}" value="{{ $status->value }}" @checked(in_array($status->value, request()->input('statuses', [])))>
                          <label class="form-check-label flex-grow-1" for="status-{{ $status->value }}">
                            {{ $status->label() }}
                          </label>
                        </li>
                        @endforeach
                      </ul>
                    </div>

                    <div class="tab-pane fade" id="tag-tab-pane" role="tabpanel" aria-labelledby="tag-tab" tabindex="0">
                      <ul class="list-group list-group-flush">
                        @foreach($tags as $tag)
                        <li class="list-group-item list-group-item-action hstack gap-3">
                          <input type="checkbox" class="form-check-input" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" @checked(in_array($tag->id, request()->input('tags', [])))>
                          <label class="form-check-label flex-grow-1" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                          </label>
                          <span class="badge bg-dark bg-opacity-10 text-dark-emphasis">
                            {{ $tag->products_count }}
                          </span>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </form>

                  <div class="card-footer hstack gap-2 position-sticky bottom-0 z-3 bg-light">
                    <button type="submit" form="filterTabsForm" class="btn btn-dark fw-medium text-nowrap flex-grow-1">Apply Selected</button>
                    <a href="{{ route('products.index') }}" class="btn  link-dark fw-medium text-nowrap flex-grow-1">Clear All</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-auto col-md text-end">
            <a class="btn btn-dark fw-medium text-nowrap" href="{{ route('products.create') }}">➕<span class="d-none d-sm-inline ms-1">Create New</span></a>
          </div>
        </div>
      </div>

      <div class="card-body overflow-y-auto">
        @if (session('alert.message'))
        <div class="alert alert-{{ session('alert.type', 'success') }} alert-dismissible fade show text-center" role="alert">
          {{session('alert.message')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive small h-100 overflow-y-auto">
          <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark text-uppercase align-middle small position-sticky top-0 z-3">
              <tr>
                @foreach(['Id', 'Image', 'Name', 'Description', 'Category', 'Price', 'Status', 'Tags', 'Created/Updated', 'Actions'] as $column)
                <th>{{ $column }}</th>
                @endforeach
              </tr>
            </thead>

            <tbody>
              @forelse ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>
                  <img src="{{ $product->image ?? 'https://via.placeholder.com/50x50' }}" class="rounded object-fit-cover" width="50" height="50" alt="{{ $product->name }}" />
                </td>
                <td>
                  <span class="d-inline-block mw-px-200 text-truncate">{{ $product->name }}</span>
                </td>
                <td>
                  <span class="d-inline-block mw-px-300 text-truncate">{{ $product->description }}</span>
                </td>
                <td>
                  <span class="badge d-inline-block mw-px-200 border link-body-emphasis text-wrap">
                    {{ $product->category->name ?? '➖' }}
                  </span>
                </td>
                <td>${{ $product->price }}</td>
                <td>
                  <span class="badge text-{{ $product->status->color() }}-emphasis bg-{{ $product->status->color() }} bg-opacity-10 border border-{{ $product->status->color() }}-subtle">{{ $product->status->label() }}</span>
                </td>
                <td>
                  @php($max = 3)
                  @foreach($product->tags as $tag)
                  <span class="badge bg-secondary bg-opacity-10 border text-secondary">
                    {{ $tag->name }}
                  </span>
                  @if ($loop->iteration === $max && !$loop->last)
                  <small>+{{ $loop->remaining }}</small>
                  @break
                  @endif
                  @endforeach
                </td>
                <td>
                  <span class="text-body-secondary vstack">
                    <small>{{ $product->created_at }}</small>
                    <small>{{ $product->updated_at ?? '➖' }}</small>
                  </span>
                </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <a class="btn btn-outline-dark" href="{{ route('products.show', $product) }}" title="Go to Details">👁️</a>
                    <a class="btn btn-outline-dark" href="{{ route('products.edit', $product) }}" title="Edit this Product">✏️</a>
                    <button class="btn btn-outline-dark" type="submit" form="product-delete-form-{{ $product->id }}" formaction="{{ route('products.destroy', $product) }}" onclick="return confirm('Are you sure you want to delete this Product ({{ $product->name }})?')" title="Delete this Product">❌</button>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" id="product-delete-form-{{ $product->id }}" class="d-none">
                      @csrf
                      @method('DELETE')
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="10" class="lead text-body-secondary">
                  @if(request()->has('name'))
                  👀 No results for <strong>"{{ request('name') }}"</strong> ...
                  @else
                  👀 No data found in the database ...
                  @endif
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if($products->hasPages())
      <div class="card-footer flex-shrink-0 pagination-dark">
        {{ $products->withQueryString()->links() }}
      </div>
      @endif
    </div>
  </div>

  <script src="https://fastly.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script>
</body>

</html>
