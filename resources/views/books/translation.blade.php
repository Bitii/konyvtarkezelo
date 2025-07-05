<x-layout>
    <div class="container py-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>{{ $translation ? $translation->translated_title : $book->title }}</h2>
                <div class="px-2">
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-dark" wire:navigate>HU</a>
                    <a href="{{ route('translations.show', $book->id) }}" class="btn btn-sm btn-dark"
                       wire:navigate>EN</a>
                </div>
                <div>
                    @if (!$hasTranslation)
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addTranslationModal">
                            Add translation
                        </button>
                    @endif
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary btn-sm">Vissza</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}"
                                 alt="{{ $translation ? $translation->translated_title : $book->title }}"
                                 class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-3">Author</dt>
                            <dd class="col-sm-9">{{ $book->author }}</dd>

                            <dt class="col-sm-3">Genre</dt>
                            <dd class="col-sm-9">{{ $translation ? $translation->translated_genre : $book->genre }}</dd>

                            <dt class="col-sm-3">Release Date</dt>
                            <dd class="col-sm-9">{{ $book->release_date }}</dd>

                            <dt class="col-sm-3">Keywords</dt>
                            <dd class="col-sm-9">
                                {{ $translation ? $translation->translated_keywords : $book->keywords }}</dd>

                            <dt class="col-sm-3">Description</dt>
                            <dd class="col-sm-9">
                                {{ $translation ? $translation->translated_description : $book->description }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal a könyv lefordított adatainak megadásához --}}
    <div class="modal fade" id="addTranslationModal" tabindex="-1" aria-labelledby="addTranslationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTranslationModalLabel">Add english data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('translations.store', $book->id) }}" method="POST" id="addTranslation"
                          data-book-id="{{ $book->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Book Name</label>
                            <input type="text" id="translated_title" name="translated_title" class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea id="translated_description" name="translated_description" class="form-control"
                                      rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editGenre" class="form-label">Genre</label>
                            <input type="text" id="translated_genre" name="translated_genre" class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="editKeywords" class="form-label">Keywords</label>
                            <input type="text" id="translated_keywords" name="translated_keywords"
                                   class="form-control">
                        </div>
                        <div id="message"></div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
