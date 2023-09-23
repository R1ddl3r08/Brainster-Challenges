@extends('master')
@section('title', 'Brainster Labs')

@section('dashboard')
    <div class="dashboardContainer">
        <div class="navigation">
            <a href="{{ route('admin.dashboard') }}" class="{{ $action === 'add' ? ' active' : '' }}">Додај</a>
            <a href="{{ route('edit.product') }}" class="{{ $action === 'edit' ? ' active' : '' }}">Измени</a>
        </div>
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-danger">
                {{ session('error') }}
            </div>
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
        @if($action == 'add')
        <div class="addProductContainer">
            <h2>Додај нов производ</h2>
            <form action="{{ route('product.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Име</label>
                    <input id="title" name="title" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="subtitle">Поднаслов</label>
                    <input id="subtitle" name="subtitle" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="image">Слика</label>
                    <input id="image" name="image" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="link">URL</label>
                    <input id="link" name="link" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="description">Опис:</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit">Додај</button>
            </form>
        </div>
        @endif

        @if($action == 'edit')
            <div class="editProductsContainer projectsDiv">
                <div>
                    <div class="grid">
                        @foreach($projects as $project)
                            <div class="project">
                                <div class="innerProject">
                                    <a href="{{ $project->link }}" class="projectContent">
                                        <div class="imgBox">
                                            <img src="{{ $project->image }}" alt="">
                                        </div>
                                        <h3>{{ $project->title }}</h3>
                                        <h4>{{ $project->subtitle }}</h4>
                                        <p>{{ $project->description }}</p>
                                    </a>
                                    <div class="editContainer">
                                        <button class="editProjectBtn"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="deleteProjectBtn" data-project-id="{{ $project->id }}"><i class="fa-solid fa-x"></i></button>
                                    </div>
                                    <form action="{{ route('product.edit') }}" method="POST" class="editForm">
                                        @csrf
                                        <input type="text" name="projectId" value="{{ $project->id }}" hidden>
                                        <div class="form-group">
                                            <label for="title">Име</label>
                                            <input id="title" name="title" class="form-control" value="{{ $project->title }}"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle">Поднаслов</label>
                                            <input id="subtitle" name="subtitle" class="form-control" value="{{ $project->subtitle }}"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Слика</label>
                                            <input id="image" name="image" class="form-control" value="{{ $project->image }}"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="link">URL</label>
                                            <input id="link" name="link" class="form-control" value="{{ $project->link }}"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Опис:</label>
                                            <textarea name="description" id="description" cols="30" rows="3" class="form-control">
                                            {{ $project->description }}
                                            </textarea>
                                        </div>
                                        <button class="saveEdit" type="submit">Зачувај</button>
                                        <button class="cancelEdit" type="button">Откажи</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="deleteModal" class="modal">
                <div class="modalContent">
                    <h2>Дали сте сигурни дека сакате да го избришете проектот?</h2>
                    <hr>
                    <form method="POST" action="{{ route('product.delete') }}">
                        @csrf
                        @method('DELETE')
                        <input type="text" name="projectId" hidden>
                       <div class="actions">
                        <button class="deleteProduct" type="submit">Избриши</button>
                        <button class="cancelDelete" type="button">Откажи</button>
                       </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection