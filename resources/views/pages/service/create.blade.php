@extends('layouts.app')

@section('title', 'Advanced Forms')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Service Charge</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Service Charge</h2>



                <div class="card">
                    <form action="{{ route('service.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="description" required>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="type" value="percentage" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Percentage</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="type" value="fixed" class="selectgroup-input">
                                        <span class="selectgroup-button">Fixed</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Value</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('value') is-invalid @enderror" name="value" id="value"
                                    required>
                                @error('value')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="active" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="inactive" class="selectgroup-input">
                                        <span class="selectgroup-button">Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" id="submit-btn" disabled>Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('submit-btn');
            const requiredFields = ['name'];

            function checkFields() {
                let allFilled = true;
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (!input.value || (input.type === 'file' && input.files.length === 0)) {
                        allFilled = false;
                    }
                });
                submitBtn.disabled = !allFilled;
            }

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                input.addEventListener('input', checkFields);
            });

            // Initial check to enable/disable button on page load
            checkFields();
        });
    </script>
@endsection

@push('scripts')
@endpush
