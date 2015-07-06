# Organizer Organów

**To nie przyszłość. Już dziś przywitaj Jutro.**

## Organizer Organów. Nareszcie.
Dzięki **wizjonerstwu** naszych programistów oraz użyciu najbardziej zaawansowanych technologii na świecie, jesteśmy w stanie zaoferować Ci **najwyższej jakości narzędzie do zarządzania organami**. Zmieni to nie tylko Twoje życie, ale także życie osób, które pozyskają organy dzięki wykorzystaniu naszej aplikacji.
## Niespotykane możliwości.
Dzięki tak **futurystycznym rozwiązaniom** jak *dodawanie*, *edycja* oraz *usuwanie* rekordów w bazie danych, wkrótce przekonasz się, że Organizer Organów wyprzedza swoją epokę jeśli chodzi o funkcjonalność i prostotę obsługi.
## Dołącz już dziś.
Zostań częścią czegoś wielkiego i **już dziś** zacznij używać Organizera Organów.

Promocja dla pierwszych 10 użytkowników: **2.999 zł** (zwykła cena: 10.899 zł)

**Bądź pierwszy!**


- - - -

# A tak na serio...

...to jest projekt na przedmiot "Projekt Bazodanowy". Składa się z 15 tabel, w tym 3 tabele na potrzeby relacji wiele-do-wielu. Użyte technologie to PHP* i MySQL (no i przy okazji bawiłam się _flexible box model_ z CSS3, bo to wtedy była nowość)



Projekt ten pokazuje, że dobrze odnajduję się w pisaniu zapytań do bazy takich jak np. to:



			SELECT 
				uzytkownik_id AS 'id',
				imie, 
				nazwisko, 
				email,
				pesel, 
				COUNT(donacje.id) AS 'donacji'
			FROM uzytkownicytorole
				JOIN uzytkownicy ON uzytkownik_id = uzytkownicy.id
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
				LEFT JOIN donacje ON uzytkownik_id = donacje.dawca_id
			WHERE rola_id = 1
			GROUP BY uzytkownik_id

Organizer Organów przeznaczony jest do używania w placówkach pobierających organy od ludzi. Posiada bazę dawców oraz pomaga w zarządzaniu donacjami, np. przechowując informacje o bankach organów.

Oprogramowanie pozwala zdefiniować
- jakie organy mogą być przyjmowane, np. nerka, ząb mądrości czy pryszcz z czoła
- role (dawca, pracownik, handlarz)
- stanowiska (dyrektor, project manager ds. przechowywania narządów)
- państwa, grupy krwi.

Funkcje te rzecz jasna należy traktować z przymróżeniem oka...

Dużą zaletą jest moduł użytkowników - system pozwala definiować role oraz przypisywać różnym rolom dostęp do różnych funkcji systemu. Pozwala to np. udostępnić pewien rodzaj zasobów tylko dla pracowników, a inny dla dawców.

_\* ten PHP to jest na poziomie "klasę i pętlę to we wszystkim napiszę", ale nie on jest tu gwiazdą programu. Ja w każdym razie nigdzie nie deklaruję, że jestem specem od PHP._
