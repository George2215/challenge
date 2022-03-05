@component('mail::message')
# {{ $data['nameTask'] }}

Se creo un nuevo log para la tarea 

Comentario registrado: {{ $data['comment'] }}.

Fecha del comentario: {{ $data['date_comment'] }}


Recuerde que este correo es informativo!

Cordialmente,<br>
{{ config('app.name') }}
@endcomponent
