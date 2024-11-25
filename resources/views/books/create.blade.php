<x-layout>
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white">
                <h4 class="text-center mb-0">Új könyv hozzáadása</h4>
            </div>

            <div class="card-body">
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
                        <input type="date" id="release_date" name="release_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keywords" class="form-label">Kulcsszavak</label>
                        <input type="text" id="keywords" name="keywords" class="form-control"
                            placeholder="Adjon meg kulcsszavakat, vesszővel elválasztva...">
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Borítókép</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*">
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

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Hozzáadás</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
