@extends('layout.admin')
@section('page-heading','Setting')
@section('content')
    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i> Manage Settings
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    @if($errors)
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{$error}}</p>
                        @endforeach
                    @endif

                    @if(session()->has('msg'))
                        <div class="text-success">
                            {{ session()->get('msg') }}
                            @endif

                            <form method="POST" action="{{route('setting.save')}}">
                                @csrf
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Comment Auto Approve</th>
                                        <td><input @if($setting) value="{{$setting->comment_auto}}" @endif type="text"
                                                   name="comment_auto" class="form-control"/></td>

                                    </tr>
                                    <tr>
                                        <th>User Auto Approve</th>
                                        <td><input @if($setting) value="{{$setting->user_auto}}" @endif type="text"
                                                   name="user_auto" class="form-control"/></td>

                                    </tr>
                                    <tr>
                                        <th>Recent Post Limit</th>
                                        <td><input @if($setting) value="{{$setting->recent_limit}}" @endif type="text"
                                                   name="recent_limit" class="form-control"/></td>

                                    </tr>
                                    <tr>
                                        <th>Popular Post Limit</th>
                                        <td><input @if($setting) value="{{$setting->popular_limit}}" @endif type="text"
                                                   name="popular_limit" class="form-control"/></td>

                                    </tr>
                                    <tr>
                                        <th>Recent Comments Limit</th>
                                        <td><input @if($setting) value="{{$setting->recent_comment_limit}}" @endif
                                            type="text" name="recent_comment_limit" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" class="btn btn-outline-primary"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                </div>
            </div>

        </div>
@endsection


