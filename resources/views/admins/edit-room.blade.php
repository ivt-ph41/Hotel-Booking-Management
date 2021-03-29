@extends('layouts.dashboard')
@section('title', 'Edit room')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-gray-dark">
        <div class="card-header">
          <h3 class="card-title">Form Edit Room</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admins.room.update', $room->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" value="{{$room->name}}" class="form-control" id="name"
                placeholder="Eg: 001">
            </div>
            @if($errors->has('name'))
            <p class="text-bold text-danger">{{$errors->first('name')}}</p>
            @endif
            <div class="form-group">
              <label for="description">Description</label>
              <input type="text" name="description" value="{{$room->description}}" class="form-control" id="description"
                placeholder="Description">
            </div>
            @if($errors->has('description'))
            <p class="text-bold text-danger">{{$errors->first('description')}}</p>
            @endif
            <div class="form-group">
              <label for="size">Size(ft)</label>
              <input type="text" name="size" value="{{$room->size}}" class="form-control" id="size"
                placeholder="Eg 10ft">
            </div>
            @if($errors->has('size'))
            <p class="text-bold text-danger">{{$errors->first('size')}}</p>
            @endif
            <div class="form-group">
              <label for="price">Price/day</label>
              <input type="text" name="price" value="{{$room->price}}" class="form-control" id="price"
                placeholder="Price per day">
            </div>
            @if($errors->has('price'))
            <p class="text-bold text-danger">{{$errors->first('price')}}</p>
            @endif
            <!-- select -->
            <div class="form-group">
              <label>Person/room</label>
              <select name="person_room_id" class="custom-select">
                @foreach($person_rooms as $person_room)
                <option {{$room->person_room_id == $person_room->id ? 'selected' : null}} value="{{$person_room->id}}">
                  {{$person_room->name}}</option>
                @endforeach
              </select>
            </div>
            <!-- select -->
            <div class="form-group">
              <label>Bed</label>
              <select name="bed_id" class="custom-select">
                @foreach($beds as $bed)
                <option {{$room->bed_id == $bed->id ? 'selected' : null}} value="{{$bed->id}}">{{$bed->name}}</option>
                @endforeach
              </select>
            </div>
            <!-- select -->
            <div class="form-group">
              <label>Type of room</label>
              <select name="type_id" class="custom-select">
                @foreach($types as $type)
                <option {{$room->type_id == $type->id ? 'selected' : null}} value="{{$type->id}}">{{$type->name}}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-outline-success">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
    {{--Show result--}}
    <div class="col-md-6">
      @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{session()->get('success')}}
      </div>
      @elseif(session()->has('error'))
      <div class="alert alert-danger" role="alert">
        {{session()->get('error')}}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection