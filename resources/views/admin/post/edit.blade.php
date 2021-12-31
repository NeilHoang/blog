@extends('layout.admin')
@section('page-heading','Update Category')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Add CATEGORY
            <a href="{{route('category.index')}}" class=" btn btn-sm btn-dark " style="float:right">View All</a>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(session()->has('msg'))
            <div class="text-success" style="text-align: center">
                {{ session()->get('msg') }}
                @endif
        <form method="post" action="{{route('category.update',$categories->id)}}" enctype="multipart/form-data">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>Title</th>
                    <td><input type="text" name="title" class="form-control" value="{{$categories->title}}"/></td>
                </tr>
                <tr>
                    <th>Detail</th>
                    <td><input type="text" name="detail" class="form-control" value="{{$categories->detail}}"/></td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><input type="file" name="image"/>
                        <input type="hidden" name="prev_photo" value="{{$categories->image}}"/>
                        <img src="{{asset("upload/imageCate/".$categories->image)}}"
                             width="100px" height="100px"><br><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn btn-outline-primary"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection


