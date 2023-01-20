@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-start mt-4">
            <a class="btn btn-success" href="{{ route('admin.types.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <h2 class="text-center">{{ $type->name }}</h2>
        <h4 class="mt-3">Creato: <p>{{ $type->created_at }}</p>
        </h4>
        @if (count($type->projects) > 0)
            <h5>Progetti correlati:</h5>
            @foreach ($type->projects as $project)
                <ul>
                    <li>{{ $project->title }}</li>
                </ul>
            @endforeach
        @else
            <p>Non ci sono progetti per questa categoria</p>
        @endif
    </div>
@endsection
