@extends('admin.layout.master')
@section('title')
    List Post
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post
                        <small>List</small>
                    </h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="text-align:center;">
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>HighLight</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($posts as $post)
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td>
                                    <img width="150px" class="img-thumbnail"
                                        src="{{ asset('/public/images/' . $post->thumbnail) }}" alt="">
                                </td>
                                <td><a href="{{ url('/admin/post/edit/' . $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @if ($post->highlight)
                                        <button class="btn btn-primary">True</button>
                                    @else
                                        <button class="btn btn-warning">False</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($post->status)
                                        <button class="btn btn-primary">Publish</button>
                                    @else
                                        <button class="btn btn-warning">Draft</button>
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                        href="{{ url('/admin/post/edit/' . $post->id) }}">Edit</a></td>
                                <td class="center">
                                    <form action="{{ url('/admin/post/delete/' . $post->id) }}" method="post">
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
                {{ $posts->links() }}
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
