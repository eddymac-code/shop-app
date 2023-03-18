@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assign Permissions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item">Roles</li>
              <li class="breadcrumb-item active">Assign Permissions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="mx-auto my-4 col-md-10 shadow rounded">
            <div class="p-2 text-dark">
                @if (!$data)
                    <div class="card">
                        <div class="card-body">
                            <p class="lean">No permissions to assign.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('create-permission') }}" class="btn btn-primary float-right">Create Permissions</a>
                        </div>
                    </div>
                @else
                <div class="panel">
                    <form action="{{ route('assign-permissions', $role) }}" method="post">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Permission</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Assigned?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $permission)
                                                    <div class="mb-3">
                                                    <tr>
                                                        <td>
                                                            @if ($permission->parent_id == 0)
                                                                <strong>{{ $permission->name }}</strong>
                                                            @else
                                                                __{{ $permission->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $permission->description }}</td>
                                                        <td>
                                                            <input type="checkbox" name="permission_id[]"
                                                            value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked @endif>
                                                        </td>
                                                    </tr>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Permission</th>
                            <th scope="col">Description</th>
                            <th scope="col">Assigned?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('assign-permissions', $role) }}" method="post">
                            @foreach ($data as $permission)
                                <div class="mb-3">
                                <tr>
                                    <td>
                                        @if ($permission->parent_id == 0)
                                            <strong>{{ $permission->name }}</strong>
                                        @else
                                            __{{ $permission->name }}
                                        @endif
                                    </td>
                                    <td>{{ $permission->description }}</td>
                                    <td>
                                        <input type="checkbox" name="permission_id[]"
                                        value="{{ $permission->id }}" @if($role->permissions->contains($permission_id)) checked @endif>
                                    </td>
                                </tr>
                                </div>
                            @endforeach
                            <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </tbody>
                </table> --}}
                @endif
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection