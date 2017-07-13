@extends('index')

@section('title', 'Profile')
@section('link')
    <link rel="stylesheet" href= "{{ asset('css/style.css') }}">
    <link rel="stylesheet" href= "{{ asset('css/devInfo.css') }}">
@endsection

@section('content')
    <div class='back'>
	    <a href='/'>BACK</a>
    </div>
    <div class="info clearfix">
        <div class="photo">
            <img src="http://via.placeholder.com/150x200">
        </div>
        <div class="common-info">
            <p><b>{{ $devIndex->first_name }} {{ $devIndex->last_name }}</b></p>
            <p>Experience:
                @if ($devIndex->experience == 0)
                    {{ 'less 1' }} yr
                @else {{ $devIndex->experience }} yr
                @endif
            </p>
            <p>Email: <a href="mailto:{{ $devIndex->email }}">{{ $devIndex->email }}</a></p>
            <p>Skype: {{ $devIndex->skype }}</p>
            <p>GitHub: <a href="mailto:{{ $devIndex->git }}">{{ $devIndex->git }}</a></p>
        </div>
    </div>
    <div class="technologies">
        <table class="techs">
            <tr>
                <th>#</th>
                <th>Technology</th>
                <th>Add/Remove</th>
            </tr>
        @foreach($devIndex->technologies as $technologies)
            <tr>
                <td>{{ $technologies->id }}</td>
                <td>{{ $technologies->name }}</td>
                <td>
                    {!! Form::open(['url' => 'removeTech']) !!}
                    {!! Form::hidden('devId', $devIndex->id) !!}
                    {!! Form::hidden('techId', $technologies->id) !!}
                    {!! Form::submit('Remove') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </table>
        <div class="addTech">
            {!! Form::open(['url' => 'addTech']) !!}
            {!! Form::hidden('devId', $devIndex->id) !!}
            {!! Form::select('techIds', $devIndex->notChoseTechs()) !!}
            {!! Form::submit('Add technology') !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="projects">
        <table class="projs">
            <tr>
                <th>#</th>
                <th>Project</th>
                <th>Description</th>
                <th>Technology</th>
                <th>Add/Remove</th>
            </tr>
        @foreach($devIndex->projects as $project)
                    {{--@foreach($devIndex->technologies as $technologies)--}}
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $technologies->name }}</td>
                <td>
                    {!! Form::open(['url' => 'removeProject']) !!}
                    {!! Form::hidden('devId', $devIndex->id) !!}
                    {!! Form::hidden('projId', $project->id) !!}
                    {!! Form::submit('Remove') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </table>
    </div>
    @endsection