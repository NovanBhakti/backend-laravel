@extends('layouts.app')

@section('title', 'Product Create')

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
                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>



                <div class="card">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                                <textarea name="description" cols="100" rows="5"
                                    class="form-control @error('description') is-invalid @enderror" id="description" required></textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" id="price" required>
                                <i>ex: input 20 -> 2000</i>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    name="stock" id="stock" required>
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control selectric @error('category_id') is-invalid @enderror"
                                    name="category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Photo Product</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" id="image"
                                        @error('image') is-invalid @enderror required>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- status --}}
                            <div class="form-group">
                                <label>Status</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_available" value="1" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button selectgroup-button-icon">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_available" value="0" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon">Inactive</span>
                                    </label>
                                </div>
                            </div>
                            {{-- is favorite  --}}
                            <div class="form-group">
                                <label>Is Favorite</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_favorite" value="1" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button selectgroup-button-icon">Yes</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_favorite" value="0" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon">No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary" id="submit-btn" disabled>Submit</button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('submit-btn');
            const requiredFields = ['name', 'description', 'price', 'stock', 'category_id', 'image'];

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

            checkFields();
        });
    </script>
@endsection

@push('scripts')
@endpush
