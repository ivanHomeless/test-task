@extends('layouts.app')

@section('content')

<div class="container">
    <div class="notification">
        @include('users.includes.notification')
    </div>
    <div>
        <a href="{{route('users.index')}}" class="btn primary btn-secondary btn-lg" href="">Список ользователей</a>
    </div>
    <form class="user-form" method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input required value="{{ old('email', $item->email)}}" name="email" type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Введите email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Имя</label>
            <input required value="{{ old('name', $item->name)}}" name="name" type="text" class="form-control" id="name"  placeholder="Введите Имя">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
