@extends('master')
@section('title', 'Brainster Labs')

@section('homepage')
    <header>
        <div class="homepageTitle">
            <h1>Brainster.xyz Labs</h1>
            <p>Проекти од академиите на Brainster</p>
        </div>
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </header>
    <div class="projectsDiv">
        <div class="wrap">
            <div class="grid">
                @foreach($allProjects as $project)
                    <div class="project">
                        <div class="innerProject">
                            <a href="{{ $project->link }}">
                                <div class="imgBox">
                                    <img src="{{ $project->image }}" alt="">
                                </div>
                                <h3>{{ $project->title }}</h3>
                                <h4>{{ $project->subtitle }}</h4>
                                <p>{{ $project->description }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection