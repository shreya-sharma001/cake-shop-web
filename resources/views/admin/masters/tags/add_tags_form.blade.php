@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
      <div class="container mt-5">
        <div class="row justify-content-between">
          <div class="col-3">
            <h3>Add Tag</h3>
          </div>
          <div class="col-3">
            <a class="btn btn-primary btn-md float-end" href="{{route('tags')}}">Back</a>
          </div>
        </div>
        <form action="{{route('tag.addform')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <!-- Floating Input Fields -->
                @php
                  $fields = [
                    ['name' => 'tag', 'label' => 'tag'],
                  ];
                @endphp

                @foreach ($fields as $field)
                <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="{{ $field['name'] }}" placeholder="{{ $field['label'] }}" required>
                    <label>{{ $field['label'] }}</label>
                </div>
                </div>
                @endforeach


          {{-- <div class="col-md-6">
            <label class="form-label">Product_id</label>
            <select name="product_id" class="form-select" required>
              <option value="">Select Product</option>
              @if(isset($products))
                    @foreach ($products ?? [] as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
              @endif
            </select>
        </div> --}}
        
          <button class="btn btn-primary">Save Tag</button>
        </form>
      </div>
    </div>
  </div>

@endsection
