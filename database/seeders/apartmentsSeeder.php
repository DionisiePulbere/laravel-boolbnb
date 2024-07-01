<?php

namespace Database\Seeders;
use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class apartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newApartment1 = new Apartment();
        $newApartment1->user_id = 1;
        $newApartment1->title = 'Baita Elio';
        $newApartment1->slug = Str::slug($newApartment1->title, '-');
        $newApartment1->visibility = 0;
        $newApartment1->thumb = 'https://vacanzeinbaita.com/wp-content/uploads/2023/09/baita_elio-2.jpg';
        $newApartment1->description = 'UBICAZIONE: Posizione unica, immersa nella natura in tranquillità. Si trova a 1300 m di altitudine e si affaccia su un panorama mozzafiato ai piedi della catena del Lagorai. Al suo interno troverete tutti i confort per trascorrere la vostra vacanza in pieno relax. La zona è rinomata per splendide escursioni sia a piedi che in mountain bike infatti ci troviamo a 20 minuti dalla partenza per Cima d’Asta e in circa 15 minuti è possibile raggiungere il Passo Brocon, dove in inverno troviamo gli impianti sciistici e passeggiate con le ciaspole e nella stagione estiva sono aperte diverse malghe.CARATTERISTICHE: Baita recentemente ristrutturata, costruita in sassi e legno ed arredata in stile rustico. Immersa nella natura a ridosso del bosco e in mezzo a verdi prati. La baita è dotata di riscaldamento con stufa a pellet e stufa a legna per accogliere gli ospiti in ogni periodo dell’anno. La baita si sviluppa su due piani: piano terra con cucina dotata di frigo, forno elettrco, forno a microonde piano cottura a gas, lavastoviglie, completa di accessori e utensili, soggiorno open space e bagno con doccia, al primo piano due camere matrimoniali, una camera singola con possibilità di aggiungere lettino per i più piccoli e zona relax. Biancheria per camere, bagno e cucina e lavatrice. All’esterno ampio spazio verde attrezzato di tavolo con panche, sdraio, barbecue, zona relax con posto auto privato e garage.SERVIZI: A soli 5 km troviamo supermercato, ristorante/pizzeria, struttura con piscina riscaldata sauna, piste da sci Passo Broccon 10 km; equitazione e tiro con l’arco a 7 km. A Pieve Tesino (10 km) cooperativa, fioreria, farmacia, banca, ufficio postale, ristorante, bar, campo da golf “La Farfalla”, guardia medica e fermata autocorriere. A Strigno (25 km) stazione ferroviaria, a Borgo Valsugana (30 km) ospedale. Avrete modo di dedicarvi a varie attività come la visita alle grotte di Castello Tesino; la scoperta delle stelle all’osservatorio astronomico di Celado; la visita ai vari musei . A circa 30 km di distanza i laghi di Levico e Caldonazzo… balneabili da maggio a settembre, con spiagge libere alberate dotate del servizio “spiagge sicure”. Per rigenerare corpo e mente le terme di Levico, Vetriolo e Roncegno con acque uniche in Italia. Non può mancare una visita ad Arte Sella… Un luogo magico che si trova ad appena una decina di chilometri da Borgo Valsugana una rassegna di arte contemporanea immersa nella natura. Prezzi Durata minima del soggiorno: Quando non specificato espressamente, il soggiorno si intende di 3 giorni (2 notti), tranne nei periodi di alta stagione (dalla prima settimana di luglio all’ultima di agosto e dalla terza di dicembre alla seconda di gennaio comprese) quando è richiesta la permanenza di almeno una settimana.';
        $newApartment1->price =80;
        $newApartment1->number_of_room =$faker->randomDigit;
        $newApartment1->number_of_bed =$faker->randomDigit;
        $newApartment1->number_of_bath =$faker->randomDigit;
        $newApartment1->square_meters =$faker->numberBetween(50, 250);
        $newApartment1->latitude =46.091855;
        $newApartment1->longitude =11.585203;
        $newApartment1->address = 'Località Spiado, 38050 Pieve Tesino';
        $newApartment1->save();

        $newApartment2 = new Apartment();
        $newApartment2->user_id = 1;
        $newApartment2->title = 'Starhotels Grand Milan';
        $newApartment2->slug = Str::slug($newApartment2->title, '-');
        $newApartment2->visibility = 0;
        $newApartment2->thumb = 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/353683820.jpg?k=66bed98b477bd18606a7cd26c372280b27da7b687130654d0861b54143137a04&o=&hp=1';
        $newApartment2->description = 'Hai diritto a uno sconto Genius su Starhotels Grand Milan! Per risparmiare su questa struttura ti basta accedere.Situato a Saronno, l’hotel di design Starhotels Grand Milan offre una piscina coperta e si trova a 500 metri dalla Stazione di Saronno, con collegamenti per Milano. La struttura dispone di connessione WiFi gratuita, centro fitness, spa con sauna e bagno turco.Questo hotel a 4 stelle dista 2 km dall’uscita dell’autostrada A9 e 15 minuti di auto dalla Fiera di Milano Rho. Un servizio navetta disponibile a un costo aggiuntivo e su richiesta. Il servizio è soggetto a disponibilità.Caratterizzate da un design contemporaneo, le camere e suite presentano un moderno bagno. Tutte le sistemazioni sono provviste di aria condizionata e minibar.Inizierete la giornata con una colazione a buffet, e potrete gustare una selezione di piatti locali presso il ristorante Hostaria o scegliere l’Hostaria Cafè, ideale per rilassarvi con una bevanda.Il Grand Milan comprende anche imponenti strutture business per un totale di 14 sale riunioni, 11 delle quali dotate di illuminazione naturale.Troverete la piscina, l area fitness e il centro benessere al 9° piano della struttura.Le coppie apprezzano molto la posizione: l hanno valutata 8,4 per un viaggio a due.';
        $newApartment2->price =1200;
        $newApartment2->number_of_room =$faker->randomDigit;
        $newApartment2->number_of_bed =$faker->randomDigit;
        $newApartment2->number_of_bath =$faker->randomDigit;
        $newApartment2->square_meters =$faker->numberBetween(50, 250);
        $newApartment2->latitude =45.622784;
        $newApartment2->longitude =9.028299;
        $newApartment2->address ='Via Varese 23, 21047 Saronno';
        $newApartment2->save();

        $newApartment3 = new Apartment();
        $newApartment3->user_id = 1;
        $newApartment3->title = 'Villa De Luca';
        $newApartment3->slug = Str::slug($newApartment3->title, '-');
        $newApartment3->visibility = 0;
        $newApartment3->thumb = 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/506238459.jpg?k=e5fa290790d4b7e552ae387d0a65162967a5a4a05af66f9a59b0ec7d10591d52&o=&hp=1';
        $newApartment3->description = 'Featuring air-conditioned accommodation with a private pool, Villa De Luca - Luxury villa with terrace and Jacuzzi by the sea is set in Vico Equense. This beachfront property offers access to a balcony, free private parking and free WiFi. The property is non-smoking and is situated 100 metres from Le Axidie Beach.The spacious villa with a terrace and sea views features 3 bedrooms, a living room, a flat-screen TV, an equipped kitchen with a dishwasher and an oven, and 4 bathrooms with a bidet. Towels and bed linen are featured in the villa. For added privacy, the accommodation features a private entrance.Chicchi Beach is 300 metres from the villa, while Marina di Vico - Le Postali Beach is 1.3 km away. The nearest airport is Naples International Airport, 41 km from Villa De Luca - Luxury villa with terrace and Jacuzzi by the sea.';
        $newApartment3->price =6000;
        $newApartment3->number_of_room =$faker->randomDigit;
        $newApartment3->number_of_bed =$faker->randomDigit;
        $newApartment3->number_of_bath =$faker->randomDigit;
        $newApartment3->square_meters =$faker->numberBetween(50, 250);
        $newApartment3->latitude =40.659569;
        $newApartment3->longitude =14.418242 ;
        $newApartment3->address = 'Via Arcoleo 21, 80069 Vico Equense';
        $newApartment3->save();

        $newApartment4 = new Apartment();
        $newApartment4->user_id = 1;
        $newApartment4->title = 'Casa Patrizia Firenze';
        $newApartment4->slug = Str::slug($newApartment4->title, '-');
        $newApartment4->visibility = 0;
        $newApartment4->thumb = 'https://cf.bstatic.com/xdata/images/hotel/max1280x900/551108512.jpg?k=c1d7ad3d9d16a227b1867e41190394b6bb51315ccc6efa18f0320d957573ef19&o=&hp=1';
        $newApartment4->description = 'Located in Florence, 2.9 km from Fortezza da Basso - Convention Center and 3.4 km from Strozzi Palace, Casa Patrizia Firenze offers air conditioning. The property is set 5 km from Piazza del Duomo di Firenze, 5.4 km from Piazza della Signoria and 5.4 km from Cathedral of Santa Maria del Fiore. Free WiFi is available throughout the property and Santa Maria Novella is 2.9 km away.The 1-bedroom apartment comes with a living room with a flat-screen TV, a fully equipped kitchen with a microwave and a fridge, and 1 bathroom with a hair dryer. Towels and bed linen are provided in the apartment. For added privacy, the accommodation features a private entrance.Accademia Gallery is 5.8 km from the apartment, while San Marco Church in Florence is 5.9 km away. The nearest airport is Florence Airport, 7 km from Casa Patrizia Firenze.';
        $newApartment4->price =90;
        $newApartment4->number_of_room =$faker->randomDigit;
        $newApartment4->number_of_bed =$faker->randomDigit;
        $newApartment4->number_of_bath =$faker->randomDigit;
        $newApartment4->square_meters =$faker->numberBetween(50, 250);
        $newApartment4->latitude =43.787605;
        $newApartment4->longitude =11.230668;
        $newApartment4->address ='Via Claudio Monteverdi 72, 50144 Firenze';
        $newApartment4->save();
    }
}