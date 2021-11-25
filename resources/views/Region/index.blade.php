@extends('layouts.admin.master')

@section('title', 'Welcome')

@section('content')
 
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('region.index') }}">Regions</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> All Regions </li>
    </ol>
</nav>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">

            <div class="d-flex justify-content-between">
              <h6 class="card-title mb-5">Display Types</h6>

                <a class="btn btn-success btn-sm mb-5" href="{{ route('region.create') }}" role="button">Add Region</span></a>  
              
            </div>

          <div class="table table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td class="text-center col-1">  #           </td>
                  <td class="text-center col-2">  Name        </td>
                  <td class="text-center col-7">  Description </td>
                  <td class="text-center col-2">  Action      </td>
                </tr>
              </thead>        
        
              <tbody>
                @foreach ( $regions as $region)
                  <tr>        
                    <td class="text-center col-1">  {{ $region->id }}                   </td>
                    <td class="text-center col-2">  {{ $region->name }}                 </td>
                    <td class="text-center col-7">  {{ $region->details->description }} </td>


                    <td class="no-gutters p-0 col-2">
                      <table class="table table-borderless no-gutters">
                          <div class="d-flex justify-content-between">                 
                              
                            <a class="mx-4" href="{{ route('region.edit', $region->id) }}"><i data-feather="edit-3"></i>Edit</a>
                              
                              <form action="{{ route('region.destroy', $region->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-link p-0 text-danger mx-4" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>
                              </form>

                          </div>
                        </table>       
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
 
@endsection
