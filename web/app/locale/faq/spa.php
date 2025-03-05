<?php

$oj_name = UOJConfig::$data['profile']['oj-name'];

$a3 = "
  <p>El entorno de evaluación estándar es Ubuntu Linux 20.04 LTS x64.</p>
  <p>Compilador C – gcc 9.3.0, comando de compilación: <code>gcc code.c -o code -lm -O2 -DONLINE_JUDGE</code>.</p>
  <p>Compilador C++ – g++ 9.3.0, comando de compilación: <code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>. Si se selecciona C++11, agregue <code>-std=c++11</code> al comando de compilación.</p>
  <p>Versión JDK Java8 – openjdk 1.8.0_275, comando de compilación: <code>javac code.java</code>.</p>
  <p>Versión JDK Java11 – openjdk 11.0.9, comando de compilación: <code>javac code.java</code>.</p>
  <p>Compilador Pascal – fpc 3.0.4, comando de compilación: <code>fpc code.pas -O2</code>.</p>
  <p>Python se compila en códigos de bytes optimizados (<samp>.pyo</samp>). Las versiones soportadas de Python son Python 2.7 y 3.8.</p>
";

$a4 = "
<ul>
  <li>Aceptado: Resultado correcto. ¡Felicidades por resolver esta tarea!</li>
  <li>Respuesta Incorrecta: Resultado incorrecto. Pasar los casos de prueba no significa necesariamente un resultado correcto; algo podría haber sido pasado por alto.</li>
  <li>Error de Ejecución: Error de tiempo de ejecución. Problemas como acceso a memoria inválido, superar el rango del array, desplazamientos de punteros o llamadas a funciones del sistema desactivadas pueden causar esto. Haga clic para detalles en el informe de evaluación.</li>
  <li>Límite de Tiempo Excedido: Límite de tiempo excedido. Verifique si hay un bucle infinito en su programa o si hay una solución más rápida posible.</li>
  <li>Límite de Memoria Excedido: Límite de memoria excedido. Los datos podrían necesitar ser comprimidos o sus arrays son demasiado grandes. Verifique por fugas de memoria.</li>
  <li>Límite de Salida Excedido: Límite de salida excedido. Su salida es mucho más larga que la respuesta correcta.</li>
  <li>Llamadas al Sistema Peligrosas: Usted ha usado algunas funciones del sistema (peligrosas)? Los participantes en CTF deben acercarse al equipo de SWAT de ciberseguridad.</li>
  <li>Evaluación Fallida: Puede haber problemas con la máquina de evaluación o el servidor.</li>
  <li>Sin Comentarios: Sin detalles. Si la máquina de evaluación no dice nada sobre su programa, puede reportarnos la situación o intentarlo nuevamente.</li>
</ul>
";

$q5 = "
¿Por qué la recursión hasta 10<sup>7</sup> niveles no causa un desbordamiento de pila?
";

$a5 = "<p>Excepto en casos especiales, el tamaño de la pila durante la evaluación en " . $oj_name . " es el límite de memoria de la tarea. Para más información, puede contactar a la comunidad de desarrolladores de UOJ por correo electrónico.</p>";

$q6 = "Recibí AC localmente/ en otro OJ, pero no en " . $oj_name . ". ¿Qué debo hacer?";
$a6 = "
<p>Para este problema, las posibles causas son las siguientes:</p>
<ul>
  <li>En Linux, el carácter de nueva línea es '\n', mientras que en Windows es '\r\n' (un carácter adicional). Los datos generados en Windows pueden no funcionar en un entorno de evaluación Linux. Esto ocurre frecuentemente en la entrada de cadenas.</li>
  <li>El entorno de evaluación se basa en Linux y puede causar errores de tiempo de ejecución si se usan palabras reservadas de Linux que funcionan bien en Windows.</li>
  <li>Linux impone restricciones más estrictas para el acceso a la memoria. Accesos inválidos a punteros o índices de array que funcionan en Windows pueden no funcionar en el entorno de evaluación.</li>
  <li>Las graves fugas de memoria pueden hacer que el módulo de protección del sistema termine su proceso. Por lo tanto, toda la memoria asignada con malloc (o calloc, realloc, new) debe ser liberada completamente con free (o delete).</li>
  <li>Por supuesto, los datos pueden estar realmente mal. Sin embargo, no debe cuestionar los datos si muchas personas han resuelto exitosamente la tarea. De lo contrario, infórmanos de inmediato.</li>
</ul>
";

$q7 = "Instrucciones para usar el blog de " . $oj_name;
$a7 = $oj_name . " utiliza Markdown para su blog. Para instrucciones específicas sobre Markdown, busque en Internet. Los comentarios no admiten HTML, pero sí pueden usar fórmulas matemáticas.";

$q8 = "Cómo realizar pruebas locales para tareas interactivas";
$a8 = "
<p>(Parece que mucha gente no está familiarizada con la compilación de múltiples archivos de código juntos. Aquí hay una guía de UOJ como referencia.)</p>
<p>Las tareas interactivas suelen proporcionar un archivo de encabezado para incluir y un archivo de código llamado grader.</p>
<p>Para C++ : <code>g++ -o code grader.cpp code.cpp</code></p>
<p>Para C : <code>gcc -o code grader.c code.c</code></p>
<p>Si eres principiante en programación, ¡no te preocupes! Simplemente puedes insertar el contenido del archivo grader después de tu declaración de inclusión en tu código.</p>
<p>Para Pascal : Generalmente se proporciona un grader. Debes escribir una unidad de Pascal. El grader usará tu unidad. Por lo tanto, nombra tu archivo fuente como nombre_unidad + <code>.pas</code>, luego:</p>
<p>Para Pascal : <code>fpc grader.pas</code></p>
<p>Eso es todo.</p>
";

$q9 = "Información de contacto";
$a9 = "Si desea sugerir problemas, organizar competencias, reportar bugs o proponer mejoras para el sitio web, puede contactarnos de las siguientes formas:
<ul>
  <li>Reporte un problema en el repositorio oficial de GitHub: https://github.com/Andrew82106/UOJ4PPSUC</li>
  <li>Únase a Cyber SWAT y discuta sus ideas con el líder actual del equipo de algoritmos</li>
</ul>
";

return [
    'q1' => '¿Qué es ' . $oj_name . '?',
    'a1' => $oj_name . ' es una plataforma para que los estudiantes de PPSUC desarrollen sus habilidades de programación, desarrollada y mantenida por PPSUC Cyber SWAT. ' . $oj_name . ' recopila problemas de programación en Python, C/C++ y Java y organiza competencias de programación. Todos están invitados a participar.',
    'q4' => 'Cómo subir una foto de perfil después de registrarse',
    'a4' => $oj_name . ' no ofrece un servicio para almacenar fotos de perfil. Sin embargo, ' . $oj_name . ' admite Gravatar, similar a UOJ.',
    'q3' => 'Entorno de evaluación de ' . $oj_name . '?',
    'a3' => $a3,
    'q2' => 'Significados de los diferentes estados de evaluación',
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