@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="notification">
            @include('users.includes.notification')
        </div>
        <div>
            <a href="{{route('users.index')}}" class="btn primary btn-secondary btn-lg">Список ользователей</a>
        </div>
        <form class="user-form" method="POST" action="{{route('users.update', $item->id)}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="email1">Email</label>
                <input name="email" type="email" value="{{$item->email}}" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Введите email">
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input name="name" value="{{$item->name}}" type="text" class="form-control" id="name"  placeholder="Введите Имя">
            </div>
            <input type="hidden" name="id" value="{{$item->id}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
