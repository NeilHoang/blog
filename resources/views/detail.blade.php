@extends('layout.layout')
@section('title',$detail->title)
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-5">
                @if(Session::has('msg'))
                    <p class="text-success">{{session('msg')}}</p>
                @endif
                <div class="card">
                    <h5 class="card-header">
                        {{$detail->title}}
                        <button type="button" style="float: right" class="btn btn-outline-info">Views:
                            <span class="badge bg-secondary">{{$detail->views}}</span>
                        </button>
                    </h5>

                    <img src="{{asset("upload/imagePost/".$detail->image)}}" class="card-img-top"
                         alt="{{$detail->title}}">
                    <div class="card-body">
                        {{$detail->detail}}
                    </div>
                    <div class="card-footer">
                      In  <a href="">{{$detail->category->title}}</a>
                    </div>
                </div>
            </div>
            {{--            Add Comment--}}
            @auth
                <div class="card mb-5">
                    <h5 class="card-header">Add Comment</h5>
                    <div class="card-body">
                        <form method="POST"
                              action="{{url('save-comment/'.\Illuminate\Support\Str::slug($detail->title).'/'.$detail->id)}}">
                            @csrf
                            <textarea name="comment" class="form-control"></textarea>
                            <button class="btn btn-outline-dark mt-3">Comment</button>
                        </form>
                    </div>
                </div>
            @endauth
            {{--            Fetch Comments--}}
            <div class="card my-4">
                <h5 class="card-header">Comments <span class="badge bg-dark">{{count($detail->comments)}}</span></h5>
                <div class="card-body">
                    @if($detail->comments)
                        @foreach($detail->comments as $comment)
                            <blockquote class="blockquote">
                                <p class="mb-0">{{$comment->comment}}</p>
                                <p></p>
                                @if($comment->user_id == 0)
                                    <footer class="blockquote-footer">Admin</footer>
                                @else
                                    <footer class="blockquote-footer">{{$comment->user->name}}</footer>
                                @endif
                            </blockquote>
                            <hr/>
                        @endforeach
                    @endif
                </div>
            </div>
            {{--        Right Sidebar--}}
        </div>
        <div class="col-md-4 ms-auto mt-0">
            <!-- Search -->
            <div class="card mb-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"/>
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button" id="button-addon2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{--        Recent Posts--}}
            <div class="card mb-4">
                <h5 class="card-header">Recent Posts</h5>
                <div class="list-group list-group-flush">
                    @if($recent_posts)
                        @foreach($recent_posts as $post)
                            <a href="{{url(url('detail/'.\Illuminate\Support\Str::slug($post->title).'/'.$post->id))}}"
                               class="list-group-item" style="color: #0dcaf0">{{$post->title}}</a>
                        @endforeach
                    @endif
                </div>
                <!-- Popular Posts -->
                <div class="card mb-4">
                    <h5 class="card-header">Popular Posts</h5>
                    <div class="list-group list-group-flush">
                        @if($popular_posts)
                            @foreach($popular_posts as $post)
                                <a href="{{url(url('detail/'.\Illuminate\Support\Str::slug($post->title).'/'.$post->id))}}"
                                   class="list-group-item" style="color: #0dcaf0">{{$post->title}}<span
                                        class="badge bg-danger" style="float: right">{{$post->views}}</span></a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>

@endsection
