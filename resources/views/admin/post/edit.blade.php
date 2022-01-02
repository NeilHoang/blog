@extends('layout.admin')
@section('page-heading','Update Category')
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
            <div class="text-success" style="text-align: center">
                {{ session()->get('msg') }}
                @endif
                <form method="post" action="{{route('post.update',$posts->id)}}" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Category<span class="text-danger">*</span></th>
                            <td>
                                <select name="category" class="form-control">
                                    @foreach($cates as $cate)
                                        <option @if($posts->category_id ==$cate->id) selected
                                                @endif value="{{$cate->id}}">{{$cate->title}}</option>
                                    @endforeach
                                    <option value="0">--- Select ---</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td><input type="text" value="{{$posts->title}}" name="title" class="form-control"/></td>
                        </tr>
                        <tr>
                            <th>Thumb</th>
                            <td>
                                <p class="my-2"><img src="{{asset("upload/imagePostThumb/".$posts->thumb)}}" width="100"
                                    /></p>
                                <input type="hidden" value="{{$posts->thumb}}" name="post_thumb"/>
                                <input type="file" name="post_thumb"/>
                            </td>
                        </tr>
                        <tr>
                            <th>Full Image</th>
                            <td>
                                <p class="my-2"><img src="{{asset("upload/imagePost/".$posts->image)}}" width="100"
                                    /></p>
                                <input type="hidden" value="{{$posts->image}}" name="post_image"/>
                                <input type="file" name="post_image"/>
                            </td>
                        </tr>
                        <tr>
                            <th>Detail<span class="text-danger">*</span></th>
                            <td>
                                <textarea class="form-control" name="detail">{{$posts->detail}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                <textarea class="form-control" name="tags">{{$posts->tags}}</textarea>
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


