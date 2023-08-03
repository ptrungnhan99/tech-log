@extends('admin.layout.master')
@section('title')
    List User
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>List</small>
                    </h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <a href="{{ url('/admin/user/create') }}" class="btn btn-success" style="margin-bottom:20px;">Create</a>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align:center;">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Avartar</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($users as $user)
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <img width="150px" class="img-thumbnail"
                                        src="{{ asset('/public/images/' . $user->avatar) }}" alt="">
                                </td>
                                <td>
                                    @if ($user->is_admin == 1)
                                        <button class="btn btn-success">Admin</button>
                                    @else
                                        <button class="btn btn-info">User</button>
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                        href="{{ url('/admin/user/edit/' . $user->id) }}">Edit</a></td>
                                <td class="center">
                                    <form action="{{ url('/admin/user/delete/' . $user->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o  fa-fw"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
