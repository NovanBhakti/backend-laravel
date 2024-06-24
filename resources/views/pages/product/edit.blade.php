@extends('layouts.app')

@section('title', 'Edit User')

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

                <div class="card">
                    <form action="{{ route('product.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $product->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text"
                                    class="form-control @error('description')
                                is-invalid
                            @enderror"
                                    name="description" value="{{ $product->description }}">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    class="form-control @error('price')
                                is-invalid
                            @enderror"
                                    name="price" value="{{ $product->price }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number"
                                    class="form-control @error('stock')
                                is-invalid
                            @enderror"
                                    name="stock" value="{{ $product->stock }}">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- category --}}
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control selectric" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            {{-- <div class="form-group">
                                <label>Photo Product</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image"
                                        @error('image') is-invalid @enderror>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            {{-- status --}}
                            <div class="form-group">
                                <label>Status</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_available" value="1" class="selectgroup-input"
                                            {{ $product->is_available == 1 ? 'checked' : '' }}>
                                        <span class="selectgroup-button selectgroup-button-icon">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_available" value="0" class="selectgroup-input"
                                            {{ $product->is_available == 0 ? 'checked' : '' }}>
                                        <span class="selectgroup-button selectgroup-button-icon">Inactive</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group"></div>
                            <label>Is Favorite</label>
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_favorite" value="1" class="selectgroup-input"
                                        {{ $product->is_favorite == 1 ? 'checked' : '' }}>
                                    <span class="selectgroup-button selectgroup-button-icon">Yes</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_favorite" value="0" class="selectgroup-input"
                                        {{ $product->is_favorite == 0 ? 'checked' : '' }}>
                                    <span class="selectgroup-button selectgroup-button-icon">No</span>
                                </label>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
