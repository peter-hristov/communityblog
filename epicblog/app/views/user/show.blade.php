@extends(Config::get('view.layout'))

@section('content')

<h3>All views for user : {{ $data->email }} </h3>

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
        </tr>

        @foreach ($data->posts as $node)
        <tr>
            <td>
                {{$node->title }}
            </td>

            <td>
                {{ $node->body }}
            </td>

            <td>
                {{ $node->created_at }}
            </td>
        </tr>
        @endforeach

    </table>
@stop