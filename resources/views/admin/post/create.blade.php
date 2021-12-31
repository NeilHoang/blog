@extends('layout.admin')
@section('page-heading','Add Category')
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
            <div class="text-danger">
                {{ session()->get('msg') }}
                @endif
        <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>Title</th>
                    <td><input type="text" name="title" class="form-control" /></td>
                </tr>
                <tr>
                    <th>Detail</th>
                    <td><input type="text" name="detail" class="form-control" /></td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn btn-outline-primary" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection


