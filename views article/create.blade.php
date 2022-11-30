@extends('cms.parent')

@section('title' , 'Article')

@section('main_title' , 'Create Article')

@section('sub_title' , 'create_Article')


@section('styles')

@endsection



@section('content')
<section class="container-fluid">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Data Of Article</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label  for="category_id">Category</label>
                  <select class="form-control select2" id="category_id"  name="category_id" style="width: 100%;">
                    {{-- <option selected="selected">Alabama</option> --}}
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
           </div>
        </div>

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Street">
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter Street">
          </div>
          <div class="form-group">
            <label for="full_description">Full Description</label>
            <input type="text" class="form-control" id="full_description" name="full_description" placeholder="Enter Street">
          </div>

          <div class="row">
            <div class="form-group col-md-6">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" placeholder="">
            </div>
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
        <a href="{{ route('articles.index') }}" type="button" class="btn btn-info">Return Back</a>
      </div>
    </form>
  </div>
</section>
@endsection


@section('scripts')
<script>
  function performStore(){
    let formData = new FormData();
    formData.append('title',document.getElementById('title').value);
    formData.append('short_description',document.getElementById('short_description').value);
    formData.append('full_description',document.getElementById('full_description').value);
    formData.append('image',document.getElementById('image').files[0]);
    formData.append('category_id',document.getElementById('category_id').value);

    store('/cms/admin/articles' , formData)
  }

</script>
@endsection
