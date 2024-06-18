@extends('layouts.mainlayout')

@section('content')
<h1>Register</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required>
    </div>
    <div>
        <label for="permissions">Permissions</label>
        <input type="text" id="permissions" name="permissions" value="{{ old('permissions') }}">
    </div>
    <div>
        <label for="avatar">Avatar URL</label>
        <input type="text" id="avatar" name="avatar" value="{{ old('avatar') }}">
    </div>
    <div>
        <label for="badge">Badge</label>
        <input type="text" id="badge" name="badge" value="{{ old('badge') }}">
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form>

@endsection