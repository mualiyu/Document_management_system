@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('documents')}}">Documents</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <br>
    <div class="row mb-2">
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
            <a href="{{route('share_create')}}" class="btn btn-info"  style="">Share Doc</a>
            <a href="{{route('document_create')}}" class="btn btn-info" style="float: right;">Create new document</a>
        </div>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">All Documents</h4>

                        <div class="ms-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                    id="dd1" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="{{route('document_create')}}">Add New Document</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Url</th>
                                <th scope="col">Desc</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if (count($documents)>0)
                                @foreach ($documents as $d)
                                <tr>
                                  <th scope="row">{{$i}}</th>
                                  <td>{{$d->name}}</td>
                                  <td><a href="{{$d->url}}">{{$d->url}}</a></td>
                                  <td>{{$d->description ?? " Null"}}</td>
                                  <td>
                                    <a class="btn btn-danger" onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this document!')) {
                                        document.getElementById('delete-form-d{{$i}}').submit();
                                    }">Delete</a>&nbsp;
                                    {{-- <a class="btn btn-primary">View</a> --}}

                                    <form id="delete-form-d{{$i}}" action="{{ route('document_delete', ['document'=>$d->id]) }}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                  </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @else
                                <tr>
                                    <th colspan="5" align="center" style="text-align: center;">No document available, <a href="{{route('document_create')}}">Add one here!</a></th>
                                  </tr>
                                @endif

                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
