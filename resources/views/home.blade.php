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
                                    <tr>
                                        <td>1</td>
                                        <td>Document management system</td>
                                        <td>August/2018</td>
                                        <td><button class="btn btn-info">Download</button></td>
                                        <td><button class="btn btn-danger">Delete</button></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- UPLOAD FORM --}}
                    <div class="links">
                            <form class="form-inline" action="document" enctype="multipart/form-data" method="POST">
                                <input type="file" name="document" id="document" class="form-control">
                                <button class="btn btn-primary">Upload</button>
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
