@extends('layouts.app')

@section('content')

<div class="container">
    <a class="btn btn-primary btn-sm mb-5" href="{{ route('task.create') }}">Crear Tarea</a>

    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tarea</th>
                <th scope="col">Breve Descripción</th>
                <th scope="col">Usuario Asignado</th>
                <th scope="col">Fecha Limite Entrega</th>
                <th scope="col">Comentarios</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        @isset($tasks)
            <tbody>
                @foreach ($tasks as $task)
                    @if( $task->end_date < $date )
                        <input type="hidden" value="{{ $color = "#e4606d!important" }}">
                        <input type="hidden" value="{{ $textColor = "#fff !important" }}">
                    @else
                        <input type="hidden" value="{{ $color = "#f8f9fa!important" }}">
                        <input type="hidden" value="{{ $textColor = "#000 !important" }}">
                    @endif
    
                <tr style="background-color:{{ $color }}; color: {{ $textColor }}">
                    <th scope="row">{{ $task->id}}</th>
                    <td>{{ $task->name}}</td>
                    <td>{{ $task->description}}</td>
                    <td>{{ $task->user->name}}</td>
                    <td>{{ $task->end_date}}</td>
                    <td>
                        @foreach ($task->logs as $log )
                        <ul>
                            <li>{{ $log->comment }} {{ $log->date_comment }}</li>
                        </ul>
                        @endforeach
                    </td>
                    @if (Auth::id() == $task->user_id)
                        <td class="d-flex align-items-end">
                            <a class="btn btn-primary btn-sm" href="{{ route('task.edit', $task->id) }}">
                                <span class="material-icons" style="font-size: 15px">
                                    edit
                                </span>
                            </a>
                            <a class="btn btn-light btn-sm ml-2" href="{{ route('task.show', $task->id) }}">
                                <span class="material-icons" style="font-size: 15px">
                                    visibility
                                </span>
                            </a>
                            
                            <form action="{{ route('task.destroy', [$task->id] ) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-warning btn-sm ml-2" type="submit">
                                    <span class="material-icons" style="font-size: 15px">
                                        delete
                                        </span>
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            {{ $tasks->links() }}
        @endisset
    </table>
</div>
@endsection