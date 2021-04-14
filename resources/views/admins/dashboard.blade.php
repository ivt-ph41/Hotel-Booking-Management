@extends('layouts.dashboard')
@section("content")
<h2>
Welcome {{\Auth::user()->profile->name}}
</h2>
@endsection