@extends('layout.default')
@section('content')
    <h1>Example Laravel with Kafka Connect Elasticsearch</h1>
    <div class="flex-center position-ref">
        <div class="content">
            <div class="links m-b-md">
                <a href="{{ route('fulltext.form') }}">Example Note Register</a>
            </div>
            <table>
                <tr>
                    <th>elasticsearch.uuid</th>
                    <th>elasticsearch.note</th>
                </tr>
                @forelse ($list as $row)
                    <tr>
                        <td>
                            {{ $row->getUuid() }}
                        </td>
                        <td>
                            {{ $row->getNote() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            no notes
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@stop
