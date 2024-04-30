<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products | Show Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{ asset('css/app.css')}} " rel="stylesheet">
</head>

<body class="vh-100 bg-body-secondary d-flex">
  <div class="container-lg my-auto py-4">
    <div class="card shadow-sm border-0 col-lg-8 mx-auto">
      <div class="card-header">
        <h2 class="card-title text-center">Product Details</h2>
      </div>

      <div class="card-body">
        <article class="row g-0">
          <div class="col-md-4">
            <img src="https://via.placeholder.com/300x200" class="w-100 h-100 object-fit-cover" alt="Product Image">
          </div>

          <div class="col-md-8">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  @if($product->category)
                  <a class="btn badge border link-body-emphasis me-2" href="{{ route('products.index', ['categories[]' => $product->category->id]) }}">
                    📂 {{ $product->category->name }}
                  </a>
                  @endif

                  <span class="badge text-{{ $product->status->color() }}-emphasis bg-{{ $product->status->color() }} bg-opacity-10 border border-{{ $product->status->color() }}-subtle">
                    {{ $product->status->label() }}
                  </span>
                  
                  <h2 class="card-title mt-2">{{ $product->name }}</h2>
                </div>

                <div class="col-auto">
                  <span class="h3">${{ $product->price }}</span>
                </div>
              </div>

              <p class="card-text">{{ $product->description }}}</p>

              <div class="d-flex flex-wrap gap-2">
                @foreach($product->tags as $tag)
                <a class="btn badge bg-secondary bg-opacity-10 border link-secondary" href="{{ route('products.index', ['tags[]' => $tag->id]) }}">
                  🏷️ {{ $tag->name }}
                </a>
                @endforeach
              </div>
            </div>

            <div class="card-body py-2 border-top d-flex gap-2 text-nowrap">
              <button class="btn btn-lg btn-dark px-4 flex-grow-1" type="button" @disabled($product->status !== \App\Enums\ProductStatus::IN_STOCK)>💸 Buy Now</button>

              <button class="btn btn-lg btn-dark px-4" type="button" @disabled($product->status !== \App\Enums\ProductStatus::IN_STOCK)>🛒 Add to Cart</button>

              <button class="btn btn-lg btn-outline-dark ms-auto" type="button">🤍</button>
            </div>
          </div>
        </article>
      </div>

      <div class="card-footer hstack justify-content-between gap-2">
        <small class="text-muted">Created: {{ date('j F, Y H:i', strtotime($product->created_at)) }}</small>
        @if ($product->updated_at)

        <small class="text-muted">Updated: {{ date('j F, Y H:i', strtotime($product->updated_at)) }}</small>
        @endif

        <span class="vr"></span>

        <a href="{{ route('products.edit', $product) }}" class="btn btn-light fw-medium text-nowrap flex-grow-1">✏️ Edit</a>

        <span class="vr"></span>

        <button onclick="return confirm('Are you sure you want to delete this product?')" type="submit" form="product-delete-form" class="btn btn-light fw-medium text-nowrap flex-grow-1">❌ Delete</button>

        <span class="vr"></span>

        <a href="{{ route('products.index') }}" class="btn fw-medium text-nowrap link-body-emphasis">📃 Products &rarr;</a>
      </div>
    </div>
  </div>

  <form action="{{ route('products.destroy', $product) }}" method="POST" id="product-delete-form" class="d-none">
    @csrf
    @method('DELETE')
  </form>
</body>

</html>
