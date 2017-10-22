@extends('layout.default')
@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Laravel with Kafka, Presto
        </div>
        <div class="links">
            <a href="{{ route('index') }}">Top</a>
            <a href="{{ route('analysis') }}">Example Presto, Kafka Consumer</a>
            <a href="{{ route('fulltext.index') }}">Example Kafka Connect Elasticsearch</a>
        </div>
    </div>
</div>
@stop
