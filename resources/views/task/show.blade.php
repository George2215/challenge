@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h4 class="text-center">Mostrar Tarea</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <input type="text" 
                    class="form-control form-control-sm" 
                    placeholder="Nombre Tarea"
                    disabled
                    value="{{ $task->name }}">
            </div>
            <div class="form-group">
                <input class="form-control form-control-sm " type="text"
                    disabled
                    value="{{ $task->description }}">
            </div>
            <div class="form-group">
                <input type="text" class="date form-control-sm datepicker"
                    disabled
                    value="{{ $task->end_date }}"
                >
            </div>
            <select class="form-control-sm" name="user_id" disabled>
                <option disabled selected value>--- Asigne Usuario ---</option>
                @foreach ($users as $key => $value)
                    <option value="{{ $key }}" {{ ( $key == $selectedUserId) ? 'selected' : ''}}> 
                        {{ $value }}
                    </option>
                @endforeach
            </select>

            <div class="mt-3">
                <a class="btn btn-secondary btn-sm mt-2" href="{{ route('home') }}">Regresar</a>
            </div>
        </div>
    </div>
</div>

@endsection