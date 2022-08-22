Zadatak i ciljevi
Potrebno je kreirati aplikaciju
Jela svijeta
koristeći
Laravel framework
(Verzija
5.0+). Ova aplikacija se sastoji od baze jela, sastojaka, kategorija i tagova.
S obzirom da je aplikacija višejezična, jela, sastojci, kategorije i tagovi imaju
tablice prijevoda. Također postoji i tablica jezika u kojoj se nalaze dostupni jezici.
Moguce koristiti Laravel Translatable paket
https://github.com/Astrotomic/laravel-translatable
Tablice je potrebno kreirati korištenjem migracija.
Tablice se trebaju popuniti podatcima korištenjem seedera i paketa “Fzaninotto /
faker”.
Poželjno je koristiti “Dependency Injection”.
Cilj ovog zadatka je vidjeti koliko dobro kandidat poznaje laravel api, a pri
rješavanju zadatka trebao bi se pridržavati “SOLID design principles”.
Aplikacija treba imati jedan endpoint na kojem se trebaju izlistavati jela. Koji
podatci se prikazuju i kako, ovisi o parametrima u query-ju.
Pretpostavimo da sva jela imaju unesen isti broj prijevoda koji je identičan broju
jezika u tablici languages.
•
Jelo može biti bez kategorije, ili može pripadatati samo jednoj kategoriji
•
Jelo mora imati definiran barem jedan tag
•
Jelo mora imati definiran barem jedan sastojak
Svi sastojci imaju isti broj prijevoda koji je identičan broju jezika u tablici
languages.
Potrebno je napraviti validaciju svih parametara requesta po kojima ce se filtrirati
rezultati baze