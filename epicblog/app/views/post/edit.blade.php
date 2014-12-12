@extends(Config::get('view.layout'))

@section('content')

    {{ Form::model($post, array('method' => 'PATCH', 'route' => array('post.edit', $post->id))) }}

        {{ Form::label('title', 'Post title') }}
        {{ Form::text('title', null, array('class' => 'form-control'))}}

        {{ Form::label('body', 'Post text') }}
        {{ Form::textarea('body', null, array('class' => 'form-control'))}}

        {{ Form::submit('Submit', '', array('class' => 'btn btn-default')) }}

    {{ Form::close(); }}


@stop