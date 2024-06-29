<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Books;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Array con categorías y libros inventados
        $categories = ['drama', 'ficción', 'historia', 'ciencia'];
        $books = [
            'drama' => [
                ['title' => 'El drama de la vida', 'author' => 'Gabriel Garcia'],
                ['title' => 'Lágrimas en el viento', 'author' => 'Emily Bronte'],
                ['title' => 'Corazones rotos', 'author' => 'Ernest Hemingway'],
                ['title' => 'Sueños perdidos', 'author' => 'Jane Austen'],
            ],
            'ficción' => [
                ['title' => 'El viaje intergaláctico', 'author' => 'Fyodor Dostoevsky'],
                ['title' => 'Mundos paralelos', 'author' => 'J.K. Rowling'],
                ['title' => 'La fantasía eterna', 'author' => 'Virginia Woolf'],
                ['title' => 'El último héroe', 'author' => 'Mark Twain'],
            ],
            'historia' => [
                ['title' => 'La historia del mundo', 'author' => 'Haruki Murakami'],
                ['title' => 'Grandes civilizaciones', 'author' => 'George Orwell'],
                ['title' => 'Batallas legendarias', 'author' => 'Gabriel Mistral'],
                ['title' => 'El pasado revelado', 'author' => 'Oscar Wilde'],
            ],
            'ciencia' => [
                ['title' => 'El universo infinito', 'author' => 'Isabel Allende'],
                ['title' => 'Descubrimientos científicos', 'author' => 'Albert Camus'],
                ['title' => 'Avances tecnológicos', 'author' => 'Jorge Luis'],
                ['title' => 'El futuro incierto', 'author' => 'George Lucas'],
            ],
        ];

        // Crear libros para cada categoría
        foreach ($categories as $category) {
            foreach ($books[$category] as $bookData) {
                Books::create([
                    'title' => $bookData['title'],
                    'author' => $bookData['author'],
                    'category' => $category,
                    'reserved' => false, 
                ]);
            }
        }
    }
}

