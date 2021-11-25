<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('livewire.user') }}"> Users </a> </li>
        <li class="breadcrumb-item active" aria-current="page">Add User</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4">Edit User</h6>

                <form wire:submit.prevent="update({{ $ids }})">
                    @csrf

                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-6 mt-2">

                                <label for="edit_name">Full Name</label>
                                <input class="form-control" type="text" wire:model="edit_name" required>
                                
                                @error('edit_name')
                                    <span class="text-danger">
                                        {!! $message !!}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-6 mt-2">

                                <label for="edit_email">Email</label>
                                <input class="form-control" type="email" wire:model="edit_email" required>
                                
                                @error('edit_email')
                                    <span class="text-danger">
                                        {!! $message !!}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-6 mt-2">

                                <label for="password">Password</label>
                                <input class="form-control" type="password" wire:model="password" required>
                                
                                @error('password')
                                    <span class="text-danger">
                                        {!! $message !!}
                                    </span>
                                @enderror
                        
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-6 mt-2">

                                <label for="edit_role">Role</label>
                                <select class="form-control" wire:model="edit_role" required>

                                    <option value="">Select Role</option>
                                    
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                                    
                                @error('edit_role')
                                    <span class="text-danger">
                                        {!! $message !!}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-3 mt-2">
                                <button class="btn btn-success form-control" type="submit">Submit </button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


