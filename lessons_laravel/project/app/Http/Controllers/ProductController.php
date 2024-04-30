<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Http\Requests\SaveProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\View\View;

class ProductController extends Controller
{
    const PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::query()->with('category', 'tags')
            ->when(
                request()->input('categories'),
                fn ($query, $categories) => $query->whereHas('category', fn ($query) => $query->whereIn('categories.id', $categories))
            )
            ->when(
                request()->input('statuses'),
                fn ($query, $statuses) => $query->whereIn('status', $statuses)
            )
            ->when(
                request()->input('tags'),
                fn ($query, $tagIds) => $query->whereHas('tags', fn ($query) => $query->whereIn('tags.id', $tagIds))
            )
            ->when(
                request()->input('name'),
                fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%')
            )
            ->when(
                request()->input('sort'),
                fn ($query, $sort) => $query->orderBy($sort, request()->input('dir', 'asc'))
            )
            ->paginate(self::PER_PAGE);

        $categories = Category::query()->withCount('products')->orderBy('id')->get();
        $tags = Tag::query()->withCount('products')->get();

        return view('products.index', compact('products', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create', $this->init_formdata());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProductRequest $request)
    {
        $data = $request->safe()->except('tags');
        $tagsIds = $request->input('tags');

        $product = Product::query()->create($data);
        $product->tags()->attach($tagsIds);

        return to_route('products.index', ['sort' => 'updated_at', 'dir' => 'desc'])->with('alert.message', "Product with ID '{$product->id}' was successfully added to the database.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', array_merge($this->init_formdata(), compact('product')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveProductRequest $request, Product $product)
    {
        $data = $request->safe()->except('tags');
        $tagsIds = $request->input('tags');

        $product->update($data);
        $product->tags()->sync($tagsIds);

        return to_route('products.index', ['sort' => 'updated_at', 'dir' => 'desc'])->with('alert.message', "Product with ID '{$product->id}' was successfully updated in the database.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('alert.message', "Product with ID '{$product->id}' was successfully deleted from the database.");
    }

    private function init_formdata(): array
    {
        $categories = Category::all();
        $tags = Tag::all();
        $statuses = ProductStatus::cases();
        $defSelectedStatus = ProductStatus::DRAFT->value;

        return compact('categories', 'tags', 'statuses', 'defSelectedStatus');
    }
}
