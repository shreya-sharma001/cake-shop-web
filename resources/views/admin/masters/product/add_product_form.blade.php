@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
  <main class="flex-grow-1">
    <div class="container mt-5">
      <div class="card card-react-style p-4">
        <div class="row justify-content-between align-items-center mb-4">
          <div class="col-md-6">
            <h3 class="mb-0 fw-semibold">🛒 Add Product</h3>
          </div>
          <div class="col-md-6 text-end">
            <a class="btn btn-primary" href="product"><i class="bi bi-arrow-left"></i> Back</a>
          </div>
        </div>

        <form method="POST" action="{{route('addproduct')}}" enctype="multipart/form-data">
            @csrf
          <div class="row g-4">

            <!-- Floating Input Fields -->
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
                ['name' => 'color', 'label' => 'color'],
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

                <div class="col-md-6">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" class="form-control image-input" name="image" onchange="previewThumbnail(this)" required>
                    <div class="previewThumbnail mt-2"></div>
                </div>

             <!-- Category Dropdown -->
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                      <option value="">Select Category</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tags</label>
                    <select name="tag_id[]" class="form-select select2" multiple>
                        <option value="">Select Tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Product Image id -->
                {{-- <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="product_image_id" class="form-select" required>
                      <option value="">Select Products Image</option>
                      @foreach($product_image_id as $p_i_id)
                        <option value="{{ $p_i_id->id }}">{{ $p_i_id->name }}</option>
                      @endforeach
                    </select>
                </div> --}}

                {{-- <div class="col-md-6">
                    <label class="form-label">Color</label>
                    <select name="color_id" class="form-select" required>
                      <option value="">Select Color</option>
                      @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                      @endforeach
                    </select>
                </div> --}}


           <!-- Multiple Image Upload -->
           <div class="col-12 mt-3">
            <label class="form-label">Upload Images</label>
            <div id="image-upload-wrapper">
              <div class="row image-upload-group g-2 mb-2">
                <div class="col-md-10">
                  <input type="file" class="form-control image-input" name="image_path[]" onchange="previewImage(this)" required>
                  <div class="preview mt-2"></div>
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
            <textarea class="form-control" name="description" rows="4" placeholder="Enter product details..." required></textarea>
          </div>

          <!-- Submit -->
          <div class="col-12 text-end">
            <button class="btn btn-success mt-3"><i class="bi bi-check-circle"></i> Save Product</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
    // Initialize Select2
    $('.select2').select2({
      placeholder: 'Select tags',
      allowClear: true
    });

    // Add more image fields
    const addBtn = document.getElementById('addImageField');
    if (addBtn) {
      addBtn.addEventListener('click', function () {
        const wrapper = document.getElementById('image-upload-wrapper');
        const clone = wrapper.querySelector('.image-upload-group').cloneNode(true);
        clone.querySelector('.image-input').value = '';
        clone.querySelector('.preview').innerHTML = '';
        wrapper.appendChild(clone);
      });
    }

    // Remove image input
    document.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-image')) {
        const group = e.target.closest('.image-upload-group');
        if (document.querySelectorAll('.image-upload-group').length > 1) {
          group.remove();
        }
      }
    });
  });

  // Preview image (can stay outside since it runs only on onchange)
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

  function previewThumbnail(input) {
    const previewThumbnail = input.parentElement.querySelector('.previewThumbnail');
    previewThumbnail.innerHTML = '';
    const file = input.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        previewThumbnail.appendChild(img);
      };
      reader.readAsDataURL(file);
    }
  }
</script>

