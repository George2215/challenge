<div class="container">
    <div class="col col-sm-6 col-md-6 col-lg-6 margin-tb">
        <div class="pull-left">
            <h4 class="text-center">{{ $Mode=='create' ? 'Crear Tarea' : 'Editar Tarea' }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <input type="text" name="name" 
                    class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : ''}}" 
                    placeholder="Nombre Tarea"
                    value="{{ isset($task->name) ? $task->name : old('name') }}">
                    <div class="invalid-feedback">Este campo es requerido</div>
            </div>
            <div class="form-group">
                <input class="form-control form-control-sm {{ $errors->has('description') ? 'is-invalid' : ''}}" type="text" name="description" 
                    placeholder="Breve Descripción"
                    value="{{ isset($task->description) ? $task->description : old('description') }}">
                <div class="invalid-feedback">Este campo es requerido</div>
            </div>
            <div class="form-group">
                <input type="text" class="date form-control-sm datepicker {{ $errors->has('end_date') ? 'is-invalid' : ''}}" name="end_date" 
                    placeholder="Fecha Limite Entrega"
                    value="{{ isset($task->end_date) ? $task->end_date : old('end_date') }}"
                >
                <div class="invalid-feedback">Este campo es requerido</div>
            </div>

            <select class="form-control-sm {{ $errors->has('user_id') ? 'is-invalid' : ''}}" name="user_id">
                <option disabled selected value>--- Asigne Usuario ---</option>
                @foreach ($users as $key => $value)
                    <option value="{{ $key }}" {{ ( $key == $selectedUserId) ? 'selected' : '' }}> 
                        {{ $value }} 
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Este campo es requerido</div>
            <hr>
            @isset ($task->id)
                <input type="hidden" name="id" value="{{ $task->id }}">
                <div class="d-flex flex-column mt-2">
                    <label>Comentario</label>
                    <div class="form-group">
                        <input class="form-control-sm"
                            name="comment"
                            placeholder="Comentario de la Tarea">
                    </div>
                </div>
            @endisset

            <div class="mt-3">
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ $Mode=='create' ? 'Crear Tarea' : 'Actualizar Tarea' }}
                </button>
                <a class="btn btn-secondary btn-sm" href="{{ route('home') }}">Regresar</a>
            </div>
            
        </div>
    </div>
</div>
