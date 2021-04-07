@extends('layouts.dashboard')
@section('title', 'Manager comments')

@section('content')
{{-- <div class="container">
  <div class="row justify-content-end">
    <div class="col-3"></div>
    <div class="col-3"></div>
    <div class="col-3"></div>
    <div class="col-3">
      <a href="{{route('admins.comments.index')}}" id="list-comments" class="btn bg-gradient-cyan">List comments</a>
</div>
</div>
</div> --}}

<div class="container">
  @if(session()->has('status'))
  <div class="row">
    <div class="col">
      <p class="text-success text-bold text-capitalize">{{session()->get('status')}}</p>
    </div>
  </div>
  @endif
  <div class="row">
    <div id="result" class="">
      @isset($comments)
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Manager comment table</h3>
          <div class="card-tools">

            <form action="{{ route('admins.comments.manager')}}" method="get">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{__('Email')}}</th>
                <th>{{__('Room')}}</th>
                <th>{{__('Content')}}</th>
                <th>{{__('Action')}}</th>

              </tr>
            </thead>
            <tbody>
              @foreach($comments as $comment)
              <tr>
                <td class="text-danger">{{$comment->user->email}}</td>
                <td>{{$comment->room->name}}</td>
                <td>{{{$comment->content}}}</td>
                <td>
                  <!-- Split dropright button -->
                  <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary">
                      Action
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">
                      <div class="dropdown-divider"></div>
                      <form action="{{route('admins.comments.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Delete" class="btn">
                      </form>
                    </div>
                  </div>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            {{$comments->links()}}
          </ul>
        </div>
      </div>
      @endisset()
    </div>
  </div>
</div>

@endsection
{{-- @section('script')


 <script>
   $(document).ready(function () {
    $("#list-comments").click(function (e) {
      e.preventDefault();
      var url = "{{route('admins.comments.index')}}";
console.log('URL: ', url);
// alert('OK');
$.ajax({
type: "get",
url: url,
data: "comments",
dataType: "json",
success: function (response) {
var html = '';
console.log(response);
html+=
'<table class="table table-bordered">'+
  '<thead>'+
    '<tr>'+
      '<th scope="col">Email</th>'+
      '<th scope="col">RoomName</th>'+
      '<th scope="col">Content</th>'+
      '<th scope="col">Action</th>'+
      '</tr>'+
    '</thead>'+
  '<tbody>'
    $.each(response, function (item, value) {
    +'<tr>'+
      '<td>' + value.user.email + '</td>'+
      '<td>' + value.room.name + '</td>'+
      '<td>' + value.content + '</td>'+
      '<td>'+
        '<form action="admins/manager/comments/' + value.id + '" method="POST">'+
          '@csrf'
          '@method("DELETE")'
          '<input class="btn btn-danger" value="Delete" type="submit">'+
          '</form>'+
        '</td>'+
      '</tr>'
    });
    +'</tbody>'+
  '</table>';
$("#result").html('');
$("#result").append(html);
}
});
});
});
</script>
@endsection --}}