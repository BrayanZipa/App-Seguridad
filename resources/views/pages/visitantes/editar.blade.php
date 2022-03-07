@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
@endsection

@section('scripts')
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>

    <section class="content-header">
        @include('pages.visitantes.formularioEditar')
    </section>
@endsection
