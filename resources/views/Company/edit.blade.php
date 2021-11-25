@extends('layouts.admin.master')
@section('title', 'Title')
@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('company.index') }}">Companies</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> Edit Company Details</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">Company Details</h6>

                <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                
                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $company->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" value="{{ $company->Profile->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="city">City</label>
                                <input class="form-control" type="text" name="city" value="{{ $company->Profile->city }}">
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="zip">Zip Code</label>
                                <input class="form-control" type="text" name="zip" value="{{ $company->Profile->zip }}">
                                @error('zip')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="state">State</label>
                                <select class="form-control" name="state" id="state">
                                    
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ $company->Profile->state->id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>   
                                    @endforeach

                                </select>
                                @error('state')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" name="phone" value="{{ $company->Profile->phone }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">
                            
                            <div class="form-group col-md-3">
                                <label for="color">Color</label>
                                <input class="form-control" type="text" name="color" value="{{ $company->Profile->color }}">
                                @error('color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="logo">Logo</label>
                                
                                <input class="form-control" type="file" name="logo">

                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                    </div>

                    <div class="row">                       
                        <div class="d-flex justify-content-center">
                            <div class="col-3">
                                <button class="form-control mt-4 btn btn-success" type="submit">Edit Company</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection