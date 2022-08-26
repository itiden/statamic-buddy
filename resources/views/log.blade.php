@extends('statamic::layout')
@section('title', 'Buddy')

@section('content')

<buddy-log fetch-route="{{ cp_route('buddy.api.log') }}" deploy-route="{{ cp_route('buddy.api.deploy') }}">
</buddy-log>

@endsection
