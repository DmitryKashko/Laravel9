@extends('layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создание проекта</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Создание проекта</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('projects.store') }}" enctype=multipart/form-data>
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Название</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Название" value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" placeholder="Описание">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group border p-1">
                                        <select name="role1_id" class="form-control mb-1">
                                            @foreach($roles as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        <select name="users1[]" id="users1" class="select2" multiple="multiple" data-placeholder="Выбор пользователей" style="width: 100%;">
                                            @foreach($users as $k => $v)
                                                <option {{ is_array(old('users1')) && in_array($k, old('users1')) ? ' selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group border p-1">
                                        <select name="role2_id" class="form-control mb-1" >
                                            @foreach($roles as $k => $v)
                                                <option {{ old('role2_id') ? ' selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        <select name="users2[]" id="users2" class="select2" multiple="multiple" data-placeholder="Выбор пользователей" style="width: 100%;">
                                            @foreach($users as $k => $v)
                                                <option {{ is_array(old('users2')) && in_array($k, old('users2')) ? ' selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
