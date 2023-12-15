@extends('layouts.app')

@section('content')
<?php $data = $sharing; ?>
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6 col-lg-12">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('sharings')}}">Sharings</a>
                        </li>
                        <li class="breadcrumb-item">Info
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
            <a href="{{route('document_create')}}" class="btn btn-info"  style="float: right;">Create new document</a>
        </div>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    @if (session('val'))
    <div class="alert alert-success" role="alert">
        {{ session('val') }}
    </div>
    @endif
    <div class="row mb-2">
        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <h3>Shared Info 👇🏽</h3>
                    <a href="{{url("/shared/$sharing->uuid")}}" style="float: right" target="_blank">{{url("/shared/$sharing->uuid")}}</a>
                </div>
                <div class="card-body">
            <div class="row g-3 needs-validation" >
                @csrf

                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Description</label>
                    <textarea rows="3" name="" type="text" class="form-control" id="validationCustom03" placeholder="The LLB documents for data analysis..." disabled>{{$data['description']}}</textarea>
                    <textarea rows="3" name="description" type="text" class="form-control" id="validationCustom03" placeholder="The LLB documents for data analysis..."  hidden>{{$data['description']}}</textarea>
                    @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                      <br>
                    <label for="validationCustom03" class="form-label">Type</label>
                    <select name="type" class="form-control" id="validationCustom03" required>
                        <option value="{{$data['type']}}" selected>
                            @if ($data['type'] == "1")
                            One Time Read
                            @else
                            Timed
                            @endif
                        </option>
                    </select>
                    @error('type')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <br>
                    <label for="validationCustom03" class="form-label">Start Time</label>
                    <input name="" type="datetime-local" class="form-control" disabled value="{{$data['start_time']}}" id="validationCustom03" >
                    <input name="start_time" type="datetime-local" class="form-control" hidden value="{{$data['start_time']}}" id="validationCustom03" >
                    @error('start_time')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <br>
                    <label for="validationCustom03" class="form-label">Stop Time</label>
                    <input name="" type="datetime-local" class="form-control" disabled value="{{$data['stop_time']}}" id="validationCustom03" >
                    <input name="stop_time" type="datetime-local" class="form-control" hidden value="{{$data['stop_time']}}" id="validationCustom03" >
                    @error('stop_time')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Terms & Conditions</label>
                  <textarea rows="6" name="" type="text" class="form-control" id="validationCustom03" placeholder="Enter your Terms here..." disabled>{{$data['terms']}}</textarea>
                  <textarea rows="6" name="terms" type="text" class="form-control" id="validationCustom03" placeholder="Enter your Terms here..." hidden>{{$data['terms']}}</textarea>
                  @error('terms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                    <br>
                  <label for="validationCustom03" class="form-label">Non Disclosure Agreement</label>
                  <textarea rows="6" name="" type="text" class="form-control" id="validationCustom03" placeholder="Non Discloursure Agreement..." disabled>{{$data['n_d_a']}}</textarea>
                  <textarea rows="6" name="n_d_a" type="text" class="form-control" id="validationCustom03" placeholder="Non Discloursure Agreement..." hidden>{{$data['n_d_a']}}</textarea>
                  @error('n_d_a')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                    <br>
                  </div>

                  <div class="col-md-12" style="text-align: left;">
                    <label for="validationCustom03" class="form-label b-1"><strong>Documents Shared: </strong></label>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Url</th>
                                <th scope="col">Desc</th>
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
                                  <td><a href="{{$d->url}}">{{$d->url}}</a></td>
                                  <td>{{$d->description ?? " Null"}}</td>
                                  {{-- <td>
                                    <input type="checkbox" name="documents[{{$i}}]" value="{{$d->id}}" id="documents[{{$i}}]" hidden checked>
                                    ✅
                                  </td> --}}
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
                <div class="col-12">
                    <label for="validationCustom03" class="form-label b-1"><strong>Shared Link: </strong></label>
                  <a href="{{url("/shared/$sharing->uuid")}}" style="float: " target="_blank">  {{url("/shared/$sharing->uuid")}}</a>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
