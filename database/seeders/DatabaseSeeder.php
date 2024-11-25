<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
