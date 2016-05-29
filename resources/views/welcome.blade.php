@extends('layouts.master')

@section('title')
Welcome!
@endsection

@section('content')

@include('includes.message-block')

<div class="row">
    <div class="col-md-6">
        <h3>Cadastrar</h3>
        <form action="{{ route('cadastrar') }}" method="post">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">Seu e-mail</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ Request::old('email') }}" />
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Seu nome</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ Request::old('name') }}" />
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Sua senha</label>
                <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}" />
            </div>
            <input type="submit" class="btn btn-primary" value="Cadastrar"></input>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
    <div class="col-md-6">
        <h3>Entrar</h3>
        <form action="{{ route('entrar') }}" method="post" accept-charset="utf-8">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">Seu e-mail</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ Request::old('email') }}" />
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Sua senha</label>
                <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}" />
            </div>
            <input type="submit" class="btn btn-primary" value="Entrar"></input>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
</div>
@endsection