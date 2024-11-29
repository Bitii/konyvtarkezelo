<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Translations;
use App\Models\Books;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        
        $books = [
            ['title' => 'Harry Potter és a bölcsek köve', 'description' => 'Egy varázslatos világba kalauzolja az olvasót, ahol Harry Potter, egy árva fiú megtudja, hogy varázsló, és meghívást kap a Roxfort Boszorkány- és Varázslóképző Szakiskolába. Barátaival, Hermione Grangerrel és Ron Weasley-vel rejtélyekbe bonyolódva próbálják megakadályozni, hogy a gonosz Voldemort megszerezze a bölcsek kövét, amely az örök élet titkát rejti. A történet során Harry szembesül múltjával, szülei elvesztésével, és azzal a sorssal, amiért ő lett Voldemort legyőzője. A cselekmény a barátság, bátorság és önfeláldozás fontosságát hangsúlyozza, miközben egy varázslatos világot tár elénk. Az izgalmas és tanulságos történet magával ragadja az olvasót, miközben szórakoztat és elgondolkodtat.', 'author' => 'J. K. Rowling', 'genre' => 'Fantázia', 'release_date' => '1997-06-26', 'keywords' => 'Harry Potter, Roxfort, varázsló, Voldemort, bölcsek köve, Hermione Granger, Ron Weasley, varázslóképző'],
            ['title' => 'Harry Potter és a titkok kamrája', 'description' => 'Harry második évét kezdi meg a Roxfortban, ahol újabb rejtélyekkel és veszélyekkel találkozik. A történet középpontjában egy ősi, titkos kamra áll, amelyből egy szörnyeteg szabadul el, megtámadva a diákokat. Harry barátaival, Hermione Grangerrel és Ron Weasley-vel megpróbálja kideríteni, ki nyitotta ki a kamrát, és megállítani a támadásokat. A nyomozás során Harry szembesül Tom Denem, Voldemort fiatalkori énjének emlékével, és kiderül, hogy ő képes beszélni a kígyók nyelvén, a parszaszóul. A regény izgalmas kalandjai mellett a bátorság, a lojalitás és a rejtett erő jelentőségét is kiemeli.', 'author' => 'J. K. Rowling', 'genre' => 'Fantázia', 'release_date' => '1998-07-02', 'keywords' => 'Harry Potter, Roxfort, varázsló, Voldemort, titkok kamrája, Hermione Granger, Ron Weasley, varázslóképző'],
        ];
        foreach ($books as $book){
            Books::create($book);
        }

        $translatedBooks = [
            ['book_id' => 1, 'translated_title' => 'Harry Potter and the Philosopher\'s Stone', 'translated_description' => 'It guides the reader to a magical world where Harry Potter, an orphan boy, learns that he is a wizard and is invited to Hogwarts School of Witchcraft and Wizardry. With his friends, Hermione Granger and Ron Weasley, he tries to prevent the evil Voldemort from obtaining the Philosopher\'s Stone, which hides the secret of eternal life. In the course of the story, Harry faces his past, the loss of his parents, and the fate that made him defeat Voldemort. The plot emphasizes the importance of friendship, courage and self-sacrifice, while presenting a magical world. The exciting and educational story captivates the reader while entertaining and thought-provoking.', 'translated_genre' => 'Fantasy', 'translated_keywords' => 'Harry Potter, Hogwarts, wizard, Voldemort, philosopher\'s stone, Hermione Granger, Ron Weasley, wizarding school'],
        ];
        foreach ($translatedBooks as $translatedBook){
            Translations::create($translatedBook);
        }
    }
}
