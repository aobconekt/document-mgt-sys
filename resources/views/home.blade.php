@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- LISTS OF DOCUMENTS --}}
                    <div class="file-lists">
                        <input type="text" class="form-control filter" name="search" id="search" placeholder="Search for file"><br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>S/N</td>
                                    <td>File Name</td>
                                    <td>Date Uploaded</td>
                                    <td>Download</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($getDocuments as $getDoc)
                                    <tr>
                                        <td>{{ $getDoc->id }}</td>
                                        <td>{{ $getDoc->name }}</td>
                                        <td>{{ $getDoc->created_at }}</td>
                                        <td><a href="/download/{{ $getDoc->id }}"><button class="btn btn-info">Download</button></a></td>
                                        <td><a href="/remove/{{ $getDoc->id }}"><button class="btn btn-danger">Delete</button></a></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- UPLOAD FORM --}}
                    <div class="links">
                            <form class="form-inline" action="document" enctype="multipart/form-data" method="POST">
                                <input type="file" name="document" id="document" class="form-control">
                                <button class="btn btn-secondary">Upload</button>
                                {{ csrf_field() }}
                            </form>
                            @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
