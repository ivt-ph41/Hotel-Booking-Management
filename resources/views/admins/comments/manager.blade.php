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
  <div class="row">
    <div id="result" class="col-12">
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
                      <form action="{{route('admins.comments.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Delete" class="btn btn-danger">
                      </form>
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

@section('js')
@if(session()->has('status'))
<script>
  $(function() {
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success('Delete success!', 'Notification');
  });
</script>
@endif
@if(session()->has('no result found'))
<script>
  $(function() {
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.info('No result found!', 'Notification');
  });
</script>
@endif
@endsection