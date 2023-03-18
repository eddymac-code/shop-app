@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">User: {{ $user->name }}</li>
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
                <h2>{{ $user->name }}</h2>
               </div>
               <div class="card-body">
                <p class="lean">This user has {{ $user->roles->count() }} {{ Str::plural('role', $user->roles->count()) }}.</p>
               </div>
               <div class="card-footer">
                <a href="{{ route('assign-roles', $user) }}" class="btn btn-primary float-right">Assign Roles</a>
               </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection