@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Products</li>
              <li class="breadcrumb-item">Categories</li>
              <li class="breadcrumb-item active">{{ $productCategory->name }}</li>  
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
        <div class="panel">
            <div class="panel-heading">
                <div class="d-flex justify-content-between p-3">
                    <div>
                        <img style="width:150px" class="rounded" src="{{ asset('storage/images/product_category/'.$productCategory->image) }}" alt="">
                    </div>
                    <div>
                        <p class="lean">This category has {{ $productCategory->products->count() }} 
                            {{ Str::plural('product', $productCategory->products->count()) }}</p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-group p-2">
                    @if(!$productCategory->products)
                        <li class="list-group-item">No products here yet.</li>
                    @else
                        @foreach ($productCategory->products as $product)
                            <li class="list-group-item"><a href="{{ route('show-product', $product->id) }}">
                                {{ $product->name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
      </div>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection