@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
  <main class="flex-grow-1">
    <div class="container mt-5">
      <div class="card card-react-style p-4">
        <div class="row justify-content-between align-items-center mb-4">
          <div class="col-md-6">
            <h3 class="mb-0 fw-semibold">✏️ Edit Product</h3>
          </div>
          <div class="col-md-6 text-end">
            <a class="btn btn-primary" href="product"><i class="bi bi-arrow-left"></i>Back</a>
          </div>
        </div>

        <form method="POST" action="{{ route('updateproduct', $products->id) }}" enctype="multipart/form-data">
          @csrf
          <div class="row g-4">

            @php
              $fields = [
                ['name' => 'name', 'label' => 'Name'],
                ['name' => 'slug', 'label' => 'Slug'],
                ['name' => 'title', 'label' => 'Title'],
                ['name' => 'small_description', 'label' => 'Small Description'],
                ['name' => 'description', 'label' => 'Description'],
                ['name' => 'price', 'label' => 'Price'],
                ['name' => 'size', 'label' => 'Size'],
                ['name' => 'SKU', 'label' => 'SKU'],
                ['name' => 'color', 'label' => 'Color'],
              ];
            @endphp

            @foreach ($fields as $field)
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" name="{{ $field['name'] }}"
                         value="{{ old($field['name'], $products->{$field['name']}) }}"
                         placeholder="{{ $field['label'] }}" required>
                  <label>{{ $field['label'] }}</label>
                </div>
              </div>
            @endforeach

            <div class="col-md-6">
                    <label class="form-label">Thumbnail</label>
                    <img src="{{ asset('storage/' . $products->image) }}" alt="" width="100" class="mb-2"><br>
                    <input type="file" class="form-control image-input" name="image" onchange="previewThumbnail(this)">
                    <div class="previewThumbnail mt-2"></div>
            </div>


            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                  <option value="">Select Category</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{$products->category_id == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                  <label class="form-label">Tag</label>
                  <select name="tag_id[]" class="form-select" multiple required>
                      <option value="">Select Tag</option>
                      @foreach($tags as $key => $tag)
                      {{-- {{dd($tag)}} --}}
                    <option value="{{ $tag->id }}" {{$products->tag_id == $tag->id ? 'selected' : '' }}>
                      {{ $tag->tag }}
                    </option>
                  @endforeach
                </select>
              </div>

            <!-- Multiple Image Upload -->
            <div class="col-12 mt-3">
              <label class="form-label">Upload Images</label>
              <div id="image-upload-wrapper">
                <div class="row image-upload-group g-2 mb-2">
                  <div class="col-md-10">
                    <input type="file" class="form-control image-input" name="image_path[]" multiple onchange="previewImage(this)">
                    <div class="preview mt-2">
                      {{-- @if($products->image) --}}
                        @foreach($productimages as $image)
                          <img src="{{ asset('storage/' . $image->image_path) }}" width="100" class="me-2 mb-2">
                        @endforeach
                      {{-- @endif --}}
                    </div>
                  </div>
                  <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-image">Remove</button>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-primary btn-sm mt-1" id="addImageField">+ Add More</button>
            </div>

            <!-- Description -->
            <div class="col-12">
              <label class="form-label">Details</label>
              <textarea class="form-control" name="description" rows="4" required>{{ old('description', $products->description) }}</textarea>
            </div>

            <!-- Submit -->
            <div class="col-12 text-end">
              <button class="btn btn-success mt-3"><i class="bi bi-save"></i> Update Product</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
@endsection

@push('scripts')
<script>
// Add more image fields
document.getElementById('addImageField').addEventListener('click', function () {
  const wrapper = document.getElementById('image-upload-wrapper');
  const clone = wrapper.querySelector('.image-upload-group').cloneNode(true);
  clone.querySelector('.image-input').value = '';
  clone.querySelector('.preview').innerHTML = '';
  wrapper.appendChild(clone);
});

// Remove image input
document.addEventListener('click', function (e) {
  if (e.target.classList.contains('remove-image')) {
    const group = e.target.closest('.image-upload-group');
    if (document.querySelectorAll('.image-upload-group').length > 1) {
      group.remove();
    }
  }
});

// Preview image
function previewImage(input) {
  const preview = input.parentElement.querySelector('.preview');
  preview.innerHTML = '';
  const file = input.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = document.createElement('img');
      img.src = e.target.result;
      preview.appendChild(img);
    };
    reader.readAsDataURL(file);
  }
}
</script>
@endpush
