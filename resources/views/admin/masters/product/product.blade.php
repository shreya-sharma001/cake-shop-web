@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Products</h3>
                <a href="{{route('product.addform')}}" class="btn btn-primary">Add Product</a>
            </div>
            <input type="text" class="form-control mb-3" placeholder="Search Products..." id="searchInput">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Small_Description</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>SKU</th>
                    <th>Tag_id</th>
                    <th>Product_image_id</th>
                    <th>Color</th>
                    <th>Category_id</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Edit Product</th>
                    <th>Delete Product</th>
                </tr>
                </thead>
                <tbody id="productTable">
                    @foreach ($products as $p)
                    <tr>
                        <th scope="row">{{$p->id}}</th>
                        <td>{{$p->name}}</td>
                        <td>{{$p->slug}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->small_description}}</td>
                        <td>{{$p->description}}</td>
                        <td>{{$p->price}}</td>
                        <td>{{$p->size}}</td>
                        <td>{{$p->SKU}}</td>
                        <td>{{$p->tag_id}}</td>
                        {{-- <td><img src="{{ asset($p->image) }}" alt="Product Image" width="80"><br></td> --}}
                        <td>{{$p->image}}</td>
                        <td>{{$p->color}}</td>
                        <td>{{$p->category_id}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->updated_at}}</td>
                        <td><a class="btn btn-sm btn-warning" href="{{ route('editproduct', ['id' => $p->id]) }}">Edit Product</a></td>
                        <td><a class="btn btn-sm btn-danger" href="{{ route('deleteproduct', ['id' => $p->id]) }}">Delete Product</a></td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#productTable tr');
    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>

@endsection
