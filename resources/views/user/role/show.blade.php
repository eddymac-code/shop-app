@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item">Roles</li>
              <li class="breadcrumb-item active">{{ $role->name }}</li>
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
            <div class="card p-2 text-dark">
              @if (session('success'))
                  <div class="bg-success text-light rounded px-4 py-3 mb-3 text-center">
                      {{ session('success') }}
                  </div>
              @endif
               <div class="card-header">
                <h2>{{ $role->name }}</h2>
                <div class="mb-3">
                  <a href="{{ route('roles') }}" class="btn btn-info mb-3 float-right">Back</a>
                </div>
               </div>
               <div class="card-body">
                <p class="lean">This role has {{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }}.</p>
               </div>
               <div class="card-footer">
                <a href="{{ route('assign-permissions', $role) }}" class="btn btn-primary float-right">Assign Permissions</a>
               </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection