@extends(Config::get('view.layout'))

@section('content')

    {{ Form::open(array('route' => 'post.create')) }}

    {{ Form::label('title', 'Post title') }}
    {{ Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'Please enter the post title ...'))}}

    {{ Form::label('body', 'Post text') }}
    {{ Form::textarea('body', '', array('class' => 'form-control', 'placeholder' => 'Please enter whatever\'s on your ming ...'))}}

    {{ Form::submit('Submit', '', array('class' => 'btn btn-default')) }}

    {{ Form::close(); }}
@stop