@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center mt-3">Crea un nuovo progetto</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @include('partials.errors')
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Titolo</label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title')
                        is-invalid
                        @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class=" form-group mb-3">
                        <label for="type">Tipologia</label>
                        <select class="form-select" id="type" name="type_id">
                            <option value="">Seleziona</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected(old('type_id') == $type->id)>{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <h6>Technologie</h6>
                        @foreach ($technologies as $technology)
                            <div class="form-check">
                                <input type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}"
                                    class="form-check-input" value="{{ $technology->id }}" @checked(in_array($technology->id, old('technologies', [])))>
                                <label for="technology-{{ $technology->id }}"
                                    class="form-check-label">{{ $technology->title }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group mb-3">
                        <label for="cover_image">Immagine</label>
                        <input type="file" id="cover_image" name="cover_image"
                            class="form-control @error('cover_image')
                        is-invalid 
                        @enderror">
                        @error('cover_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="w-25 mt-3 mb-3">
                            <img id="image_preview" src="" alt="">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" rows="10"
                            class="form-control @error('description')
                        is-invalid
                        @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="btn btn-success" type="submit">Salva</button>
                    <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Indietro</a>
                </form>
            </div>
        </div>
    </div>
@endsection
