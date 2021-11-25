@extends('layouts.admin.master')
@section('title', 'Title')
@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('company.index') }}">Facilities</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> Edit Facility </li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">Facility Details</h6>

                <form action="{{ route('facility.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                
                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $facility->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" value="{{ $facility->Profile->address}}">
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
                                <input class="form-control" type="text" name="city" value="{{ $facility->Profile->city}}">
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="zip">Zip Code</label>
                                <input class="form-control" type="text" name="zip" value="{{ $facility->Profile->zip}}">
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
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>   
                                    @endforeach

                                </select>
                                @error('state')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" name="phone" value="{{ $facility->Profile->phone}}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="region">Region</label>
                                <select class="form-control" name="region" id="region">
                                    
                                    <option value="">Select region</option>
                                    @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>   
                                    @endforeach
                                    <option value=""></option>

                                </select>
                                @error('region')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="logo">Logo</label>
                                
                                <input class="form-control" type="file" name="logo" value="{{ old('logo') }}">

                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">
                            <div class="col-3">
                                <button class="form-control mt-4 btn btn-success" type="submit">Edit Facility</button>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="name">Color</label>
                                <input class="form-control" type="text" name="color" value="{{ $facility->Profile->color}}">
                                @error('color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection