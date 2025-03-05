<?php

$oj_name = UOJConfig::$data['profile']['oj-name'];

$a3 = "
  <p>L'environnement d'évaluation par défaut est Ubuntu Linux 20.04 LTS x64.</p>
  <p>Le compilateur C est gcc 9.3.0, la commande de compilation : <code>gcc code.c -o code -lm -O2 -DONLINE_JUDGE</code>.</p>
  <p>Le compilateur C++ est g++ 9.3.0, la commande de compilation : <code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>. Si C++11 est choisi, ajoutez <code>-std=c++11</code> à la commande de compilation.</p>
  <p>La version du JDK Java8 est openjdk 1.8.0_275, la commande de compilation : <code>javac code.java</code>.</p>
  <p>La version du JDK Java11 est openjdk 11.0.9, la commande de compilation : <code>javac code.java</code>.</p>
  <p>Le compilateur Pascal est fpc 3.0.4, la commande de compilation : <code>fpc code.pas -O2</code>.</p>
  <p>Python compile en fichiers bytecode optimisés (<samp>.pyo</samp>). Les versions de Python supportées sont Python 2.7 et 3.8.</p>
";

$a4 = "
<ul>
  <li>Accepted: La réponse est correcte. Félicitations pour avoir réussi ce problème.</li>
  <li>Wrong Answer: La réponse est incorrecte. Passer les données d'exemple ne signifie pas nécessairement que la réponse est correcte ; il y a probablement quelque chose que vous n'avez pas envisagé.</li>
  <li>Runtime Error: Erreur d'exécution. Des problèmes comme l'accès illégal à la mémoire, le dépassement de tableau, le décalage de pointeur ou l'appel de fonctions système désactivées peuvent causer cela. Cliquez pour obtenir des détails dans le rapport d'évaluation.</li>
  <li>Time Limit Exceeded: Limite de temps dépassée. Vérifiez si votre programme contient une boucle infinie ou s'il existe une solution plus rapide.</li>
  <li>Memory Limit Exceeded: Limite de mémoire dépassée. Les données peuvent nécessiter une compression, ou vos tableaux peuvent être trop grands. Vérifiez pour des fuites de mémoire.</li>
  <li>Output Limit Exceeded: Limite de sortie dépassée. Votre sortie est beaucoup plus longue que la réponse correcte !</li>
  <li>Dangerous Syscalls: Appels système dangereux. Avez-vous inclus des fichiers ou utilisé certaines fonctions système (dangereuses) ? Les participants CTF doivent contacter le département Cyber SWAT de Défense Réseau.</li>
  <li>Judgement Failed: Echec de l'évaluation. Il peut y avoir des problèmes avec la machine d'évaluation ou le serveur.</li>
  <li>No Comment: Pas de détails. Si la machine d'évaluation n'a rien à dire sur votre programme, vous pouvez nous signaler la situation ou soumettre à nouveau.</li>
</ul>
";

$q5 = "
Pourquoi la récursion jusqu'à 10<sup>7</sup> couches ne provoque-t-elle pas un dépassement de pile ?
";

$a5 = "<p>Sauf cas particulier, la taille de la pile lors de l'évaluation sur " . $oj_name . " est égale à la limite de mémoire du problème. Pour plus de détails, vous pouvez envoyer un e-mail à la communauté de développement UOJ.</p>";

$q6 = "J'ai obtenu AC localement/ sur un autre OJ, mais pas sur " . $oj_name . ". Que dois-je faire ?";
$a6 = "
<p>Pour ce type de problème, voici quelques raisons possibles :</p>
<ul>
  <li>Dans Linux, le caractère de nouvelle ligne est '\n', tandis que dans Windows c'est '\r\n' (un caractère supplémentaire). Certaines données générées sous Windows peuvent ne pas fonctionner dans l'environnement d'évaluation Linux. Cela est très courant dans l'entrée de chaînes.</li>
  <li>Le système d'évaluation est basé sur Linux, qui peut causer des erreurs d'exécution en raison de l'utilisation de mots réservés Linux, qui fonctionnent bien sous Windows.</li>
  <li>Linux impose des contrôles plus stricts sur l'accès à la mémoire. Un accès invalide à des pointeurs ou à des indices de tableau qui fonctionne sous Windows peut échouer sur le système d'évaluation.</li>
  <li>Des fuites de mémoire graves peuvent déclencher des modules de protection système pour terminer votre processus. Par conséquent, toute mémoire allouée avec malloc (ou calloc, realloc, new) doit être complètement libérée avec free (ou delete).</li>
  <li>Bien sûr, les données peuvent vraiment être fausses. Cependant, si plusieurs personnes ont réussi le problème, il vaut mieux ne pas soupçonner les données. Sinon, signalez-le immédiatement à nous !</li>
</ul>
";

$q7 = $oj_name . " Guide d'utilisation du blog";
$a7 = $oj_name . " utilise Markdown pour son blog. Pour des tutoriels spécifiques sur Markdown, recherchez en ligne. Les commentaires ne supportent pas HTML mais peuvent utiliser des formules mathématiques.";

$q8 = "Comment tester les problèmes interactifs localement";
$a8 = "
<p>(Il semble que beaucoup de gens ne soient pas familiers avec la compilation de plusieurs fichiers sources ensemble. Voici un guide de UOJ pour référence.)</p>
<p>Les problèmes interactifs fournissent généralement un fichier d'en-tête à inclure et un fichier source appelé grader.</p>
<p>Pour C++ : <code>g++ -o code grader.cpp code.cpp</code></p>
<p>Pour C : <code>gcc -o code grader.c code.c</code></p>
<p>Si vous êtes un novice en informatique, ne vous inquiétez pas ! Vous pouvez simplement coller le contenu du fichier grader après votre instruction include dans votre code.</p>
<p>Pour Pascal : Généralement, un grader est fourni. Vous devez écrire une unité Pascal. Le grader utilisera votre unité. Donc, nommez votre fichier source comme le nom de l'unité + <code>.pas</code>, puis :</p>
<p>Pour Pascal : <code>fpc grader.pas</code></p>
<p>C'est tout.</p>
";

$q9 = "Informations de contact";
$a9 = "Si vous voulez proposer des problèmes, organiser des concours, signaler des bugs ou avoir des suggestions pour le site, vous pouvez nous contacter par les méthodes suivantes :
<ul>
  <li>Signalez un problème au dépôt GitHub officiel : https://github.com/Andrew82106/UOJ4PPSUC</li>
  <li>Rejoignez Cyber SWAT et discutez de vos idées avec le responsable actuel du Département des Algorithmes</li>
</ul>
";

return [
    'q1' => 'Qu\'est-ce que ' . $oj_name . '?',
    'a1' => $oj_name . ' est une plateforme pour les étudiants de PPSUC afin de développer leurs compétences en programmation, développée et maintenue par PPSUC Cyber SWAT. ' . $oj_name . ' rassemble des problèmes de programmation en Python, C/C++ et Java, et organise des concours de programmation. Tout le monde est invité à participer.',
    'q4' => 'Comment télécharger une photo de profil après l\'inscription',
    'a4' => $oj_name . ' ne fournit pas de service de stockage de photos de profil. Cependant, comme UOJ, ' . $oj_name . ' supporte Gravatar.',
    'q3' => 'Environnement d\'évaluation de ' . $oj_name . '?',
    'a3' => $a3,
    'q2' => 'Significations des différents statuts d\'évaluation ?',
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
    'a9' => $a9,
];