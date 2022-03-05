@extends('layouts.app')
@section('content')

<form action="{{ route('task.store') }}" method="POST">
    @csrf

    @include('task.form', ['Mode' =>'create'])

</form>
@endsection