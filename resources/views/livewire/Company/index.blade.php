<nav class="page-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('livewire.company') }}">&nbsp;&nbsp; Companies</a> </li>
      <li class="breadcrumb-item active" aria-current="page"> All Companies </li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between">
          <h6 class="card-title mb-5 pl-2">Companies</h6>
          <button wire:click="showForm" class="btn btn-success btn-sm mb-5"> Add Company </button>  
        </div>

        <div class="table table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr class="table-success">
                <td class="text-center col-1">  ID       </td>
                <td class="text-center col-2">  Name     </td>
                <td class="text-center col-2">  Address  </td>
                <td class="text-center col-1">  City     </td>
                <td class="text-center col-1">  State    </td>
                <td class="text-center col-1">  Phone No </td>
                <td class="text-center col-1">  Color    </td>
                <td class="text-center col-3">  Action   </td>
              </tr>
            </thead>        
      
            <tbody>
              @foreach ( $companies as $company)
                <tr class="table-success">        
                  <td class="text-center col-1">  {{ $company->id }}                        </td>
                  <td class="text-center col-2">  {{ $company->name }}                      </td>
                  <td class="text-center col-2">  {{ $company->Profile->address }}          </td>
                  <td class="text-center col-1">  {{ $company->Profile->city }}             </td>
                  <td class="text-center col-1">  {{ $company->Profile->state->short_name }}</td>
                  <td class="text-center col-1">  {{ $company->Profile->phone }}            </td>
                  <td class="col-1">  
                    <div class="progress">
                      <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $company->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                    </div>
                  </td>
                  
                  <td class="no-gutters p-0 col-3">                 
                    <table class="table table-borderless no-gutters">
                      <div class="d-flex justify-content-between"> 
                              
                        <a class="mx-2" href="{{ route('livewire.facility', $company->id) }}"><i data-feather="pie-chart"></i>  Facilities </a>

                        <a class="mx-2" href=""> <i data-feather="flag"></i>Banners </a>

                        <button wire:click="edit({{ $company->id }})" class="btn btn-link mx-2 p-0"><i data-feather="edit-3"></i>Edit</button>

                        <button wire:click="destroy({{ $company->id }})" class="btn btn-link mx-2 p-0 text-danger" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>
                      
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