@extends('layouts.app')

@section('styles')
<style>
    .store-setup-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 200px);
        padding: 20px 0;
    }

    .store-setup-card {
        width: 100%;
        max-width: 500px;
        margin: auto;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .store-setup-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem 1.25rem;
    }

    .store-setup-card .card-body {
        padding: 1.5rem;
    }

    /* Responsive adjustments for mobile */
    @media (max-width: 576px) {
        .store-setup-container {
            padding: 10px;
            min-height: calc(100vh - 150px);
        }
        
        .store-setup-card {
            box-shadow: none;
            border: none;
        }
        
        .store-setup-card .card-body {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid store-setup-container">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card store-setup-card">
                <div class="card-header text-center">
                    <h4 class="mb-0">Setup Your Store</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store.setup') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Store Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
                            @error('country')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <small class="form-text text-muted">Optional: Upload your store logo (max 2MB)</small>
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection