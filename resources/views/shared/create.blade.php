@extends('layouts.app')

@section('content')


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
                        <li class="breadcrumb-item">Create
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
            <a href="{{route('document_create')}}" class="btn btn-info" style="float: right;">Create new document</a>
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
                    <h3>Share your Documents</h3>
                </div>
                <div class="card-body">
            <form class="row g-3 needs-validation" method="POST"  action="{{route('share_review')}}" >
                @csrf

                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Description</label>
                    <textarea rows="3" name="description" type="text" class="form-control" id="validationCustom03" placeholder="The LLB documents for data analysis..." >{{old('description')}}</textarea>
                    @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                      <br>
                    <label for="validationCustom03" class="form-label">Type</label>
                    <select name="type" class="form-control" id="validationCustom03" required>
                        <option disabled selected>Select type</option>
                        <option value="1">One Time Read</option>
                        <option value="2">Timed (Make sure you add Stop Time)</option>
                    </select>
                    @error('type')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <br>
                    <label for="validationCustom03" class="form-label">Start Time</label>
                    <input name="start_time" type="datetime-local" class="form-control" value="{{old('start_time')}}" id="validationCustom03" >
                    @error('start_time')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <br>
                    <label for="validationCustom03" class="form-label">Stop Time</label>
                    <input name="stop_time" type="datetime-local" class="form-control" id="validationCustom03" >
                    @error('stop_time')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Terms & Conditions</label>
                  <textarea rows="6" name="terms" type="text" class="form-control" id="validationCustom03" placeholder="Enter your Terms here..." required>{{old('terms')}}</textarea>
                  @error('terms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                    <br>
                  <label for="validationCustom03" class="form-label">Non Disclosure Agreement</label>
                  <textarea rows="6" name="n_d_a" type="text" class="form-control" id="validationCustom03" placeholder="Non Discloursure Agreement..." required>{{old('n_d_a')}}</textarea>
                  @error('n_d_a')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                    <br>
                  </div>

                  <div class="col-md-12" style="text-align: center;">
                    <label for="validationCustom03" class="form-label b-1">Choose Documents to Share</label>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                {{-- <th scope="col">Url</th> --}}
                                <th scope="col">Desc</th>
                                <th scope="col">Checkbox</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if (count($documents)>0)
                                @foreach ($documents as $d)
                                <tr>
                                  <th scope="row">{{$i}}</th>
                                  <td>{{$d->name}}</td>
                                  {{-- <td>{{$d->url}}</td> --}}
                                  <td>{{$d->description ?? " Null"}}</td>
                                  <td>
                                    <input type="checkbox" name="documents[{{$i}}]" value="{{$d->id}}" id="documents[{{$i}}]">
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
                <div class="col-12">
                  <button class="btn btn-primary" style="" type="submit">Review form</button>
                </div>
              </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
