@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('update-settings') }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="name" class="form-label">Shop Name</label>
                <input type="text" name="shop_name" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_name')->first()->setting_value }}">
              </div>
              <div class="col-md-6">
                <label for="address" class="form-label">Shop Address</label>
                <input type="text" name="shop_address" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_address')->first()->setting_value }}">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="country" class="form-label">Shop Country</label>
                <input type="text" name="shop_country" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_country')->first()->setting_value }}">
              </div>
              <div class="col-md-6">
                <label for="city" class="form-label">Shop City</label>
                <input type="text" name="shop_city" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_city')->first()->setting_value }}">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="pcode" class="form-label">Shop Post Code</label>
                <input type="text" name="shop_zip" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_zip')->first()->setting_value }}">
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Shop Email</label>
                <input type="text" name="shop_email" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_email')->first()->setting_value }}">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="web" class="form-label">Shop Website</label>
                <input type="text" name="shop_website" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_website')->first()->setting_value }}">
              </div>
              <div class="col-md-6">
                <label for="pin" class="form-label">Shop KRA Pin</label>
                <input type="text" name="shop_pin" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_pin')->first()->setting_value }}">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="currency" class="form-label">Currency</label>
                <input type="text" name="shop_currency" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'shop_currency')->first()->setting_value }}">
              </div>
              <div class="col-md-6">
                <label for="symbol" class="form-label">Currency Symbol</label>
                <input type="text" name="currency_symbol" class="form-control" 
                value="{{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="position" class="form-label">Currency Position</label>
                <select class="form-select" name="currency_position" aria-label="Select currency position">
                  <option> --Select-- </option>
                  <option value="left" @if( \App\Models\Setting::where(
                    'setting_key', 'currency_position')->first()->setting_value == 'left') selected @endif>
                    Left
                  </option>
                  <option value="right" @if( \App\Models\Setting::where(
                    'setting_key', 'currency_position')->first()->setting_value == 'right') selected @endif>
                    Right
                  </option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" name="shop_logo" class="form-control">
              </div>
            </div>
          </div>
          <button type="submit" class="mb-3 btn btn-primary float-end">Update</button>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection