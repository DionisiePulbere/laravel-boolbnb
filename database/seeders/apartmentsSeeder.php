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
        $newApartment1->title = 'Apartment Rozzano';
        $newApartment1->slug = Str::slug($newApartment1->title, '-');
        $newApartment1->visibility = 0;
        $newApartment1->thumb = 'https://a0.muscache.com/im/pictures/miso/Hosting-956228322388039322/original/8aa07575-1ae6-4058-8484-6233f96cec8d.jpeg?im_w=960';
        $newApartment1->description = 'UBICAZIONE: Posizione unica, immersa nella natura in tranquillità. Si trova a 1300 m di altitudine e si affaccia su un panorama mozzafiato ai piedi della catena del Lagorai. Al suo interno troverete tutti i confort per trascorrere la vostra vacanza in pieno relax. La zona è rinomata per splendide escursioni sia a piedi che in mountain bike infatti ci troviamo a 20 minuti dalla partenza per Cima d’Asta e in circa 15 minuti è possibile raggiungere il Passo Brocon, dove in inverno troviamo gli impianti sciistici e passeggiate con le ciaspole e nella stagione estiva sono aperte diverse malghe.CARATTERISTICHE: Baita recentemente ristrutturata, costruita in sassi e legno ed arredata in stile rustico. Immersa nella natura a ridosso del bosco e in mezzo a verdi prati. La baita è dotata di riscaldamento con stufa a pellet e stufa a legna per accogliere gli ospiti in ogni periodo dell’anno. La baita si sviluppa su due piani: piano terra con cucina dotata di frigo, forno elettrco, forno a microonde piano cottura a gas, lavastoviglie, completa di accessori e utensili, soggiorno open space e bagno con doccia, al primo piano due camere matrimoniali, una camera singola con possibilità di aggiungere lettino per i più piccoli e zona relax. Biancheria per camere, bagno e cucina e lavatrice. All’esterno ampio spazio verde attrezzato di tavolo con panche, sdraio, barbecue, zona relax con posto auto privato e garage.SERVIZI: A soli 5 km troviamo supermercato, ristorante/pizzeria, struttura con piscina riscaldata sauna, piste da sci Passo Broccon 10 km; equitazione e tiro con l’arco a 7 km. A Pieve Tesino (10 km) cooperativa, fioreria, farmacia, banca, ufficio postale, ristorante, bar, campo da golf “La Farfalla”, guardia medica e fermata autocorriere. A Strigno (25 km) stazione ferroviaria, a Borgo Valsugana (30 km) ospedale. Avrete modo di dedicarvi a varie attività come la visita alle grotte di Castello Tesino; la scoperta delle stelle all’osservatorio astronomico di Celado; la visita ai vari musei . A circa 30 km di distanza i laghi di Levico e Caldonazzo… balneabili da maggio a settembre, con spiagge libere alberate dotate del servizio “spiagge sicure”. Per rigenerare corpo e mente le terme di Levico, Vetriolo e Roncegno con acque uniche in Italia. Non può mancare una visita ad Arte Sella… Un luogo magico che si trova ad appena una decina di chilometri da Borgo Valsugana una rassegna di arte contemporanea immersa nella natura. Prezzi Durata minima del soggiorno: Quando non specificato espressamente, il soggiorno si intende di 3 giorni (2 notti), tranne nei periodi di alta stagione (dalla prima settimana di luglio all’ultima di agosto e dalla terza di dicembre alla seconda di gennaio comprese) quando è richiesta la permanenza di almeno una settimana.';
        $newApartment1->price =40;
        $newApartment1->number_of_room =$faker->randomDigit;
        $newApartment1->number_of_bed =$faker->randomDigit;
        $newApartment1->number_of_bath =$faker->randomDigit;
        $newApartment1->square_meters =$faker->numberBetween(50, 250);
        $newApartment1->latitude =45.373793;
        $newApartment1->longitude =9.156103;
        $newApartment1->address = 'Via del Volontariato, 20089 Rozzano';
        $newApartment1->save();

        $newApartment2 = new Apartment();
        $newApartment2->user_id = 2;
        $newApartment2->title = 'San Donato Apartment';
        $newApartment2->slug = Str::slug($newApartment2->title, '-');
        $newApartment2->visibility = 0;
        $newApartment2->thumb = 'https://a0.muscache.com/im/pictures/miso/Hosting-913093442967804602/original/64a95cd4-60ac-4292-9e81-9ebfcb380d1b.jpeg?im_w=960';
        $newApartment2->thumb = 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/353683820.jpg?k=66bed98b477bd18606a7cd26c372280b27da7b687130654d0861b54143137a04&o=&hp=1';
        $newApartment2->description = 'Hai diritto a uno sconto Genius su Starhotels Grand Milan! Per risparmiare su questa struttura ti basta accedere.Situato a Saronno, l’hotel di design Starhotels Grand Milan offre una piscina coperta e si trova a 500 metri dalla Stazione di Saronno, con collegamenti per Milano. La struttura dispone di connessione WiFi gratuita, centro fitness, spa con sauna e bagno turco.Questo hotel a 4 stelle dista 2 km dall’uscita dell’autostrada A9 e 15 minuti di auto dalla Fiera di Milano Rho. Un servizio navetta disponibile a un costo aggiuntivo e su richiesta. Il servizio è soggetto a disponibilità.Caratterizzate da un design contemporaneo, le camere e suite presentano un moderno bagno. Tutte le sistemazioni sono provviste di aria condizionata e minibar.Inizierete la giornata con una colazione a buffet, e potrete gustare una selezione di piatti locali presso il ristorante Hostaria o scegliere l’Hostaria Cafè, ideale per rilassarvi con una bevanda.Il Grand Milan comprende anche imponenti strutture business per un totale di 14 sale riunioni, 11 delle quali dotate di illuminazione naturale.Troverete la piscina, l area fitness e il centro benessere al 9° piano della struttura.Le coppie apprezzano molto la posizione: l hanno valutata 8,4 per un viaggio a due.';
        $newApartment2->price =120;
        $newApartment2->number_of_room =$faker->randomDigit;
        $newApartment2->number_of_bed =$faker->randomDigit;
        $newApartment2->number_of_bath =$faker->randomDigit;
        $newApartment2->square_meters =$faker->numberBetween(50, 250);
        $newApartment2->latitude =45.418985;
        $newApartment2->longitude =9.261377;
        $newApartment2->address ='Via Pace, 20097 San Donato Milanese';
        $newApartment2->save();

        $newApartment3 = new Apartment();
        $newApartment3->user_id = 1;
        $newApartment3->title = 'Bilocale Luxury';
        $newApartment3->slug = Str::slug($newApartment3->title, '-');
        $newApartment3->visibility = 0;
        $newApartment3->thumb = 'https://a0.muscache.com/im/pictures/miso/Hosting-1102227215773470197/original/e8c1b9fc-4a33-47ed-8807-02d58d45327a.jpeg?im_w=960';
        $newApartment3->description = 'Featuring air-conditioned accommodation with a private pool, Villa De Luca - Luxury villa with terrace and Jacuzzi by the sea is set in Vico Equense. This beachfront property offers access to a balcony, free private parking and free WiFi. The property is non-smoking and is situated 100 metres from Le Axidie Beach.The spacious villa with a terrace and sea views features 3 bedrooms, a living room, a flat-screen TV, an equipped kitchen with a dishwasher and an oven, and 4 bathrooms with a bidet. Towels and bed linen are featured in the villa. For added privacy, the accommodation features a private entrance.Chicchi Beach is 300 metres from the villa, while Marina di Vico - Le Postali Beach is 1.3 km away. The nearest airport is Naples International Airport, 41 km from Villa De Luca - Luxury villa with terrace and Jacuzzi by the sea.';
        $newApartment3->price =60;
        $newApartment3->number_of_room =$faker->randomDigit;
        $newApartment3->number_of_bed =$faker->randomDigit;
        $newApartment3->number_of_bath =$faker->randomDigit;
        $newApartment3->square_meters =$faker->numberBetween(50, 250);
        $newApartment3->latitude =45.544758;
        $newApartment3->longitude =10.226564;
        $newApartment3->address = 'Via Pusterla, Brescia';
        $newApartment3->save();

        $newApartment4 = new Apartment();
        $newApartment4->user_id = 2;
        $newApartment4->title = 'Casa Patrizia Firenze';
        $newApartment4->slug = Str::slug($newApartment4->title, '-');
        $newApartment4->visibility = 0;
        $newApartment4->thumb = 'https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE4MTgzMTcxNzY3MjA0NDIzMw%3D%3D/original/1a4f3584-4b44-4c20-a356-8e47a81dcb8e.jpeg?im_w=960';
        $newApartment4->description = 'Located in Florence, 2.9 km from Fortezza da Basso - Convention Center and 3.4 km from Strozzi Palace, Casa Patrizia Firenze offers air conditioning. The property is set 5 km from Piazza del Duomo di Firenze, 5.4 km from Piazza della Signoria and 5.4 km from Cathedral of Santa Maria del Fiore. Free WiFi is available throughout the property and Santa Maria Novella is 2.9 km away.The 1-bedroom apartment comes with a living room with a flat-screen TV, a fully equipped kitchen with a microwave and a fridge, and 1 bathroom with a hair dryer. Towels and bed linen are provided in the apartment. For added privacy, the accommodation features a private entrance.Accademia Gallery is 5.8 km from the apartment, while San Marco Church in Florence is 5.9 km away. The nearest airport is Florence Airport, 7 km from Casa Patrizia Firenze.';
        $newApartment4->price =90;
        $newApartment4->number_of_room =$faker->randomDigit;
        $newApartment4->number_of_bed =$faker->randomDigit;
        $newApartment4->number_of_bath =$faker->randomDigit;
        $newApartment4->square_meters =$faker->numberBetween(50, 250);
        $newApartment4->latitude =43.787605;
        $newApartment4->longitude =11.230668;
        $newApartment4->address ='Via Claudio Monteverdi, 50144 Firenze';
        $newApartment4->save();

        $newApartment5 = new Apartment();
        $newApartment5->user_id = 1;
        $newApartment5->title = 'EasyLife Buenos Aires';
        $newApartment5->slug = Str::slug($newApartment5->title, '-');
        $newApartment5->visibility = 0;
        $newApartment5->thumb = 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-1092617355496270460/original/e7a7c724-910b-41a6-997b-37bdcbd0479b.jpeg?im_w=960';
        $newApartment5->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment5->price =123;
        $newApartment5->number_of_room =$faker->numberBetween(1, 4);
        $newApartment5->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment5->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment5->square_meters =$faker->numberBetween(50, 250);
        $newApartment5->latitude =45.477703;
        $newApartment5->longitude =9.210577;
        $newApartment5->address ='Via Giorgio Jan, 20129 Milano';
        $newApartment5->save();

        $newApartment6 = new Apartment();
        $newApartment6->user_id = 2;
        $newApartment6->title = 'Appartamento Open Space';
        $newApartment6->slug = Str::slug($newApartment6->title, '-');
        $newApartment6->visibility = 1;
        $newApartment6->thumb = 'https://a0.muscache.com/im/pictures/miso/Hosting-909162726572829721/original/9eb615f8-3438-434c-acb8-6791533eb701.jpeg?im_w=960';
        $newApartment6->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment6->price =205;
        $newApartment6->number_of_room =$faker->numberBetween(1, 4);
        $newApartment6->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment6->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment6->square_meters =$faker->numberBetween(50, 250);
        $newApartment6->latitude =45.474928;
        $newApartment6->longitude =9.208752;
        $newApartment6->address ='Via Paolo Frisi, 20129 Milano';
        $newApartment6->save();

        $newApartment7 = new Apartment();
        $newApartment7->user_id = 1;
        $newApartment7->title = 'Appatamento In Brera';
        $newApartment7->slug = Str::slug($newApartment7->title, '-');
        $newApartment7->visibility = 0;
        $newApartment7->thumb = 'https://a0.muscache.com/im/pictures/miso/Hosting-1130332951551440501/original/b689847f-1477-4d6d-9cc4-2e86868953b4.jpeg?im_w=960';
        $newApartment7->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment7->price =111;
        $newApartment7->number_of_room =$faker->numberBetween(1, 4);
        $newApartment7->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment7->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment7->square_meters =$faker->numberBetween(50, 250);
        $newApartment7->latitude =45.471577;
        $newApartment7->longitude =9.185021;
        $newApartment7->address ='Via San Carpoforo, 20121 Milano';
        $newApartment7->save();

        $newApartment8 = new Apartment();
        $newApartment8->user_id = 2;
        $newApartment8->title = 'Melzo Apartment';
        $newApartment8->slug = Str::slug($newApartment8->title, '-');
        $newApartment8->visibility = 0;
        $newApartment8->thumb = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/84c8d403-47b2-4368-a0bd-5bc59e7d7063.jpeg?im_w=960';
        $newApartment8->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment8->price =79;
        $newApartment8->number_of_room =$faker->numberBetween(1, 4);
        $newApartment8->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment8->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment8->square_meters =$faker->numberBetween(50, 250);
        $newApartment8->latitude =45.474549;
        $newApartment8->longitude =9.208585;
        $newApartment8->address ='Via Melzo, 20129 Milano';
        $newApartment8->save();
        
        $newApartment9 = new Apartment();
        $newApartment9->user_id = 2;
        $newApartment9->title = 'Appartamento due camere';
        $newApartment9->slug = Str::slug($newApartment9->title, '-');
        $newApartment9->visibility = 0;
        $newApartment9->thumb = 'https://a0.muscache.com/im/pictures/84577249/13b842f3_original.jpg?im_w=960';
        $newApartment9->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment9->price =83;
        $newApartment9->number_of_room =$faker->numberBetween(1, 4);
        $newApartment9->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment9->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment9->square_meters =$faker->numberBetween(50, 250);
        $newApartment9->latitude =45.472977;
        $newApartment9->longitude =9.209776;
        $newApartment9->address ='Via Melzo, 20129 Milano';
        $newApartment9->save();

        $newApartment10 = new Apartment();
        $newApartment10->user_id = 1;
        $newApartment10->title = 'Boolean Loft';
        $newApartment10->slug = Str::slug($newApartment10->title, '-');
        $newApartment10->visibility = 1;
        $newApartment10->thumb = 'https://verdeprofilo.com/wp-content/uploads/2023/08/Progettare-ufficio-green.jpg';
        $newApartment10->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment10->price =5000;
        $newApartment10->number_of_room =$faker->numberBetween(1, 4);
        $newApartment10->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment10->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment10->square_meters =$faker->numberBetween(50, 250);
        $newApartment10->latitude =45.444269;
        $newApartment10->longitude =9.162701;
        $newApartment10->address ='Via Cassala, 20143 Milano';
        $newApartment10->save();

        $newApartment11 = new Apartment();
        $newApartment11->user_id = 1;
        $newApartment11->title = 'Cassano Apartment';
        $newApartment11->slug = Str::slug($newApartment11->title, '-');
        $newApartment11->visibility = 1;
        $newApartment11->thumb = 'https://a0.muscache.com/im/pictures/hosting/Hosting-1126489657627869050/original/d473b55f-5916-4525-ba5d-6915d459cc1c.jpeg?im_w=960';
        $newApartment11->description = 'Appartamento di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment11->price =5000;
        $newApartment11->number_of_room =$faker->numberBetween(1, 4);
        $newApartment11->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment11->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment11->square_meters =$faker->numberBetween(50, 250);
        $newApartment11->latitude =45.528537;
        $newApartment11->longitude =9.523278;
        $newApartment11->address ='Via Giuseppe Mazzini, 20062 Cassano d\'Adda';
        $newApartment11->save();

        $newApartment12 = new Apartment();
        $newApartment12->user_id = 1;
        $newApartment12->title = 'Villa Leonardo';
        $newApartment12->slug = Str::slug($newApartment12->title, '-');
        $newApartment12->visibility = 1;
        $newApartment12->thumb = 'https://a0.muscache.com/im/pictures/hosting/Hosting-1142713955355017474/original/f95d5750-b93a-48f7-a51f-1a255d1501ff.jpeg?im_w=960';
        $newApartment12->description = 'Villa di lusso situata nel cuore di Milano, questa residenza è il paradiso per chi cerca un ambiente elegante e raffinato. Con spazi luminosi e ampi, questa casa vanta finiture di alta qualità e un design moderno e chic. Con una cucina gourmet, una spaziosa zona living e camere da letto lussuose, questa villa è perfetta per chi ama lo stile di vita di lusso. Goditi il comfort e il prestigio di questa residenza esclusiva nel cuore di Milano.';
        $newApartment12->price =5000;
        $newApartment12->number_of_room =$faker->numberBetween(1, 4);
        $newApartment12->number_of_bed =$faker->numberBetween(1, 8);
        $newApartment12->number_of_bath =$faker->numberBetween(1, 2);
        $newApartment12->square_meters =$faker->numberBetween(50, 250);
        $newApartment12->latitude =45.526566;
        $newApartment12->longitude =9.504919;
        $newApartment12->address ='Via Leonardo da Vinci, 20062 Cassano d\'Adda';
        $newApartment12->save();
    }
}