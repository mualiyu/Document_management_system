@extends('layouts.app')

@section('content')


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
                        <li class="breadcrumb-item">Create
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <br><br>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <h3>Create New Document</h3>
                </div>
                <div class="card-body">
            <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" action="{{route('document_store')}}" >
                @csrf
                <div class="col-md-4">
                  <label for="validationCustom01" n class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="validationCustom01" value="" placeholder="Docx One" required>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <br>
                  {{--  --}}
                  <label for="validationCustom05" class="form-label">File</label>
                  <input type="file" name="file" class="form-control" id="validationCustom05" required>
                  @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="validationCustom03" class="form-label">Description</label>
                  <textarea rows="5" name="description" type="text" class="form-control" id="validationCustom03" placeholder="Type description here..."></textarea>
                  @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12">
                  <button class="btn btn-primary" style="" type="submit">Submit form</button>
                </div>
              </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
