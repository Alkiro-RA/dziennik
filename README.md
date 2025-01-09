Projekt uruchamia się standardowo, po wrzuceniu plików do XAMPP w htdocs, należy uruchomić komendę:
composer install

następnie
php artisan migrate

Po uruchomieniu tych komend, projekt będzie gotowy do działania.

Do plików został dołączony plik dziennik.sql, który zawiera dane, które można zaimportować do bazy danych.

Aplikacja oferuje trzy poziomy dostępu, które definiują zakres działań użytkowników:

a) Uczeń
Konto przykładowe:
Email: uczen01@test.pl
Hasło: uczen01

b) Nauczyciel
Konto przykładowe:
Email: nauczyciel01@test.pl
Hasło: nauczyciel01

c) Administrator
Konto przykładowe:
Email: admin01@test.pl
Hasło: admin01

Po zalogowaniu, aplikacja przekieruje użytkownika w zależności od jego roli.

Funkcje aplikacji

1. Dla uczniów:
   Przeglądanie swoich ocen.

2. Dla nauczycieli:
   Dodawanie ocen dla uczniów w wybranych klasach i przedmiotach.

3. Dla administratorów:
   Zarządzanie użytkownikami w aplikacji (dodawanie, edytowanie, usuwanie).
   Tworzenie i zarządzanie klasami.
   Tworzenie przedmiotów i przypisywanie ich do klas.
   Dodawanie uczniów do klas.
