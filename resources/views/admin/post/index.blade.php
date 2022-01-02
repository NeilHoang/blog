@extends('layout.admin')
@section('page-heading','Post')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable CATEGORY
            <a href="{{route('post.create')}}" class=" btn btn-sm btn-dark " style="float:right">Add Data</a>
        </div>
        <div class="card-body">
            @if(session()->has('msg'))
                <div class="text-success">
                    {{ session()->get('msg') }}
                    @endif
            <table id="datatablesSimple">
                <thead>
                <tr style="text-align: center;vertical-align: middle">
                    <th>#</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Full</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Full</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($posts as $post)
                    <tr style="text-align: center;vertical-align: middle">
                        <td>{{$post->id}}</td>
                        <td>{{$post->category->title}}</td>
                        <td>{{$post->title}}</td>
                        <td><img src="{{asset("upload/imagePostThumb/".$post->thumb)}}" width="100" /></td>
                        <td><img src="{{asset("upload/imagePost/".$post->image)}}" width="100" /></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{route('post.edit',$post->id)}}">Update</a>
                            <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm" href="{{route('post.destroy',$post->id)}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection



