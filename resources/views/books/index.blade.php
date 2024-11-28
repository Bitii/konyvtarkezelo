<x-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-end mb-3">
            <input type="text" id="searchBar">
            <div class="px-2">
                <button id="toggleHU" data-lang="hu">HU</button>
                <button id="toggleEN" data-lang="en">EN</button>
            </div>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bookAddModal">
                Új könyv hozzáadása
            </button>
        </div>
        <div class="table-responsive shadow rounded">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Author</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Keywords</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr data-id={{ $book->id }}>
                            <td class="fw-bold">{{ $book->title }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $book->description }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->genre }}</td>
                            <td style="min-width: 110px">{{ $book->release_date }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $book->keywords }}</td>
                            <td>
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }} borítókép"
                                    class="img-thumbnail" style="width: 80px; height: auto;">
                            </td>
                            <td style="min-width: 110px">{{ $book->created_at->format('Y-m-d H:i') }}</td>
                            <td style="min-width: 110px">{{ $book->updated_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm m-2 editBtn" data-bs-toggle="modal"
                                    data-bs-target="#bookEditModal" data-id="{{ $book->id }}">
                                    Szerkesztés
                                </button>
                                <button type="button" class="btn btn-danger btn-sm m-2 delBtn" data-bs-toggle="modal"
                                    data-bs-target="#bookDeleteModal" data-id="{{ $book->id }}">
                                    Törlés
                                </button>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal az új könyv felviteléhez-->
            <div class="modal fade" id="bookAddModal" tabindex="-1" aria-labelledby="bookAddModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="bookAddModalLabel">Új könyv hozzáadása</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/books" method="POST" id="addBook" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="title" class="form-label">Címe</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        placeholder="Könyv címe.." required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Leírás</label>
                                    <textarea id="description" name="description" class="form-control" rows="4"
                                        placeholder="Könyv leírása pár mondatban.." required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="author" class="form-label">Szerző</label>
                                    <input type="text" id="author" name="author" class="form-control"
                                        placeholder="Szerző neve..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="genre" class="form-label">Műfaj</label>
                                    <input type="text" id="genre" name="genre" class="form-control"
                                        placeholder="Könyv műfaja..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="release_date" class="form-label">Kiadás dátuma</label>
                                    <input type="date" id="release_date" name="release_date" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="keywords" class="form-label">Kulcsszavak</label>
                                    <input type="text" id="keywords" name="keywords" class="form-control"
                                        placeholder="Adjon meg kulcsszavakat, vesszővel elválasztva...">
                                </div>

                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">Borítókép</label>
                                    <input type="file" id="cover_image" name="cover_image" class="form-control"
                                        accept="image/*">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                            <button type="submit" class="btn btn-primary">Hozzáadás</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal a könyv szerkesztéséhez --}}
            <div class="modal fade" id="bookEditModal" tabindex="-1" aria-labelledby="bookEditModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="bookEditModalLabel">Könyv szerkesztése</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/books" method="POST" id="editBook" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="editTitle" class="form-label">Címe</label>
                                    <input type="text" id="editTitle" name="title" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editDescription" class="form-label">Leírás</label>
                                    <textarea id="editDescription" name="description" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="editAuthor" class="form-label">Szerző</label>
                                    <input type="text" id="editAuthor" name="author" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editGenre" class="form-label">Műfaj</label>
                                    <input type="text" id="editGenre" name="genre" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editReleaseDate" class="form-label">Kiadás dátuma</label>
                                    <input type="date" id="editReleaseDate" name="release_date"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editKeywords" class="form-label">Kulcsszavak</label>
                                    <input type="text" id="editKeywords" name="keywords" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="editCoverImage" class="form-label">Borítókép</label>
                                    <input type="file" id="editCoverImage" name="cover_image"
                                        class="form-control" accept="image/*">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                            <button type="submit" class="btn btn-primary">Módosítás</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal a törlés megerősítéséhez --}}
            <div class="modal fade" id="bookDeleteModal" tabindex="-1" aria-labelledby="bookDeleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="bookDeleteModalLabel"> Biztosan törölni szeretné?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="deleteBook">
                            @csrf
                            @method('DELETE')
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
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Mégse</button>
                                <button type="submit" class="btn btn-danger">Törlés</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
