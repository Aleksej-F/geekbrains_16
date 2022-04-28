@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Панель администратора</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @php $msg = "Это сообщение было добавлено динамически"; @endphp


            </div>
        </div>
    </div>


    <x-alert type="success" :message="$msg"></x-alert>
    <x-alert type="warning"  message="Ворнинг"></x-alert>
    <x-alert type="danger"   message="Ошибка"></x-alert>


@endsection