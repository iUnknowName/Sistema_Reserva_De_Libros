<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Libros Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Filtrar por Categoría:</label>
                        <select name="category" id="category" class="block w-full mt-1 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Todas las categorías</option>
                            <option value="Ficción">Ficción</option>
                            <option value="Drama">Drama</option>
                            <option value="Historia">Historia</option>
                            <option value="Ciencia">Ciencia</option>
                        </select>
                    </div>

                    <div id="book-list">
                        <!-- Aquí se cargarán los libros mediante Ajax -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category');

        categorySelect.addEventListener('change', function () {
            const category = this.value;
            fetchBooks(category);
        });

        function fetchBooks(category = '') {
            let url = '/books';
            if (category) {
                url += `?category=${category}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const bookList = document.getElementById('book-list');
                    bookList.innerHTML = '';

                    if (data.length === 0) {
                        bookList.innerHTML = '<p>No hay libros disponibles en esta categoría.</p>';
                    } else {
                        data.forEach(book => {
                            const bookItem = document.createElement('div');
                            bookItem.classList.add('border', 'border-gray-300', 'p-3', 'mb-2');
                            bookItem.innerHTML = `
                                <p><strong>Título:</strong> ${book.title}</p>
                                <p><strong>Autor:</strong> ${book.author}</p>
                                <p><strong>Categoría:</strong> ${book.category}</p>
                                <button onclick="reserveBook(${book.id})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Reservar
                                </button>
                                <hr>
                            `;
                            bookList.appendChild(bookItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching books:', error);
                });
        }

        function reserveBook(bookId) {
            fetch(`/books/${bookId}/reserve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Mostrar mensaje de éxito o error
                fetchBooks(categorySelect.value); // Recargar la lista de libros después de la reserva
            })
            .catch(error => {
                console.error('Error reserving book:', error);
            });
        }
        
        // Cargar libros al cargar la página inicialmente
        fetchBooks();
    });
</script>

