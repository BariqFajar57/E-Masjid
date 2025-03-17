@extends('adminlte::page')

@section('title', 'Kelola Event')

@section('content_header')
    <h1>Kelola Event</h1>
    <hr>
@stop

@section('content')
    @livewire('event')
@stop

@section('css')
@stop

@section('js')
    <script>
        window.livewire.on('userStore', () => {
            $('#modalTambah').modal('hide');
        });

        window.livewire.on('userUpdate', () => {
            $('#modalUbah').modal('hide');
        });
    </script>
@stop
