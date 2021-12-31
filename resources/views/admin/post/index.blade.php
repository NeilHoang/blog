@extends('layout.admin')
@section('page-heading','Category')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable CATEGORY
            <a href="{{route('category.create')}}" class=" btn btn-sm btn-dark " style="float:right">Add Data</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr style="text-align: center;vertical-align: middle">
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($categories as $cate)
                    <tr style="text-align: center;vertical-align: middle">
                        <td>{{$cate->id}}</td>
                        <td>{{$cate->title}}</td>
                        <td><img src="{{asset("upload/imageCate/".$cate->image)}}" width="100" /></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{route('category.edit',$cate->id)}}">Update</a>
                            <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm" href="{{route('category.destroy',$cate->id)}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection



