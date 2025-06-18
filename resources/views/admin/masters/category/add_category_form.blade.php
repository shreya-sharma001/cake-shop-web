@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
      <div class="container mt-5">
        <div class="row justify-content-between">
          <div class="col-3">
            <h3>Add Category</h3>
          </div>
          <div class="col-3">
            <a class="btn btn-primary btn-md float-end" href="category">Back</a>
          </div>
        </div>
        <form action="{{route('category.addform')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
            <label>Category Name</label>
            <input type="text" class="form-control" name="name" value="">
          </div>
          <div class="mb-3">
            <label>Slug</label>
            <input type="text" class="form-control" name="slug" value="">
          </div>
          <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="3" value=""></textarea>
          </div>
          <button class="btn btn-primary">Save Category</button>
        </form>
      </div>
    </div>
  </div>

@endsection
