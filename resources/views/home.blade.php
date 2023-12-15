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
    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{"0"}}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">No. of Visits
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{count($documents)}}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total No. of Documents
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{count($active_sharings)}}</h2>

                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Active Sharing Links
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{count($inactive_sharings)}}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Expaired Links</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-6 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Active sharing</h4>
                        <div class="ms-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                    id="dd1" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="{{route('share_create')}}">Share now</a>
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
                                  <td><p>{{$s->description}}</p></td>
                                  {{-- <td>{{$s->url ?? " T"}}</td> --}}
                                  <td colspan="2"> {{$s->stop_time ?? "One Time Read"}}</td>
                                  <td colspan="2">
                                    {{-- <a class="btn btn-danger" onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this share!')) {
                                        document.getElementById('delete-form-s{{$i}}').submit();
                                    }">Delete</a>&nbsp; --}}
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
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Visits</h4>
                    <div class="mt-4 activity">
                        <div class="d-flex align-items-start border-left-line pb-2">
                            <div class="ms-1 mt-1">
                                <h5 class="text-dark font-weight-medium mb-2">* Document</h5>
                                <p class="font-14 mb-2 text-muted">Is visited by 192.168.43.1</p>
                                <span class="font-weight-light font-14 text-muted" style="float: right">25 Minutes Ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
