@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Categories</h3>
                <a href="{{route('addcategory')}}" class="btn btn-primary">Add Category</a>
            </div>
            <input type="text" class="form-control mb-3" placeholder="Search Category..." id="searchInput">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Created_At</th>
                        <th>Updated_At</th>
                        <th>Edit Category</th>
                        <th>Delete Category</th>
                </tr>
                </thead>
                <tbody id="categoryTable">
                    @foreach ($categorys as $c)
                            <tr>
                                <th scope="row">{{$c->id}}</th>
                                <td>{{$c->name}}</td>
                                <td>{{$c->slug}}</td>
                                <td>{{$c->description}}</td>
                                <td>{{$c->created_at}}</td>
                                <td>{{$c->updated_at}}</td>
                                <td><a class="btn btn-sm btn-warning" href="{{ route('editcategory', ['id' => $c->id]) }}">Edit Category</a></td>
                                <td><a class="btn btn-sm btn-danger" href="{{ route('deletecategory', ['id' => $c->id]) }}">Delete Category</a></td>
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
    let rows = document.querySelectorAll('#categoryTable tr');
    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>

@endsection
