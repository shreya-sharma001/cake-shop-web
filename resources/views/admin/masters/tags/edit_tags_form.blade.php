@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
      <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-3">
              <h3>Edit Tag</h3>
            </div>
            <div class="col-3">
              <a class="btn btn-primary btn-md float-end" href="{{ url('tags') }}">Back</a>
            </div>
          </div>
        <form method="POST" action="{{ route('updatetag', $tags->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

             <!-- Tag Input -->
             <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="tag" value="{{ old('tags', $tags->tag) }}" placeholder="Tag" required>
                    <label>Tag</label>
                </div>
            </div>

            {{-- <!-- Product Select -->
            <div class="col-md-6">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-select" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $tags->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}

          <button class="btn btn-primary">Save Tag</button>
        </form>
      </div>
    </div>
  </div>

  @endsection
