> :white_check_mark: *Jeśli będziesz mieć problem z rozwiązaniem tego zadania, poproś o pomoc na odpowiednim kanale na Slacku, tj. `s5e06-php-refactoring` (dotyczy [mentee](https://devmentor.pl/mentoring/)) lub na ogólnodostępnej i bezpłatnej [społeczności na Discordzie](https://devmentor.pl/discord). Pamiętaj, aby treść Twojego wpisu spełniała [odpowiednie kryteria](https://devmentor.pl/jak-prosic-o-pomoc/).*

&nbsp;

# `#01` PHP: Refactoring Techniques


Wybierz dowolną klasę, którą do tej pory stworzyłeś (np. `Table`, `Database`, `Router`) i postaraj się ją podzielić na mniejsze elementy (klasy), zgodnie z [zasadą pojedynczej odpowiedzialności tj. SRP](https://pl.wikipedia.org/wiki/Zasada_jednej_odpowiedzialno%C5%9Bci).

Jeśli wybór padł na klasę `Table` to w jej przypadku możemy wydzielić osobny element, który nazwiemy `Renderer`. Będzie on odpowiadał za wyświetlanie danych. Może się okazać, żę zamiast generować zawartość tabeli w formie HTML to będziemy chceli wyświetlic ją w formie markdown.

Implementacja może wyglądać w ten sposób:

```
$table = new Table();
$html = $table->generate(new HTMLRender());
$md = $table->generate(new MDRenderer());
```

&nbsp;
> :no_entry: *Jeśli nie posiadasz materiałów do tego zadania tj. **Wideo**, znajdziesz je na stronie [laracasts.com](https://laracasts.com/referral/bogolubow)*

> :arrow_left: ~~*poprzednie zadanie*~~ | [*następne zadanie*](../02) :arrow_right:

Moja propozycja:
Klasę Table podzieliłam na:
1. class Column -- własciwości kolumny 
2. class TableConfigurator -- przechowuje dozwolone akcje ---  walidowane przez class ActionValidator 
3. class Tabela -- informacje o Tabeli, nazwa, kolumny i akcje
4. class DatabaseDataTable -- pobranie informacji do uzupełnienia tabeli z DB
5. class HtmlTableRender -- służy do generowania Html dla Tabeli

Przykład przygotowany na podstawie projektu który wykonalam po 4 dziale.