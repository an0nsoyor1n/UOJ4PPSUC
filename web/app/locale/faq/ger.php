<?php

$oj_name = UOJConfig::$data['profile']['oj-name'];

$a3 = "
  <p>Die Standard-Bewertungsumgebung ist Ubuntu Linux 20.04 LTS x64.</p>
  <p>C-Kompiler – gcc 9.3.0, Kompilierungsbefehl: <code>gcc code.c -o code -lm -O2 -DONLINE_JUDGE</code>.</p>
  <p>C++-Kompiler – g++ 9.3.0, Kompilierungsbefehl: <code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>. Wenn C++11 ausgewählt ist, fügen Sie <code>-std=c++11</code> zum Kompilierungsbefehl hinzu.</p>
  <p>JDK Java8-Version – openjdk 1.8.0_275, Kompilierungsbefehl: <code>javac code.java</code>.</p>
  <p>JDK Java11-Version – openjdk 11.0.9, Kompilierungsbefehl: <code>javac code.java</code>.</p>
  <p>Pascal-Kompiler – fpc 3.0.4, Kompilierungsbefehl: <code>fpc code.pas -O2</code>.</p>
  <p>Python kompiliert in optimierte Bytecodes (<samp>.pyo</samp>). Unterstützte Versionen von Python sind Python 2.7 und 3.8.</p>
";

$a4 = "
<ul>
  <li>Accepted: Richtiges Ergebnis. Glückwunsch zu der Lösung dieser Aufgabe.</li>
  <li>Wrong Answer: Falsches Ergebnis. Das Bestehen der Testfälle bedeutet nicht unbedingt ein richtiges Ergebnis; es könnte etwas übersehen worden sein.</li>
  <li>Runtime Error: Laufzeitfehler. Probleme wie ungültiger Speicherzugriff, Überschreiten des Array-Bereichs, Verweiserverschiebungen oder Aufrufe von deaktivierten Systemfunktionen können dies verursachen. Klicken Sie für Details im Bewertungsbericht.</li>
  <li>Time Limit Exceeded: Zeitlimit überschritten. Überprüfen Sie, ob in Ihrem Programm eine Endlosschleife vorhanden ist oder ob eine schnellere Lösung möglich ist.</li>
  <li>Memory Limit Exceeded: Speicherlimit überschritten. Die Daten müssen möglicherweise komprimiert werden, oder Ihre Arrays sind zu groß. Überprüfen Sie auf Speicherlecks.</li>
  <li>Output Limit Exceeded: Ausgabe-Limit überschritten. Ihre Ausgabe ist viel länger als die korrekte Antwort!</li>
  <li>Dangerous Syscalls: Gefährliche Systemaufrufe. Sie haben einige Systemfunktionen (gefährlich) verwendet? Teilnehmer am CTF sollten sich an das Cyber SWAT-Team zur Netzwerksicherheit wenden.</li>
  <li>Judgement Failed: Bewertung fehlgeschlagen. Es können Probleme mit der Bewertungs-Maschine oder dem Server geben.</li>
  <li>No Comment: Keine Details. Wenn die Bewertungs-Maschine nichts über Ihr Programm sagt, können Sie uns die Situation melden oder erneut versuchen.</li>
</ul>
";

$q5 = "
Warum führt Rekursion bis zu 10<sup>7</sup> Ebenen nicht zu einem Stapelüberlauf?
";

$a5 = "<p>Außer in speziellen Fällen beträgt die Größe des Stapels bei der Bewertung auf " . $oj_name . " das Speicherlimit der Aufgabe. Für weitere Informationen können Sie die Entwickler-Community von UOJ per E-Mail kontaktieren.</p>";

