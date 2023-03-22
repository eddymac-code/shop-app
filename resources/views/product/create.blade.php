@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Add New</li>
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
          <form action="{{ route('create-product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" class="form-control @error('category')
                        border border-danger @enderror" id="category">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name')
                        border border-danger @enderror" value="{{ old('name') }}" id="name">
                        @error('name')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control @error('amount')
                        border border-danger @enderror" value="{{ old('amount') }}" id="amount">
                        @error('amount')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" name="unit" class="form-control @error('unit')
                        border border-danger @enderror" value="{{ old('unit') }}" id="unit" placeholder="E.g. Packets, Kg, Litre">
                        @error('unit')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="cost" class="form-label">Cost</label>
                        <input type="number" name="cost" class="form-control @error('cost')
                        border border-danger @enderror" value="{{ old('cost') }}" id="cost">
                        @error('cost')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control @error('price')
                        border border-danger @enderror" value="{{ old('price') }}" id="price">
                        @error('price')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control @error('quantity')
                        border border-danger @enderror" value="{{ old('quantity') }}" id="quantity">
                        @error('quantity')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" cols="30" class="form-control">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="mb-3 btn btn-primary">Save</button>
          </form>
        </div>
      </div>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection