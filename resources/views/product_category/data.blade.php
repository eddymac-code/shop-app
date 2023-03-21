@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (session('success'))
            <div class="bg-success text-light rounded px-4 py-3 mb-3 text-center">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-danger text-light rounded px-4 py-3 mb-3 text-center">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-3">
          <a href="{{ route('create-category') }}" class="btn btn-primary mb-3 float-right">Add Category</a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $i=0 ?>
                @if (!$data->count())
                    <tr>
                        <td colspan="5" class="text-center">No data available.</td>
                    </tr>
                @else
                    @foreach ($data as $category)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $category->name }}</td>
                            <td><img style="width:50px" src="{{ asset('storage/images/product_category/'.$category->image) }}" alt="Category Image"></td>
                            <td>{{ $category->description }}</td>
                            <td>
                              <a href="{{ route('show-category', $category) }}" class="btn btn-outline-primary">Show</a>
                              <a href="{{ route('edit-category', $category) }}" class="btn btn-outline-info">Edit</a>
                              <form action="{{ route('delete-category', $category) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirm('Are you sure?')" class="btn btn-outline-danger">Delete</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection