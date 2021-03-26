@extends('layouts.dashboard')
@section('title', 'Manager booking')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-orange">
                        <h3 class="card-title">Manager booking of users</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                       placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Room</th>
                                <th>Price/Day</th>
                                <th>Date start</th>
                                <th>Date end</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($booking_details)
                                @foreach($booking_details as $booking_detail)
                                    <tr>
                                        <td>{{$booking_detail->booking->user->email}}</td>
                                        <td>{{$booking_detail->room->name}}</td>
                                        <td>
                                            {{$booking_detail->room->price}}
                                        </td>
                                        <td>{{$booking_detail->date_start}}</td>
                                        <td>{{$booking_detail->date_end}}</td>
                                        <td>
                                            <form class="form-inline">
                                                <div class="form-check">
                                                    <select class="form-control">
                                                        <option value="{{\App\Entities\Booking::PENDING_STATUS}}">
                                                            {{__('Pending')}}
                                                        </option>
                                                        <option  value="{{\App\Entities\Booking::APPROVE_STATUS}}">
                                                            {{__('Approve')}}
                                                        </option>
                                                        <option value="{{\App\Entities\Booking::CANCEL_STATUS}}">
                                                            {{__('Cancel')}}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-check ml-5">
                                                    <button class="btn btn-success">Confirm</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @endisset
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
