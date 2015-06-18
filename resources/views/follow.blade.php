@extends('layout')

@section('title', isset($final) ? "$final | " : '')

@section('content')
    @parent
@endsection
