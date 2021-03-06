<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    const COUNTRIES = [
        [
            'name' => 'Albania',
            'flag' => 'ð¦ð±',
            'song_title' => 'Karma',
            'artist' => 'Anxhela Peristeri',
        ],
        [
            'name' => 'Australia',
            'flag' => 'ð¦ðº',
            'song_title' => 'Technicolour',
            'artist' => 'Montaigne',
        ],
        [
            'name' => 'Austria',
            'flag' => 'ð¦ð¹',
            'song_title' => 'Amen',
            'artist' => 'Vincent Bueno',
        ],
        [
            'name' => 'Azerbaijan',
            'flag' => 'ð¦ð¿',
            'song_title' => 'Mata Hari',
            'artist' => 'Efendi',
        ],
        [
            'name' => 'Belgium',
            'flag' => 'ð§ðª',
            'song_title' => 'The Wrong Place',
            'artist' => 'Hooverphonic',
        ],
        [
            'name' => 'Bulgaria',
            'flag' => 'ð§ð¬',
            'song_title' => 'Growing Up is Getting Old',
            'artist' => 'VICTORIA',
        ],
        [
            'name' => 'Croatia',
            'flag' => 'ð­ð·',
            'song_title' => 'Tick-Tock',
            'artist' => 'Albina',
        ],
        [
            'name' => 'Cyprus',
            'flag' => 'ð¨ð¾',
            'song_title' => 'El Diablo',
            'artist' => 'Elena Tsagrinou',
        ],
        [
            'name' => 'Czech Republic',
            'flag' => 'ð¨ð¿',
            'song_title' => 'Omaga',
            'artist' => 'Benny Cristo',
        ],
        [
            'name' => 'Denmark',
            'flag' => 'ð©ð°',
            'song_title' => 'Ãve os pÃ¥ hinanden',
            'artist' => 'Fyr og Flamme',
        ],
        [
            'name' => 'Estonia',
            'flag' => 'ðªðª',
            'song_title' => 'The Lucky One',
            'artist' => 'Uku Suviste',
        ],
        [
            'name' => 'Finland',
            'flag' => 'ð«ð®',
            'song_title' => 'Dark Side',
            'artist' => 'Blind Channel',
        ],
        [
            'name' => 'France',
            'flag' => 'ð«ð·',
            'song_title' => 'VoilÃ ',
            'artist' => 'Barbara Pravi',
        ],
        [
            'name' => 'Georgia',
            'flag' => 'ð¬ðª',
            'song_title' => 'You',
            'artist' => 'Tornike Kipiani',
        ],
        [
            'name' => 'Germany',
            'flag' => 'ð©ðª',
            'song_title' => "I Don't Feel Hate",
            'artist' => 'Jendrik',
        ],
        [
            'name' => 'Greece',
            'flag' => 'ð¬ð·',
            'song_title' => 'Last Dance',
            'artist' => 'Stefania',
        ],
        [
            'name' => 'Iceland',
            'flag' => 'ð®ð¸',
            'song_title' => '10 Years',
            'artist' => 'DaÃ°i og GagnamagniÃ°',
        ],
        [
            'name' => 'Ireland',
            'flag' => 'ð®ðª',
            'song_title' => 'Maps',
            'artist' => 'Lesley Roy',
        ],
        [
            'name' => 'Israel',
            'flag' => 'ð®ð±',
            'song_title' => 'Set Me Free',
            'artist' => 'Eden Alene',
        ],
        [
            'name' => 'Italy',
            'flag' => 'ð®ð¹',
            'song_title' => 'Zitti e buoni',
            'artist' => 'MÃ¥neskin',
        ],
        [
            'name' => 'Latvia',
            'flag' => 'ð±ð»',
            'song_title' => 'The Moon Is Rising',
            'artist' => 'Samanta Tina',
        ],
        [
            'name' => 'Lithuania',
            'flag' => 'ð±ð¹',
            'song_title' => 'Discoteque',
            'artist' => 'THE ROOP',
        ],
        [
            'name' => 'Malta',
            'flag' => 'ð²ð¹',
            'song_title' => 'Je Me Casse',
            'artist' => 'Destiny',
        ],
        [
            'name' => 'Moldova',
            'flag' => 'ð²ð©',
            'song_title' => 'Sugar',
            'artist' => 'Natalia Gordienko',
        ],
        [
            'name' => 'The Netherlands',
            'flag' => 'ð³ð±',
            'song_title' => 'Birth of a New Age',
            'artist' => 'Jeangu Macrooy',
        ],
        [
            'name' => 'North Macedonia',
            'flag' => 'ð²ð°',
            'song_title' => 'Here I Stand',
            'artist' => 'Vasil',
        ],
        [
            'name' => 'Norway',
            'flag' => 'ð³ð´',
            'song_title' => 'Fallen Angel',
            'artist' => 'TIX',
        ],
        [
            'name' => 'Poland',
            'flag' => 'ðµð±',
            'song_title' => 'The Ride',
            'artist' => 'RafaÅ',
        ],
        [
            'name' => 'Portugal',
            'flag' => 'ðµð¹',
            'song_title' => 'Love Is on My Side',
            'artist' => 'The Black Mamba',
        ],
        [
            'name' => 'Romania',
            'flag' => 'ð·ð´',
            'song_title' => 'Amnesia',
            'artist' => 'Roxen',
        ],
        [
            'name' => 'Russia',
            'flag' => 'ð·ðº',
            'song_title' => 'Russian Woman',
            'artist' => 'Manizha',
        ],
        [
            'name' => 'San Marino',
            'flag' => 'ð¸ð²',
            'song_title' => 'Adrenalina',
            'artist' => 'Senhit',
        ],
        [
            'name' => 'Serbia',
            'flag' => 'ð·ð¸',
            'song_title' => 'Loco Loco',
            'artist' => 'Hurricane',
        ],
        [
            'name' => 'Slovenia',
            'flag' => 'ð¸ð®',
            'song_title' => 'Amen',
            'artist' => 'Ana SokliÄ',
        ],
        [
            'name' => 'Spain',
            'flag' => 'ðªð¸',
            'song_title' => 'Voy a quedarme',
            'artist' => 'Vlas CantÃ³',
        ],
        [
            'name' => 'Sweden',
            'flag' => 'ð¸ðª',
            'song_title' => 'Voices',
            'artist' => 'Tusse',
        ],
        [
            'name' => 'Switzerland',
            'flag' => 'ð¨ð­',
            'song_title' => "Tout l'univers",
            'artist' => "Gjon's Tears",
        ],
        [
            'name' => 'Ukraine',
            'flag' => 'ðºð¦',
            'song_title' => 'SHUM',
            'artist' => 'Go_A',
        ],
        [
            'name' => 'United Kingdom',
            'flag' => 'ð¬ð§',
            'song_title' => 'Embers',
            'artist' => 'James Newman',
        ],
    ];

    public function run(): void
    {
        foreach (self::COUNTRIES as $country) {
            Country::firstOrCreate(
                ['name' => $country['name']],
                Arr::except($country, 'name')
            );
        }
    }
}
