@extends('layouts.app')

@section('content')
<div class="container">
    <div class="notification">
        @include('users.includes.notification')
    </div>
    <div>
        <a href="{{route('users.create')}}" class="btn primary btn-secondary btn-lg" href="">Добавить пользователя</a>
    </div>
    <table class="table user-table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">E-mail</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
                <div class="btn-group">
                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-secondary btn-lg" type="button">Edit</a>
                    <form method="POST" action="{{route('users.destroy', $user->id)}}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" class="btn btn-danger btn-lg">
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
</div>


@endsection



