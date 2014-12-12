@extends(Config::get('view.layout'))

@section('content')

    @if (Auth::check())
        <div>
            {{ link_to_route('post.create', 'Create New Post', null, array('class' => 'btn btn-primary')) }}
        </div>
    @endif

    <table class="table table-hover table-striped">
        <tr>
            <th>
                <p>Title</p>
            </th>
            <th>
                <p>Test</p>
            </th>
            <th>
                <p>Time Created</p>
            </th>
            <th>
                <p>Author</p>
            </th>
        </tr>

        @foreach ($data as $node)
        <tr>
            <td>
                {{ link_to_route('post.show', $node->title, array('id' => $node->id)) }}
            </td>

            <td>
                {{ $node->body }}
            </td>

            <td>
                {{ $node->created_at }}
            </td>

            <td>

                {{ link_to_route('user.show', $node->user->email, array('id' => $node->user->id)) }}

            </td>

            @if (Auth::check())

                <td>
                    {{ link_to_route('post.edit', 'edit' , array('id' => $node->id), array('class' => 'btn btn-primary')) }}
                </td>

                <td>
                    {{ Form::model($node, array('method' => 'DELETE', 'action' => array('post.delete', $node->id))) }}
                        {{ Form::submit('Submit', '', array('class' => 'btn btn-default')) }}
                    {{ Form::close(); }}

                </td>
            @endif
        </tr>
        @endforeach

        <?php echo $data->appends(array('sort' => 'created_at'))->links(); ?>

    </table>
@stop