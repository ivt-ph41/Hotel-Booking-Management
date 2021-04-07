@extends('layouts.dashboard')
@section('title', 'Create room')

@section('content')
{{-- @if ($errors->any())
@php
dd($errors->all());
@endphp
@endif --}}
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- general form elements -->
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title">Form Create Room</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admins.room.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Eg: 001">
                        </div>
                        @if($errors->has('name'))
                        <p class="text-bold text-danger">{{$errors->first('name')}}</p>
                        @endif
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" value="{{old('description')}}" class="form-control" id="description" placeholder="Description">
                        </div>
                        @if($errors->has('description'))
                        <p class="text-bold text-danger">{{$errors->first('description')}}</p>
                        @endif
                        <div class="form-group">
                            <label for="size">Size(ft)</label>
                            <input type="text" name="size" value="{{old('size')}}" class="form-control" id="size" placeholder="Eg 10ft">
                        </div>
                        @if($errors->has('size'))
                        <p class="text-bold text-danger">{{$errors->first('size')}}</p>
                        @endif
                        <div class="form-group">
                            <label for="price">Price/day</label>
                            <input type="text" name="price" value="{{old('price')}}" class="form-control" id="price" placeholder="Price per day">
                        </div>
                        @if($errors->has('price'))
                        <p class="text-bold text-danger">{{$errors->first('price')}}</p>
                        @endif
                        <!-- select -->
                        <div class="form-group">
                            <label>Person/room</label>
                            <select name="person_room_id" class="custom-select">
                                @foreach($person_rooms as $person_room)
                                <option value="{{$person_room->id}}">{{$person_room->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Bed</label>
                            <select name="bed_id" class="custom-select">
                                @foreach($beds as $bed)
                                <option value="{{$bed->id}}">{{$bed->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Type of room</label>
                            <select name="type_id" class="custom-select">
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Room image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="images[]" multiple class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Select at least 4 pictures</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        @if($errors->has('images'))
                        <p class="text-bold text-danger">{{$errors->first('images')}}</p>
                        @endif
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

        <!-- <div class="col-md-6">
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{session()->get('success')}}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{session()->get('error')}}
            </div>
            @endif
        </div> -->
    </div>
</div>
@endsection
<!-- Script -->
@section('js')
@if(session()->has('success'))
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
        toastr.success('Create room sucess!', 'Notification');
    });
</script>
@endif
@if(session()->has('error'))
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
        toastr.error('Some thing error please try again!', 'Notification');
    });
</script>
@endif
@endsection