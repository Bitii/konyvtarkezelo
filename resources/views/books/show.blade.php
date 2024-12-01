<x-layout>
    <div class="container py-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>{{ $book->title }}</h2>
                <div class="px-2">
                    <a href="/show/{{ $book->id }}" class="btn btn-sm btn-dark" wire:navigate>HU</a>
                    <a href="/translate/{{ $book->id }}" class="btn btn-sm btn-dark" wire:navigate>EN</a>
                </div>
                <a href="/" class="btn btn-secondary btn-sm">Vissza</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }} cover"
                                class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-3">Író</dt>
                            <dd class="col-sm-9">{{ $book->author }}</dd>

                            <dt class="col-sm-3">Műfaj</dt>
                            <dd class="col-sm-9">{{ $book->genre }}</dd>

                            <dt class="col-sm-3">Kiadás dátuma</dt>
                            <dd class="col-sm-9">{{ $book->release_date }}</dd>

                            <dt class="col-sm-3">Kulcsszavak</dt>
                            <dd class="col-sm-9">{{ $book->keywords }}</dd>

                            <dt class="col-sm-3">Leírás</dt>
                            <dd class="col-sm-9">{{ $book->description }}</dd>

                            <dt class="col-sm-3">Létrehozva</dt>
                            <dd class="col-sm-9">{{ $book->created_at->format('Y-m-d H:i') }}</dd>

                            <dt class="col-sm-3">Frissítve</dt>
                            <dd class="col-sm-9">{{ $book->updated_at->format('Y-m-d H:i') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
