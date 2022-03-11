@extends('layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Главная</h1>
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

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Блоки</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
                <dic class="card-body">
                    <div class="row">

                        <div class="col-sm-5 col-md-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Block</th>
                                    <th>Описание</th>
                                    <th>File</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blocks as $block)
                                    <tr>
                                        <td>{{ $block->id }}</td>
                                        <td>{{ $block->title }}</td>
                                        <td>{{ $block->description }}</td>
                                        <td>
                                            @foreach($block->file as $download)
                                                <a href="{{ route('download', $download->getFile()->getPathname()) }}" download>{{ $download->getFile()->getFilename() }}</a>
                                                <br>
                                            @endforeach


                                        </td>


                                        {{--<td>{{ $block->file}}}</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-5 offset-sm-2 col-md-2 offset-md-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>User</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </dic>

            <!-- /.card-body -->

            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection


