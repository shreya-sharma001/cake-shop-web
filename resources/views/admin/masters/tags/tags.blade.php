@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Tag</h3>
                <a href="{{route('addtag')}}" class="btn btn-primary">Add tag</a>
            </div>
            <input type="text" class="form-control mb-3" placeholder="Search Category..." id="searchInput">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                        <th>ID</th>
                        <th>Tag</th>
                        {{-- <th>Product_id</th> --}}
                        <th>Created_At</th>
                        <th>Updated_At</th>
                        <th>Edit Tag</th>
                        <th>Delete Tag</th>
                </tr>
                </thead>
                <tbody id="categoryTable">
                    @foreach ($tags as $t)
                            <tr>
                                <th scope="row">{{$t->id}}</th>
                                <td>{{$t->tag}}</td>
                                {{-- <td>{{$t->product_id}}</td> --}}
                                <td>{{$t->created_at}}</td>
                                <td>{{$t->updated_at}}</td>
                                <td><a class="btn btn-sm btn-warning" href="{{ route('edittag', ['id' => $t->id]) }}">Edit Tag</a></td>
                                <td><a class="btn btn-sm btn-danger" href="{{ route('deletetag', ['id' => $t->id]) }}">Delete Tag</a></td>
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
