@extends('index')

@section('title', 'Developers')

@section('link')
    <link rel="stylesheet" href= "{{ asset('css/style.css') }}">
    <link rel="stylesheet" href= "{{ asset('css/developers.css') }}">
@endsection

@section('content')
    <table>
        <tr>
            <th>#</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Technologies</th>
            <th>More info</th>
        </tr>
        @foreach($developers as $developer)
            <tr>
                <td>{{ $developer->id }}</td>
                <td>{{ $developer->first_name }}</td>
                <td>{{ $developer->last_name }}</td>
                <td>
                    {{--{!! Form::open(['url' => 'items']) !!}--}}
                    {{--{!! Form::hidden('devId', $developer->id) !!}--}}
                    {{--{{ Form::select('techIds', $developer->dat(), null, ['multiple'=>'multiple','name'=>'techIds[]'])}}--}}
{{--                    {!! Form::submit('Add tech') !!}--}}
                    {{--{{ Form::select('techIds', $developer->techList(), null, ['multiple'=>'multiple','name'=>'techIds[]'])}}--}}
                    {{--{!! Form::close() !!}--}}
{{--                    {{ $developer->dat()->get() }}--}}
                        @foreach($developer->techList() as $tl)
                            {{  $tl->name }}<br>
                        @endforeach
                </td>
                <td><a href="{{ route('dev', ['id' => $developer->id]) }}">SHOW</a></td>
            </tr>
        @endforeach
    </table>
    {{ $developers->links() }}
@endsection