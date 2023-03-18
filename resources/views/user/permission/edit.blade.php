@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Permission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item">Permissions</li>
              <li class="breadcrumb-item active">Edit Permission: {{ $permission->name }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="mx-auto my-4 col-md-6 shadow rounded">
            <div class="p-2 text-dark">
                <form action="{{ route('edit-permission', $permission) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" name="type" id="type">
                            <option value="0" @if($selected == 1) selected @endif>Parent Permission</option>
                            <option value="1" @if($selected == 1) selected @endif>Sub Permission</option>
                        </select>
                    </div>
                    <div class="mb-3" id="parent">
                        <label for="type" class="form-label">Parent</label>
                        <select class="form-select" name="parent_id">
                            @foreach ($parent_permission as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name')
                        border border-danger @enderror" value="{{ $permission->name }}" id="name">
                          @error('name')
                              <div class="text-danger mt-2 fs-6">
                                  {{ $message }}
                              </div>
                          @enderror
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea name="description" id="description" 
                      class="form-control" rows="3">{{ $permission->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script type="module">
    $(document).ready(function () {
        if ($('#type').val() == 0) {
            $('#parent').hide();
        } else {
            $('#parent').show();
        }
        $('#type').change(function () {
            if ($('#type').val() == 0) {
                $('#parent').hide();
            } else {
                $('#parent').show();
            }
        })
    })
  </script>
@endsection