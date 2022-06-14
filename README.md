# Berichtsheft Generator für BS-INFO

Bist du es nicht auch Leid ein Berichtsheft zu schreiben. KOMM IN DIE GRUPPE
Jokes aside... hier findet ihr wie ihr das Programm für euer PDF Template anpassen könnt

## Installation

Als erstes benötigt ihr [Docker](https://docs.docker.com/get-docker/).... wer das nicht hat... lost.

So nun einmal bitte im Verzeichnis wo die `docker-compose.yml` liegt, diesen Command ausführen:
```bash
docker-compose up -d
```

anschließend müsst ihr nur noch in eurem Browser den [localhost](http://localhost) öffnen und ihr solltet den 
Generator sehen

## Verwendung

Als erstes solltet ihr euer PDF als leeres Document mit nur eurem Namen etc mit der Datei **`templatedoc.pdf`** austauschen
Wenn ihr wollt könnt ihr aber auch erstmal Testdaten eintragen und euch das Grid herunterladen. 

Um eure Tätigkeiten als Rainbow List einzuträgen müsst ihr die `liste.txt` bearbeiten
und tätigkeiten bitte mit einem Zeilenumbruch trennen.

Einfach` Anfangsdatum` und `Enddatum` auswählen, `Startnummer` eintragen und lets go.

## Neue Koordinaten zuweisen

Wenn ihr euer eigenes Template verwendet, müsst ihr mit ziemlich hoher wahrscheinlichkeit neue Koordinaten
für das Datum, die fortlaufenden Zahl, etc angeben.

Damit ihr wisst wo euer Text am Ende hin soll, solltet ihr euch einmal das Shitty Grid herunterladen (der Button ganz unten auf der UI)


Danach die neuen Koordinaten in der Datei get-doc.php eintragen, der Code schaut so aus:

```php 

//Start Editing the Doc

$pdf->SetFont('Arial');
$pdf->SetFontSize(11.5);
$pdf->SetTextColor(0,0,0);

//Week
$pdf->SetXY(77,39.85);
$pdf->Write(0, $week);

//Monday
$pdf->SetXY(89.3,39.85);
$pdf->Write(0, $monday);

//Friday
$pdf->SetXY(123.7,39.85);
$pdf->Write(0, $friday);

//Year
$pdf->SetXY(180.6,39.85);
$pdf->Write(0, $year);

//End Editing the Doc
    
```

Hier müsst ihr in den Funktionen `SetXY(180.6,39.85);` eure Werte eintragen und ein wenig herumprobieren.


## Contributing
Falls ihr verbesserungsvorschläge oder added Features habt, gerne request schicken.