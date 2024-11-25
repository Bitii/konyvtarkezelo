<x-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="/books/create" class="btn btn-info btn-sm" type="button">Új könyv hozzáadása</a>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td class="fw-bold">{{ $book->title }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $book->description }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->genre }}</td>
                            <td style="min-width: 100px">{{ $book->release_date }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $book->keywords }}</td>
                            <td>
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }} borítókép"
                                    class="img-thumbnail" style="width: 80px; height: auto;">
                            </td>
                            <td style="min-width: 100px">{{ $book->created_at->format('Y-m-d H:i') }}</td>
                            <td style="min-width: 100px">{{ $book->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
