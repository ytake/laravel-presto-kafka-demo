@extends('layout.default')
@section('content')
    <h1>Example Laravel with Kafka Connect Elasticsearch</h1>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <table>
                <tr>
                    <th>elasticsearch.uuid</th>
                    <th>elasticsearch.note</th>
                </tr>
                @foreach($list as $row)
                    <tr>
                        <td>
                            {{ $row->getUuid() }}
                        </td>
                        <td>
                            {{ $row->getNote() }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
