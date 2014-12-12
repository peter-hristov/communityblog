@extends(Config::get('view.layout'));

@section('content')

    {{ Form::open(array('route' => 'user.login')) }}

        {{ Form::label('email', 'Your email') }}
        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Please enter the post email ...')) }}

        {{ Form::label('password', 'Your password') }}
        {{ Form::text('password', '', array('class' => 'form-control', 'placeholder' => 'Please enter the post password ...')) }}

        {{ Form::submit('Submit', '', array('class' => 'btn btn-default')) }}

    {{ Form::close(); }}


    @if ($errors->any())
        <ul>
            {{ implode('', $errors->all('<li class="error text-danger">:message</li>')) }}
        </ul>
    @endif

@stop