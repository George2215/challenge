<div class="container alert alert-danger">
    <strong>Upps!</strong> El formulario esta incompleto, Por favor validar<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>