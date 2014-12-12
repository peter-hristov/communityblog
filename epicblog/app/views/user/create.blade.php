@extends(Config::get('view.layout'));

@section('content')

    {{ Form::open(array('route' => 'user.create')) }}

        {{ Form::label('username', 'Your username') }}
        {{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Please enter the post username ...')) }}

        {{ Form::label('email', 'Your email') }}
        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Please enter the post email ...')) }}

        {{ Form::label('password', 'Your password') }}
        {{ Form::text('password', '', array('class' => 'form-control', 'placeholder' => 'Please enter the post password ...')) }}

        {{ Form::submit('Submit', '', array('class' => 'btn btn-default')) }}

    {{ Form::close(); }}


    @if ($errors->any())
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    @endif

@stop