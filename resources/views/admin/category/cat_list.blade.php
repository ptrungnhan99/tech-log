@extends('admin.layout.master')
@section('title')
    List Category
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
                    </h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('alert'))
                        <div class="alert alert-danger">
                            {{ session('alert') }}
                        </div>
                    @endif
                    <a href="{{ url('/admin/category/create') }}" class="btn btn-success"
                        style="margin-bottom:20px;">Create</a>
                </div>

                <!-- /.col-lg-12 -->
                <div class="col-lg-4">
                    <div class="">
                        <h4>Category Management</h4>
                        {{-- <ul id="tree-category">
                            @foreach ($data_select as $key => $value)
                                <li>{{ $value }}</li>
                            @endforeach
                        </ul> --}}
                        <?php showCategories($categories); ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            ?>
                            @if ($categories)
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td class="center">
                                            <a href="{{ url('/admin/category/edit/' . $category->id) }}"><i
                                                    class="fa fa-pencil fa-fw"></i> Edit</a>
                                        </td>
                                        <td class="center">
                                            <form action="{{ url('/admin/category/delete/' . $category->id) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" type="submit"><i
                                                        class="fa fa-trash-o  fa-fw"></i>
                                                    Delete</button>
                                            </form>
                                        </td>
                                        {{-- <td class="center">
                                    <button data-id="{{ $category->id }}" class="btn-delete-cat btn btn-danger"><i
                                            class="fa fa-trash-o  fa-fw"></i>Delete</button>
                                </td> --}}
                                    </tr>
                                    <?php $i++;
                                    ?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        // $(document).ready(function() {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     loadListCategory();

        //     function loadListCategory() {
        //         $.ajax({
        //             url: "/ajax/admin/category",
        //             type: "GET",
        //             success: function(respond) {
        //                 //console.log();
        //                 var dataSet = respond.result[0];
        //             }
        //         });
        //     }
        //     $('.btn-delete-cat').click(function() {
        //         var cat_id = $(this).attr('data-id');
        //         $.ajax({
        //             url: "/admin/category/delete/" + cat_id,
        //             type: "DELETE",
        //             success: function(respond) {
        //                 console.log(respond.status);
        //                 if (respond.status === 'Ok') {
        //                     var vMessages = "Deleted successfully";
        //                     toastr["success"](vMessages);
        //                 } else if (respond.status === 'subcategory') {
        //                     var vMessages = "Please delete all sub categories first !!!!";
        //                     toastr["error"](vMessages);
        //                 } else {
        //                     var vMessages = "There was an error in processing";
        //                     toastr["error"](vMessages);
        //                 }
        //             }
        //         });
        //     })
        // });
    </script>
@endsection
