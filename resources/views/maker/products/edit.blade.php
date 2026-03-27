@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Product bewerken: {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('maker.products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Productnaam *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Beschrijving *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type *</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="sieraden" {{ old('type', $product->type)=='sieraden' ? 'selected' : '' }}>Sieraden</option>
                                <option value="meubels" {{ old('type', $product->type)=='meubels' ? 'selected' : '' }}>Meubels</option>
                                <option value="kleding" {{ old('type', $product->type)=='kleding' ? 'selected' : '' }}>Kleding</option>
                                <option value="kunst" {{ old('type', $product->type)=='kunst' ? 'selected' : '' }}>Kunst</option>
                                <option value="keramiek" {{ old('type', $product->type)=='keramiek' ? 'selected' : '' }}>Keramiek</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="material" class="form-label">Materiaal *</label>
                            <select class="form-select @error('material') is-invalid @enderror" id="material" name="material" required>
                                <option value="hout" {{ old('material', $product->material)=='hout' ? 'selected' : '' }}>Hout</option>
                                <option value="metaal" {{ old('material', $product->material)=='metaal' ? 'selected' : '' }}>Metaal</option>
                                <option value="textiel" {{ old('material', $product->material)=='textiel' ? 'selected' : '' }}>Textiel</option>
                                <option value="keramiek" {{ old('material', $product->material)=='keramiek' ? 'selected' : '' }}>Keramiek</option>
                                <option value="glas" {{ old('material', $product->material)=='glas' ? 'selected' : '' }}>Glas</option>
                            </select>
                            @error('material')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="production_time" class="form-label">Levertijd (dagen) *</label>
                        <input type="number" class="form-control @error('production_time') is-invalid @enderror"
                               id="production_time" name="production_time" value="{{ old('production_time', $product->production_time) }}" min="1" required>
                        @error('production_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-warning">
                        <strong>⚠️ Let op:</strong> Na het bewerken moet je product opnieuw worden goedgekeurd door een moderator.
                    </div>

                    <button type="submit" class="btn btn-primary">Bijwerken</button>
                    <a href="{{ route('maker.products.index') }}" class="btn btn-secondary">Annuleren</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
