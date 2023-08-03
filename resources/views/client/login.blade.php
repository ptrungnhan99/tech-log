@extends('client.layout.master')
@section('content')
    <div class="main-content">
        <div class="container" style="margin: 100px auto;">
            <div class="row justify-content-center">
                @if (session('alert'))
                    <div class="alert alert-danger">
                        <p>{{ session('alert') }}</p>
                    </div>
                @endif
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="{{ url('/login') }}" method="POST">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" value="{{ old('email') }}"
                                            name="email" type="email" autofocus>
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('email') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" value="{{ old('password') }}"
                                            name="password" type="password" value="">
                                        @if (count($errors) > 0)
                                            <small class="text-danger">
                                                @foreach ($errors->get('password') as $message)
                                                    {{ $message }} <br>
                                                @endforeach
                                            </small>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success btn-block"
                                        style="cursor: pointer;">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
