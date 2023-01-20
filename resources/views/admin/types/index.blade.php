@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center">La lista delle Tipologie</h2>
        <div class="text-end">
            {{-- <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">
                Nuova Tipologia
            </a> --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-new-type">
                {{-- <i class="fa-solid fa-trash"></i> --}}Nuova Tipologia
            </button>

            <!-- Modal per la creazione di una nuova Tipologia -->
            <div class="modal fade" id="create-new-type" tabindex="-1" aria-labelledby="create-new-type-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="create-new-type-label">Crea nuova Tipologia</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.types.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name')
                                    is-invalid
                                    @enderror"
                                        value="{{ old('name') }}" placeholder="Inserisci una nuova tipologia"
                                        aria-label="Inserisci una nuova tipologia">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <button class="btn btn-success" type="submit">Salva</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tipologia</th>
                            <th scope="col">Data creazione</th>
                            <th scope="col">N. progetti</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <th scope="row">{{ $type->name }}</th>
                                <td>{{ $type->created_at }}</td>
                                <td>{{ count($type->projects) }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.types.show', $type->slug) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#update-type-{{ $type->id }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <!-- Modal per la modifica di una Tipologia -->
                                    <div class="modal fade" id="update-type-{{ $type->id }}" tabindex="-1"
                                        aria-labelledby="update-label-{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="update-label-{{ $type->id }}">
                                                        Modifica Tipologia {{ $type->name }}</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.types.update', $type->slug) }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <input type="text" id="name" name="name"
                                                                class="form-control @error('name')
                                                            is-invalid
                                                            @enderror"
                                                                value="{{ old('name', $type->name) }}"
                                                                placeholder="Inserisci la tipologia"
                                                                aria-label="Inserisci la tipologia">
                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annulla</button>
                                                        <button class="btn btn-success" type="submit">Salva</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-type-{{ $type->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal della conferma prima della cancellazione -->
                                    <div class="modal fade" id="delete-type-{{ $type->id }}" tabindex="-1"
                                        aria-labelledby="delete-label-{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="delete-label-{{ $type->id }}">
                                                        Vuoi
                                                        eliminare la Tipologia {{ $type->name }}?</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{ route('admin.types.destroy', $type->slug) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">
                                                            Elimina
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
