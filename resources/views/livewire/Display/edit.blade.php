<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('livewire.display') }}">Display Types</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> Edit Display Type </li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">Display Details</h6>

                <form wire:submit.prevent="update({{ $ids }})">
                    @csrf 

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3 mt-5">
                                <input class="form-control" type="text" wire:model="edit_name">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">                       
                        <div class="d-flex justify-content-center">
                            <div class="col-3">
                                <button class="form-control mt-4 btn btn-success" type="submit">Edit Display Type</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>