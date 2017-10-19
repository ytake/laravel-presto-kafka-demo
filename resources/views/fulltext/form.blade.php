@extends('layout.default')
@section('content')
    <h1>Example Laravel with Presto</h1>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div>{{ $errors->first('fulltext') }}</div>
            <form action="{{ route('fulltext.register') }}" method="post">
                {{ csrf_field() }}
                <textarea name="fulltext" placeholder="何か文字を入力してください" rows="30" cols="80">{{ old('fulltext') }}</textarea>
                <br/>
                <button type="submit">register</button>
            </form>
        </div>
    </div>
@stop
