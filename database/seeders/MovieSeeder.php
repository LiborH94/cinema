<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'name' => 'Spider-man',
                'description' => 'Film na motivy marvelovského komiksu je příběhem podivínského středoškoláka Petera Parkera (Tobey Maguire). Jako dítě osiřel, byl šikanován a nebyl schopen vyznat lásku okouzlující dívce ze sousedství Mary Jane Watsonové. Říct o jeho životě, že je to bída, by asi bylo dost slabé slovo. Ovšem jednoho krásného dne, když ho na exkurzi v laboratoři pokouše uprchlý radioaktivní pavouk, se jeho život změní tak, jak by si sotva kdo dokázal představit. Peter získá netušenou pružnost, jasné vidění, schopnost přichytit se k povrchu, šplhat po zdech a vystřelovat sítě ze zápěstí, ale ona to nebude jenom zábava. Výstřední milionář Norman Osborn (Willem Dafoe) na sobě vyzkouší účinek drog, čímž vznikne jeho maniakální alter ego Green Goblin. Peter se tudíž musí stát Spider-Manem a vzít si Green Goblina na starost, jinak ho Goblin zabije. (HBO Europe)',
                'image_path' => 'movies/spiderman1.jpg',
            ],
            [
                'name' => 'Spider-man 2',
                'description' => 'Od chvíle, kdy se Peter Parker (Tobey Maguire) rozhodl opustit svou dlouholetou lásku Mary Jane Watson (Kirsten Dunst), aby se mohl v kostýmu Spider-Mana i nadále zodpovědně věnovat svému povolání superhrdiny, uplynuly dva roky. Jeho touha po milované M.J. se ale postupem času stala ještě silnější a proto si nyní pohrává s myšlenkou, že by se tajného života superhrdiny na důkaz své lásky vzdal. M.J. se však mezitím rozhodla jít dál vydala se na dráhu filmové herečky a v jejím životě figuruje nový muž. Peter má problémy i se svým nejlepším přítelem Harrym Osbornem (James Franco). Jejich kamarádský vztah začíná být stále více zastíněn Harryho záští vůči Spider-Manovi, jehož viní ze smrti svého otce. Když už se zdá, že se situace nemůže změnit k horšímu, je Peter postaven tváří v tvář mocnému Dr. Octopusovi (Alfred Molina) ďábelské stvůře s dvěma páry smrtících chapadel, která je mu více než důstojným protivníkem. Aby dokázal jeho řádění zastavit, musí se naučit žít se svým osudem a využít všech svých schopností, které jsou mu zároveň darem i prokletím. (oficiální text distributora)',
                'image_path' => 'movies/spiderman2.jpg',
            ],
            [
                'name' => 'Kačer Donald',
                'description' => 'Zvědavý kačer Donald se vydává do tajemného světa fantazie. Dojde až do Kouzelného světa matematiky. A je to opravdu kouzelná země, kde mají stromy hranaté kořeny a v řekách proudí čísla! (oficiální text distributora)',
                'image_path' => 'movies/donald.jpg',
            ],
            [
                'name' => 'Forrest Gump',
                'description' => 'Zemeckisův film je brilantním shrnutím dosavadních režisérových poznatků o možnostech "comicsového" vyprávění. Formálně i obsahově nejméně konvenční z jeho snímků přesvědčuje komediálními gagy i naléhavě patetickým tónem. Jeho hrdinou je prosťáček Forrest Gump, typický obyčejný muž, který od dětství dělal, co se mu řeklo. Do života si tak odnesl několik ponaučení své pečlivé maminky a osvědčené pravidlo, jež se mu hodí mnohokrát v nejrůznějších situacích: Když se dostaneš do problémů, utíkej. Forrest proutíká školou, jako hráč amerického fotbalu i univerzitou, potom peklem vietnamské války a zoufalstvím nad matčinou smrtí. Vždycky je totiž někdo nebo něco, co po něm skutečně či obrazně "hází kameny". Nakonec však Forrest poznává, že jsou i jiná řešení situací než útěk. Svůj život spojuje s kamarádkou ze školy Jenny, která pro něj zůstane provždycky jedinou láskou, s přítelem z vojny, černochem Bubbou, který dá směr jeho úvahám o lovu krevet a s poručíkem Taylorem, jemuž ve Vietnamu zachrání život. Forrestova životní pouť od 50. do 80. let je koncipovaná jako totálně "bezelstné" vyprávění hrdiny, neschopného obecnějšího hodnocení situace. Forrest jako sportovec i jako válečný hrdina se setkává se slavnými lidmi, které nakonec vždycky někdo zastřelí (J. F. Kennedy, J. Lennon). Také jeho bližní umírají, ale on sám zůstává. Empiricky se dopracovává od impulsivního útěku před životem k úvahám o lidském osudu a o Bohu. Soukromý hrdinův osud zároveň postihuje třicet let poválečných amerických dějin. (oficiální text distributora)',
                'image_path' => 'movies/forrest.jpg',
            ],
            [
                'name' => 'Mickey Mouse',
                'description' => 'Myšák Mickey je považován za symbol radosti a nevinnosti prakticky ve všech koutech světa. Mickey se stal přes noc senzací, když se objevil v prvním krátkém animovaném filmu se zvukem Parník Willie. V průběhu desetiletí se měnil do nápadně odlišných verzí, které odrážejí jak pozoruhodnou kariéru jeho tvůrce, tak dramatické společenské změny národu, který začal reprezentovat. (Disney+)',
                'image_path' => 'movies/mickey.jpg',
            ],
            [
                'name' => 'Garfield ve filmu',
                'description' => 'Kocoura Garfielda má každý rád. Válí se v křesle, kouká na telku a pochutnává si na svých oblíbených lazaních. Sem tam se pustí do svého páníčka Jona, i tak je ale králem vlastního vesmíru. Jednoho dne vezme Jon Garfielda k překrásné veterinářce Liz Wilsonové, odkud si přinesou domů malé vrčící nic, co běhá za vlastním ocáskem a které Garfield k smrti nenávidí - pejska Odieho. Tenhle malý ničema si může doma dělat, co chce: neustále bezdůvodně štěká, hloupě naráží do zdí, ale zdá se, že Jon je z něj úplně vedle a všechno na světě mu projde. Garfieldova mise je jasná - dostat čokla z domu! A tak když se Odieho zmocní zvrhlá místní celebrita Happy Chapman, jeden by si myslel, že se Garfieldovi uleví. Ten se však k překvapení všech vydává na záchranu svého štěkajícího a všekousajícího přítele. (HBO Europe)',
                'image_path' => 'movies/garfield.jpg',
            ],
            [
                'name' => 'Titanic',
                'description' => 'V dubnu 1912 vyrazila luxusní zaoceánská loď Titanic z Anglie na svou první, a bohužel i poslední plavbu. Své pasažéry ale do cíle cesty nikdy nedovezla – narazila na ledovec a klesla pod hladinu. Tím začalo drama největší námořní katastrofy v dějinách lidstva. V ledových vodách Atlantiku skončilo mnoho životů a osudů. Mezi nimi byla i jedna láska, která vlastně ani pořádně nezačala. Americký velkofilm v režii Jamese Camerona, oceněný jedenácti Oscary®, katapultoval mezi nejzářivější hvězdy Hollywoodu oba představitele hlavních rolí – Kate Winsletovou a Leonarda DiCapria. (Cinemax)',
                'image_path' => 'movies/titanic.jpg',
            ]
        ];

        foreach ($movies as $movie) {
            Movie::updateOrCreate(
                [
                    'name' => $movie['name'],
                    'description' => $movie['description'],
                    'image_path' => $movie['image_path'],
                ],
            );
        }
    }
}
