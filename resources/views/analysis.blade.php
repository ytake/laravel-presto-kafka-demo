@extends('layout.default')
@section('content')
    <h1>
        Example Laravel with Presto
    </h1>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <table>
                <tr>
                    <th>redis.key</th>
                    <th>redis.value</th>
                    <th>mysql.primary</th>
                    <th>mysql.name</th>
                    <th>kafka.log.uri</th>
                    <th>kafka.log.uuid</th>
                </tr>
                @forelse ($list as $row)
                    <tr>
                        <td>
                            {{ $row->getKey() }}
                        </td>
                        <td>
                            {{ $row->getValue() }}
                        </td>
                        <td>
                            {{ $row->getTestId() }}
                        </td>
                        <td>
                            {{ $row->getTestName() }}
                        </td>
                        <td>
                            {{ $row->getUri() }}
                        </td>
                        <td>
                            {{ $row->getUuid() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <pre>
                            $ php artisan kafka:consumer
                            </pre>
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@stop
