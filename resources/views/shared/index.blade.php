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
                        <li class="breadcrumb-item"><a href="{{route('sharings')}}">Shared</a>
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
            <a href="{{route('share_create')}}" class="btn btn-info"  style="float: right;">Share</a>
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
                        <h4 class="card-title">List of All Active Shares</h4>
                        <div class="ms-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                    id="dd1" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="{{route('share_create')}}">Share Documents</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col" >#</th>
                                <th scope="col">Description</th>
                                {{-- <th scope="col">Url</th> --}}
                                <th scope="col" colspan="2">EXP. On</th>
                                <th scope="col" colspan="2">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if (count($active_sharings)>0)
                                @foreach ($active_sharings as $s)
                                <tr>
                                  <th scope="row">{{$i}}</th>
                                  <td>{{$s->description}}</td>
                                  {{-- <td>{{$s->url ?? " T"}}</td> --}}
                                  <td colspan="2"> {{$s->stop_time ?? "One Time Read"}}</td>
                                  <td colspan="2">
                                    <a class="btn btn-danger" onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this share!')) {
                                        document.getElementById('delete-form-s{{$i}}').submit();
                                    }">Delete</a>&nbsp;
                                    <a class="btn btn-primary" href="{{route('view_share', ["sharing"=>$s->id])}}">View</a>

                                        </td>
                                    </tr>
                                    <form id="delete-form-s{{$i}}" action="{{ route('delete_share', ['sharing'=>$s->id]) }}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                <?php $i++; ?>
                                @endforeach
                                @else
                                <tr>
                                    <th colspan="5" align="center" style="text-align: center;">No share available. <a href="{{route('share_create')}}">start sharing now!</a></th>
                                  </tr>
                                @endif

                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Inactive Shares</h4>
                        <div class="ms-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                    id="dd1" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="{{route('share_create')}}">Share Documents</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">EXP. On</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (count($inactive_sharings)>0)
                                @foreach ($inactive_sharings as $s)
                                <tr>
                                  <th scope="row">{{$i}}</th>
                                  <td>{{$s->description}}</td>
                                  <td>{{$s->stop_time ?? "One Time Read"}}</td>
                                  <td>
                                    <a class="btn btn-danger" onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this share!')) {
                                        document.getElementById('delete-form-ss{{$i}}').submit();
                                    }">Delete</a>&nbsp;

                                    <form id="delete-form-ss{{$i}}" action="{{ route('delete_share', ['sharing'=>$s->id]) }}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                  </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @else
                                <tr>
                                    <th colspan="5" align="center" style="text-align: center;">No inactive share available. <a href="{{route('share_create')}}">share now!</a></th>
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
