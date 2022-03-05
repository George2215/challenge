@extends('layouts.app')
@section('content')
    <form action="{{ route('task.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        @include('task.form', ['Mode' =>'edit'])
    </form>
@endsection