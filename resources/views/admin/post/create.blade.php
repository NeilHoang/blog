@extends('layout.admin')
@section('page-heading','Add Post')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Add CATEGORY
            <a href="{{route('post.index')}}" class=" btn btn-sm btn-dark " style="float:right">View All</a>
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
                <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Category<span class="text-danger">*</span></th>
                            <td>
                                <select class="form-control" name="category">
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Title<span class="text-danger">*</span></th>
                            <td><input type="text" name="title" class="form-control"/></td>
                        </tr>
                        <tr>
                            <th>Thumbnail</th>
                            <td><input type="file" name="post_thumb"/></td>
                        </tr>
                        <tr>
                            <th>Full Image</th>
                            <td><input type="file" name="post_image"/></td>
                        </tr>
                        <tr>
                            <th>Detail<span class="text-danger">*</span></th>
                            <td>
                                <textarea class="form-control" name="detail"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                <textarea class="form-control" name="tags"></textarea>
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


