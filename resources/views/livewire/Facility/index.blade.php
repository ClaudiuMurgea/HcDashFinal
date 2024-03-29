<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('livewire.facility', $company->id) }}">Facilities</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> All Facilities </li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h6 class="card-title mb-5">Facilities</h6>
                    <button wire:click = 'showForm' class="btn btn-success btn-sm mb-5"> Add Facility </button> 
                </div>

                 <div class="table table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-success">
                                <td class="text-center col-1"> ID        </td>
                                <td class="text-center col-2"> Name      </td>
                                <td class="text-center col-2"> Address   </td>
                                <td class="text-center col-1"> City      </td>
                                <td class="text-center col-1"> State     </td>
                                <td class="text-center col-2"> Phone No  </td>
                                <td class="text-center col-1"> Color     </td>
                                <td class="text-center col-2"> Action    </td>
                            </tr>
                        </thead>        
                    
                        <tbody>
                            @foreach ( $facilities as $facility)
                                <tr class="table-success">        
                                    <td class="text-center col-1"> {{ $facility->id }}                            </td>
                                    <td class="text-center col-2" >
                                        <button wire:click="showSetting({{ $facility->id }})" class="btn btn-link">{{ $facility->name }} </button>  
                                    </td>
                                    <td class="text-center col-2"> {{ $facility->Profile->address }}              </td>
                                    <td class="text-center col-1"> {{ $facility->Profile->city }}                 </td>
                                    <td class="text-center col-1"> {{ $facility->Profile->state->name }}          </td>
                                    <td class="text-center col-2"> {{ $facility->Profile->phone }}                </td>

                                    <td class="text-center col-1">  
                                        <div class="progress">
                                            <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $facility->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>

                                    <td class="no-gutters p-0 col-2">
                                        <table class="table table-borderless no-gutters">
                                            <div class="d-flex justify-content-between"> 
                                            
                                                <button wire:click="edit({{ $facility->id }})" class="btn btn-link mx-2 p-0"><i data-feather="edit-3"></i>Edit</button>
                        
                                                <button wire:click="destroy({{ $facility->id }})" class="btn btn-link text-danger p-0 mx-4" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>

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
</div>