$q6 = "Ich habe lokal/ auf einem anderen OJ AC erhalten, aber nicht auf " . $oj_name . ". Was soll ich tun?";
$a6 = "
<p>Für dieses Problem gibt es folgende mögliche Ursachen:</p>
<ul>
  <li>In Linux ist das Zeichen für ein neues Zeile '\n', während es in Windows '\r\n' ist (ein zusätzliches Zeichen). Daten, die unter Windows generiert wurden, funktionieren möglicherweise nicht in einer Linux-Bewertungs-Umgebung. Dies tritt häufig bei der Eingabe von Zeichenketten auf.</li>
  <li>Die Bewertungs-Umgebung basiert auf Linux und kann Laufzeitfehler verursachen, wenn reservierte Wörter von Linux verwendet werden, die unter Windows gut funktionieren.</li>
  <li>Linux setzt strengere Einschränkungen für den Speicherzugriff. Ungültige Zugriffe auf Zeiger oder Array-Indizes, die unter Windows funktionieren, können in der Bewertungs-Umgebung nicht funktionieren.</li>
  <li>Serious memory leaks können dazu führen, dass der Schutzmodul des Systems Ihren Prozess beendet. Daher muss jeder Speicher, der mit malloc (oder calloc, realloc, new) allokiert wurde, vollständig mit free (oder delete) freigegeben werden.</li>
  <li>Natürlich können die Daten tatsächlich falsch sein. Allerdings sollten Sie die Daten nicht in Frage stellen, wenn viele Leute die Aufgabe erfolgreich gelöst haben. Andernfalls melden Sie uns dies sofort!</li>
</ul>
";

$q7 = $oj_name . " Blog-Nutzungsanleitung";
$a7 = $oj_name . " verwendet Markdown für seinen Blog. Für spezifische Anleitungen zu Markdown suchen Sie im Internet. Kommentare unterstützen kein HTML, können jedoch mathematische Formeln verwenden.";

$q8 = "Wie man lokale Tests für interaktive Aufgaben durchführt";
$a8 = "
<p>(Es scheint, dass viele Leute nicht vertraut sind mit dem Kompilieren mehrerer Quelldateien zusammen. Hier ist eine Anleitung von UOJ als Referenz.)</p>
<p>Interaktive Aufgaben bieten in der Regel eine Header-Datei für die Inklusion und eine Quelldatei namens grader.</p>
<p>Für C++ : <code>g++ -o code grader.cpp code.cpp</code></p>
<p>Für C : <code>gcc -o code grader.c code.c</code></p>
<p>Wenn Sie Anfänger im Programmieren sind, machen Sie sich keine Sorgen! Sie können einfach den Inhalt der Datei grader nach Ihrer Include-Anweisung in Ihren Code einfügen.</p>
<p>Für Pascal : Es wird in der Regel eine grader bereitgestellt. Sie müssen eine Pascal-Einheit schreiben. Die grader wird Ihre Einheit verwenden. Benennen Sie daher Ihre Quelldatei als Einheitsname + <code>.pas</code>, dann:</p>
<p>Für Pascal : <code>fpc grader.pas</code></p>
<p>Das war's.</p>
";

$q9 = "Kontaktinformationen";
$a9 = "Wenn Sie Aufgaben vorschlagen, Wettbewerbe organisieren, Bugs melden oder Vorschläge für die Website haben möchten, können Sie uns auf folgende Weise kontaktieren:
<ul>
  <li>Melden Sie ein Problem im offiziellen GitHub-Repository: https://github.com/Andrew82106/UOJ4PPSUC</li>
  <li>Joinen Sie Cyber SWAT und diskutieren Sie Ihre Ideen mit dem aktuellen Algorithmus-Team-Leiter</li>
</ul>
";

return [
    'q1' => 'Was ist ' . $oj_name . '?',
    'a1' => $oj_name . ' ist eine Plattform für Studenten der PPSUC, um ihre Programmierfähigkeiten zu entwickeln, entwickelt und betreut von PPSUC Cyber SWAT. ' . $oj_name . ' sammelt Programmieraufgaben in Python, C/C++ und Java und organisiert Programmierwettbewerbe. Alle sind eingeladen, teilzunehmen.',
    'q4' => 'Wie man nach der Registrierung ein Profilbild hochladen kann',
    'a4' => $oj_name . ' bietet keinen Dienst für das Speichern von Profilbildern. Jedoch unterstützt ' . $oj_name . ', ähnlich wie UOJ, Gravatar.',
    'q3' => 'Bewertungs-Umgebung von ' . $oj_name . '?',
    'a3' => $a3,
    'q2' => 'Bedeutungen der verschiedenen Bewertungs-Statuse',
    'a2' => $a4,
	'q5' => $q5,
	'a5' => $a5,
	'q6' => $q6,
	'a6' => $a6,
	'q7' => $q7,
	'a7' => $a7,
	'q8' => $q8,
	'a8' => $a8,
	'q9' => $q9,
	'a9' => $a9
];