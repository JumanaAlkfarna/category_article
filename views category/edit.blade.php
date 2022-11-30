@extends('cms.parent')

@section('title' , 'Category')

@section('main_title' , 'Edit Category')

@section('sub_title' , 'edit_Category')


@section('styles')

@endsection



@section('content')
<section class="container-fluid">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Data Of Category</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
        <div class="form-group">
          <label for="name">Category Name</label>
          <input type="text" class="form-control" id="name"
          value="{{ $categories->name }}" name="name" placeholder="Enter Category Name">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="description"
          value="{{ $categories->description }}"  name="description" placeholder="Enter Category Description">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="performUpdate({{ $categories->id }})" class="btn btn-primary">Update</button>
        <a href="{{ route('categories.index') }}" type="button" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</section>
@endsection


@section('scripts')
<script>
    function performUpdate(id){
      let formData = new FormData();
      formData.append('name',document.getElementById('name').value);
      formData.append('description',document.getElementById('description').value);

      storeRoute('/cms/admin/update-categories/'+id , formData);
    }

  </script>
@endsection
