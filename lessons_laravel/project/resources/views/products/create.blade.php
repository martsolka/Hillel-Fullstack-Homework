<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products | Create Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{ asset('css/app.css')}} " rel="stylesheet">
</head>

<body class="vh-100 bg-body-secondary d-flex">
  <div class="container-lg my-auto py-4">
    <div class="card shadow-sm border-0 col-lg-8 mx-auto">
      <div class="card-header">
        <h2 class="card-title text-center">Create New Product</h2>
      </div>

      <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" id="product-form">
          @csrf
          <div class="row g-3">
            <div class="col-sm-6 vstack gap-3">
              <div class="form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="productName" name="name" placeholder="Product Name" value="{{ old('name') }}">

                <label for="productName">Name</label>

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-floating flex-grow-1">
                <textarea class="form-control h-100 @error('description') is-invalid @enderror" id="productDescription" name="description" placeholder="Product Description">{{ old('description') }}</textarea>

                <label for="productDescription">Description</label>

                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-floating">
                <select class="form-select @error('category_id') is-invalid @enderror" id="productCategory" name="category_id" aria-label="Category">
                  <option value="" selected>-- No Category --</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}" @selected(old('category_id')===$category->id)>{{ $category->name }}</option>
                  @endforeach
                </select>

                <label for="productCategory">Select Category</label>

                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6 vstack gap-3">
              <div class="form-floating">
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="productPrice" name="price" placeholder="Product Price" value="{{ old('price') }}">

                <label for="productPrice">Price ($)</label>

                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-floating">
                <select class="form-select h-100 @error('tags') is-invalid @enderror" id="productTags" name="tags[]" placeholder="Product Tags" multiple>
                  <option value="">-- No Tags --</option>
                  @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}" @selected(old('tags') && in_array($tag->id, old('tags')))>{{ $tag->name }}</option>
                  @endforeach
                </select>

                <label for="productTags">Tags</label>

                @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-floating">
                <select class="form-select @error('status') is-invalid @enderror" id="productStatus" name="status" aria-label="Status">
                  @foreach ($statuses as $status)
                  <option value="{{ $status->value }}" @selected(old('status', $defSelectedStatus)===$status->value)>
                    {{ $status->label() }}
                  </option>
                  @endforeach
                </select>

                <label for="productStatus">Set Status</label>
                
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="card-footer hstack justify-content-between gap-2">
        <button type="submit" form="product-form" class="btn btn-dark fw-medium text-nowrap">✔ Submit Form</button>

        <a href="{{ route('products.index') }}" class="btn bg-light fw-medium text-nowrap link-body-emphasis">📃 Products &rarr;</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  <script>
    const filterCollapse = document.getElementById('filter-collapse');
    const filterTabs = document.querySelectorAll('#filter-tabs button');

    filterCollapse.addEventListener('show.bs.collapse', () => {
      new bootstrap.Tab(filterTabs[0]).show();
    });

    filterCollapse.addEventListener('hide.bs.collapse', () => {
      filterTabs.forEach((tab) => {
        tab.classList.remove('active');
        tab.setAttribute('aria-selected', 'false');
        tab.setAttribute('tabindex', '-1');

        const tabPane = document.getElementById(tab.getAttribute('aria-controls'));
        tabPane.classList.remove('show', 'active');
      });
    });

  </script>
</body>

</html>
