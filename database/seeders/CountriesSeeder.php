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
            'flag' => '🇦🇱',
            'song_title' => 'Karma',
            'artist' => 'Anxhela Peristeri',
        ],
        [
            'name' => 'Australia',
            'flag' => '🇦🇺',
            'song_title' => 'Technicolour',
            'artist' => 'Montaigne',
        ],
        [
            'name' => 'Austria',
            'flag' => '🇦🇹',
            'song_title' => 'Amen',
            'artist' => 'Vincent Bueno',
        ],
        [
            'name' => 'Azerbaijan',
            'flag' => '🇦🇿',
            'song_title' => 'Mata Hari',
            'artist' => 'Efendi',
        ],
        [
            'name' => 'Belgium',
            'flag' => '🇧🇪',
            'song_title' => 'The Wrong Place',
            'artist' => 'Hooverphonic',
        ],
        [
            'name' => 'Bulgaria',
            'flag' => '🇧🇬',
            'song_title' => 'Growing Up is Getting Old',
            'artist' => 'VICTORIA',
        ],
        [
            'name' => 'Croatia',
            'flag' => '🇭🇷',
            'song_title' => 'Tick-Tock',
            'artist' => 'Albina',
        ],
        [
            'name' => 'Cyprus',
            'flag' => '🇨🇾',
            'song_title' => 'El Diablo',
            'artist' => 'Elena Tsagrinou',
        ],
        [
            'name' => 'Czech Republic',
            'flag' => '🇨🇿',
            'song_title' => 'Omaga',
            'artist' => 'Benny Cristo',
        ],
        [
            'name' => 'Denmark',
            'flag' => '🇩🇰',
            'song_title' => 'Øve os på hinanden',
            'artist' => 'Fyr og Flamme',
        ],
        [
            'name' => 'Estonia',
            'flag' => '🇪🇪',
            'song_title' => 'The Lucky One',
            'artist' => 'Uku Suviste',
        ],
        [
            'name' => 'Finland',
            'flag' => '🇫🇮',
            'song_title' => 'Dark Side',
            'artist' => 'Blind Channel',
        ],
        [
            'name' => 'France',
            'flag' => '🇫🇷',
            'song_title' => 'Voilà',
            'artist' => 'Barbara Pravi',
        ],
        [
            'name' => 'Georgia',
            'flag' => '🇬🇪',
            'song_title' => 'You',
            'artist' => 'Tornike Kipiani',
        ],
        [
            'name' => 'Germany',
            'flag' => '🇩🇪',
            'song_title' => "I Don't Feel Hate",
            'artist' => 'Jendrik',
        ],
        [
            'name' => 'Greece',
            'flag' => '🇬🇷',
            'song_title' => 'Last Dance',
            'artist' => 'Stefania',
        ],
        [
            'name' => 'Iceland',
            'flag' => '🇮🇸',
            'song_title' => '10 Years',
            'artist' => 'Daði og Gagnamagnið',
        ],
        [
            'name' => 'Ireland',
            'flag' => '🇮🇪',
            'song_title' => 'Maps',
            'artist' => 'Lesley Roy',
        ],
        [
            'name' => 'Israel',
            'flag' => '🇮🇱',
            'song_title' => 'Set Me Free',
            'artist' => 'Eden Alene',
        ],
        [
            'name' => 'Italy',
            'flag' => '🇮🇹',
            'song_title' => 'Zitti e buoni',
            'artist' => 'Måneskin',
        ],
        [
            'name' => 'Latvia',
            'flag' => '🇱🇻',
            'song_title' => 'The Moon Is Rising',
            'artist' => 'Samanta Tina',
        ],
        [
            'name' => 'Lithuania',
            'flag' => '🇱🇹',
            'song_title' => 'Discoteque',
            'artist' => 'THE ROOP',
        ],
        [
            'name' => 'Malta',
            'flag' => '🇲🇹',
            'song_title' => 'Je Me Casse',
            'artist' => 'Destiny',
        ],
        [
            'name' => 'Moldova',
            'flag' => '🇲🇩',
            'song_title' => 'Sugar',
            'artist' => 'Natalia Gordienko',
        ],
        [
            'name' => 'The Netherlands',
            'flag' => '🇳🇱',
            'song_title' => 'Birth of a New Age',
            'artist' => 'Jeangu Macrooy',
        ],
        [
            'name' => 'North Macedonia',
            'flag' => '🇲🇰',
            'song_title' => 'Here I Stand',
            'artist' => 'Vasil',
        ],
        [
            'name' => 'Norway',
            'flag' => '🇳🇴',
            'song_title' => 'Fallen Angel',
            'artist' => 'TIX',
        ],
        [
            'name' => 'Poland',
            'flag' => '🇵🇱',
            'song_title' => 'The Ride',
            'artist' => 'Rafał',
        ],
        [
            'name' => 'Portugal',
            'flag' => '🇵🇹',
            'song_title' => 'Love Is on My Side',
            'artist' => 'The Black Mamba',
        ],
        [
            'name' => 'Romania',
            'flag' => '🇷🇴',
            'song_title' => 'Amnesia',
            'artist' => 'Roxen',
        ],
        [
            'name' => 'Russia',
            'flag' => '🇷🇺',
            'song_title' => 'Russian Woman',
            'artist' => 'Manizha',
        ],
        [
            'name' => 'San Marino',
            'flag' => '🇸🇲',
            'song_title' => 'Adrenalina',
            'artist' => 'Senhit',
        ],
        [
            'name' => 'Serbia',
            'flag' => '🇷🇸',
            'song_title' => 'Loco Loco',
            'artist' => 'Hurricane',
        ],
        [
            'name' => 'Slovenia',
            'flag' => '🇸🇮',
            'song_title' => 'Amen',
            'artist' => 'Ana Soklič',
        ],
        [
            'name' => 'Spain',
            'flag' => '🇪🇸',
            'song_title' => 'Voy a quedarme',
            'artist' => 'Vlas Cantó',
        ],
        [
            'name' => 'Sweden',
            'flag' => '🇸🇪',
            'song_title' => 'Voices',
            'artist' => 'Tusse',
        ],
        [
            'name' => 'Switzerland',
            'flag' => '🇨🇭',
            'song_title' => "Tout l'univers",
            'artist' => "Gjon's Tears",
        ],
        [
            'name' => 'Ukraine',
            'flag' => '🇺🇦',
            'song_title' => 'SHUM',
            'artist' => 'Go_A',
        ],
        [
            'name' => 'United Kingdom',
            'flag' => '🇬🇧',
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
