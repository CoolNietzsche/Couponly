@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Merchant Dashboard</h1>
        </div>
    </div>

    <!-- Store Info Card -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Store Information</h5>
                    <a href="{{ route('filament.admin.resources.stores.edit', $store->id) }}" class="btn btn-primary btn-sm">Edit Store</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @if($store->logo)
                                <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="img-fluid rounded">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 100px; width: 100px; border-radius: 50%;">
                                    <span class="text-muted">{{ substr($store->name, 0, 2) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4>{{ $store->name }}</h4>
                            <p class="text-muted mb-1"><i class="fas fa-map-marker-alt me-2"></i>{{ $store->country }}</p>
                            <p class="mb-0">{{ $store->description ?? 'No description provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $totalCoupons }}</h4>
                            <p class="mb-0">Total Coupons</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $activeCoupons }}</h4>
                            <p class="mb-0">Active Coupons</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $totalCouponUsages }}</h4>
                            <p class="mb-0">Total Usages</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coupons List -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Your Coupons</h5>
                    <a href="{{ route('filament.admin.resources.coupons.create') }}" class="btn btn-success btn-sm">Create New Coupon</a>
                </div>
                <div class="card-body">
                    @if($coupons->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                        <th>Usages</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->title }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type }}</td>
                                        <td>{{ $coupon->expire_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge {{ $coupon->active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $coupon->active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $coupon->usages->count() }}</td>
                                        <td>
                                            <a href="{{ route('filament.admin.resources.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">You haven't created any coupons yet.</p>
                            <a href="{{ route('filament.admin.resources.coupons.create') }}" class="btn btn-success">Create Your First Coupon</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection