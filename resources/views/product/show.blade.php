@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Products</li>
              <li class="breadcrumb-item active">{{ $product->name }}</li>  
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
                        <img style="width:150px" class="rounded" src="{{ asset('storage/images/products/'.$product->image) }}" alt="">
                    </div>
                    <div>
                        <p class="lean">Total remaining stock is {{ $product->quantity }} 
                            {{ Str::plural('unit', $product->quantity) }}</p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-group p-2">
                    <li class="list-group-item"><strong>Name: {{ $product->name }} {{ $product->amount }} {{ $product->unit }}</strong></li>
                    <li class="list-group-item"><strong>Description: </strong><p>{{ $product->description }}</p></li>
                    <li class="list-group-item"><strong>Price: </strong>{{ number_format($product->price, 2) }} Each</li>
                    <li class="list-group-item"><strong>Expected Profit: </strong>
                        @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                            {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }} {{ number_format(\App\Helpers\GeneralHelper::get_expected_profit($product), 2) }}</li>
                        @else
                        {{ number_format(\App\Helpers\GeneralHelper::get_expected_profit($product), 2) }} {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</li>
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