@extends('layouts.app1')

@section('content')
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ $sharing->type=="1" ? "#" : route('shared', ['uuid'=>$sharing->uuid]) }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ $type=="One Time" ? $type."Read Only,  Note: These documents will disappear upon refreshing this page 😊" : $type }}</a>
                    </li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">

    <div class="container">

        <div class="row mb-4" id="agreement">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-1">
                            <h4 class="card-title">Terms & Conditions</h4>
                        </div>
                        <div class="table-responsive">
                            <p class="font-14 mb-2 text-muted">{{$sharing->terms}}</p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center mb-1">
                            <h4 class="card-title">Non Disclosure Agreement</h4>
                        </div>
                        <div class="table-responsive">
                            <p class="font-14 mb-2 text-muted">{{$sharing->n_d_a}}</p>
                        </div>
                        <div class="col-12" style="float: right;">
                            <button class="btn btn-primary" style="" onclick="event.preventDefault();
                            if (confirm('Are you sure you agree with the Teerms of Agreement?')) {
                                $('#shared-d').show();
                                $('#shared-i').show();
                                $('#agreement').hide();
                            }">Agree</button>
                        </div>
                        {{-- <p><a class='iframe' href="https://wikipedia.com">Outside Webpage (Iframe)</a></p> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4" id="shared-i">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Share Information</h4>
                        </div>
                        <div class="table-responsive">
                            <p class="font-14 mb-2 text-muted">{{$sharing->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-lg-4">

            </div> --}}
        </div>
        <div class="row" id="shared-d">
            <div class="col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Shared Documents</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                    {{-- <th scope="col">Checkbox</th> --}}
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @if (count($sharing->documents)>0)
                                    @foreach ($sharing->documents as $d)
                                    <tr>
                                      <th scope="row">{{$i}}</th>
                                      <td>{{$d->name}}</td>
                                      <td>{{$d->description ?? " Null"}}</td>
                                      <td>
                                      <?php
                                      $file = explode('/', $d->url);
                                      $file = end($file);

                                      $ext = explode('.', $file);
                                      $ext = end($ext);
                                       ?>

                                       {{-- @if ($ext == "pdf")
                                         <a class='iframe' href='{{url("/pdf_js/generic/web/viewer_readonly.html?file=../../../storage/Documents/$file")}}'>Open</a>
                                       @endif --}}

                                       @if ($ext == "docx")
                                         <a class='iframe' href='{{route('word_viewer', ['uuid'=>$d->uuid])}}'>Open</a>
                                       @elseif ($ext == "pdf")
                                       <a class='iframe' href='{{url("/pdf_js/generic/web/viewer_readonly.html?file=../../../storage/Documents/$file")}}'>Open</a>
                                       @else
                                         <a class='iframe' href='{{$d->url}}'>Open</a>
                                       @endif

                                      </td>
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                    @else
                                    <tr>
                                        <th colspan="5" align="center" style="text-align: center;">No document available</th>
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
                        <h4 class="card-title">Device Info</h4>
                        <div class="mt-4 activity">
                            <div class="d-flex align-items-start border-left-line pb-2">
                                <div class="ms-1 mt-1">
                                    <h5 class="text-dark font-weight-medium mb-2">* Document</h5>
                                    <p class="font-14 mb-2 text-muted">
                                        <ul>
                                            <li>Ip Address: {{$request->ip()}}</li>
                                            <li>Os: Mac OS 12</li>
                                            <li>Browser: {{__('Test')}}</li>
                                            <li>Mac: <?php echo exec('getmac'); ?></li>
                                        </ul>
                                    </p>
                                    <span class="font-weight-light font-14 text-muted" style="float: right">Visit Time: Jul 1, 2023 18:00pm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#shared-d').hide();
    $('#shared-i').hide();

});

console.log(navigator);
</script>
@endsection
