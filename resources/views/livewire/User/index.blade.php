<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('livewire.user') }}">Users</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> All Users </li>
    </ol>
</nav>

<div class="row">
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <h6 class="card-title mb-5">Users Details</h6>
                <button wire:click= 'showForm' class="btn btn-success btn-sm mb-5" > Add User</button>           
            </div>

            <div class="table table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-success">
                            <td class="text-center col-1">  ID          </td>
                            <td class="text-center col-2">  Name        </td>
                            <td class="text-center col-7">  Email       </td>
                            <td class="text-center col-2">  Action      </td>
                        </tr>
                    </thead>        
            
                    <tbody>
                        @foreach ( $users as $user)
                            <tr class="table-success">        
                                <td class="text-center col-1">  {{ $user->id }}       </td>
                                <td class="text-center col-2">  {{ $user->name }} </td>
                                <td class="text-center col-7">  {{ $user->email }}    </td>

                                <td class="no-gutters p-0 col-2">
                                    <table class="table table-borderless no-gutters">
                                        <div class="d-flex justify-content-between">                 
                                            
                                            <button wire:click="edit({{ $user->id }})" class="btn btn-link p-0 mx-4"><i data-feather="edit-3"></i>Edit</button>
                                            
                                            <button wire:click="destroy({{ $user->id }})" class="btn btn-link p-0 mx-4 text-danger" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>

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
