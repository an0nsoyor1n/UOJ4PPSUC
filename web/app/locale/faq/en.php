<?php

$oj_name = UOJConfig::$data['profile']['oj-name'];

$a3 = "
  <p>The default evaluation environment is Ubuntu Linux 20.04 LTS x64.</p>
  <p>The C compiler is gcc 9.3.0, compilation command: <code>gcc code.c -o code -lm -O2 -DONLINE_JUDGE</code>.</p>
  <p>The C++ compiler is g++ 9.3.0, compilation command: <code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>. If C++11 is chosen, add <code>-std=c++11</code> to the compilation command.</p>
  <p>The Java8 JDK version is openjdk 1.8.0_275, compilation command: <code>javac code.java</code>.</p>
  <p>The Java11 JDK version is openjdk 11.0.9, compilation command: <code>javac code.java</code>.</p>
  <p>The Pascal compiler is fpc 3.0.4, compilation command: <code>fpc code.pas -O2</code>.</p>
  <p>Python compiles to optimized bytecode files (<samp>.pyo</samp>). Supported Python versions are Python 2.7 and 3.8.</p>
";

$a4 = "
<ul>
  <li>Accepted: The answer is correct. Congratulations on passing this problem.</li>
  <li>Wrong Answer: The answer is incorrect. Passing sample data does not necessarily mean the answer is correct; there may be something you haven't considered.</li>
  <li>Runtime Error: Runtime error. Issues like illegal memory access, array out-of-bounds, pointer drift, or calling disabled system functions can cause this. Click for details in the evaluation report.</li>
  <li>Time Limit Exceeded: Time limit exceeded. Check if your program has an infinite loop or if there is a faster solution.</li>
  <li>Memory Limit Exceeded: Memory limit exceeded. Data may need compression, or your arrays might be too large. Check for memory leaks.</li>
  <li>Output Limit Exceeded: Output limit exceeded. Your output is much longer than the correct answer!</li>
  <li>Dangerous Syscalls: Dangerous system calls. Did you include files or use certain (dangerous) system functions? CTF participants should contact the Cyber SWAT Network Defense Department.</li>
  <li>Judgement Failed: Evaluation failed. There might be issues with the evaluation machine or server.</li>
  <li>No Comment: No details. If the evaluation machine has nothing to say about your program, you can report the situation to us or submit again.</li>
</ul>
";

$q5 = "
Why doesn't recursion up to 10<sup>7</sup> layers cause a stack overflow?
";

$a5 = "<p>Unless it's a special case, the stack size during evaluation on " . $oj_name . " is equal to the memory limit of the problem. For more details, you can email the UOJ development community.</p>";

$q6 = "I got AC locally/on another OJ, but not on " . $oj_name . ". What should I do?";
$a6 = "
<p>For such problems, here are some possible reasons:</p>
<ul>
  <li>In Linux, the newline character is '\n', while in Windows it is '\r\n' (one extra character). Some data generated on Windows may not work in the Linux evaluation environment. This is very common in string input.</li>
  <li>The evaluation system is built on Linux, which may cause CE due to the use of Linux reserved words, which work fine on Windows.</li>
  <li>Linux enforces stricter memory access controls. Invalid pointer or array index access that works on Windows may fail on the evaluation system.</li>
  <li>Severe memory leaks can trigger system protection modules to terminate your process. Therefore, any memory allocated using malloc (or calloc, realloc, new) should be completely released using free (or delete).</li>
  <li>Of course, the data might really be wrong. However, if multiple people have passed the problem, it's best not to suspect the data. Otherwise, report it to us immediately!</li>
</ul>
";

$q7 = $oj_name . " Blog Usage Guide";
$a7 = $oj_name . " blog uses Markdown. For specific Markdown tutorials, please search online. Comments do not support HTML but can use mathematical formulas.";

$q8 = "How to test interactive problems locally";
$a8 = "
<p>(It seems many people are unfamiliar with compiling multiple source files together. Here’s a guide from UOJ for reference.)</p>
<p>Interactive problems usually provide a header file to include and a source file called grader.</p>
<p>For C++: <code>g++ -o code grader.cpp code.cpp</code></p>
<p>For C: <code>gcc -o code grader.c code.c</code></p>
<p>If you're a computer novice, don't worry! You can simply paste the content of the grader file after your include statement in your code.</p>
<p>For Pascal: Generally, a grader is provided. You need to write a Pascal unit. The grader will use your unit. So, name your source file as the unit name + <code>.pas</code>, and then:</p>
<p>For Pascal: <code>fpc grader.pas</code></p>
<p>That's it.</p>
";

$q9 = "Contact Information";
$a9 = "If you want to contribute problems, organize contests, report bugs, or have suggestions for the website, you can contact us through the following methods:
<ul>
  <li>Submit an issue to the official GitHub repository: https://github.com/Andrew82106/UOJ4PPSUC</li>
  <li>Join Cyber SWAT and discuss your ideas with the current head of the Algorithms Department</li>
</ul>
";

return [
    'q1' => 'What is ' . $oj_name . '?',
    'a1' => $oj_name . ' is a platform for PPSUC students to train their programming skills, developed and maintained by PPSUC Cyber SWAT. ' . $oj_name . ' collects programming practice problems in Python, C/C++, and Java, and hosts programming contests. Everyone is welcome to participate.',
    'q4' => 'How to upload an avatar after registration',
    'a4' => $oj_name . ' does not provide avatar storage services. However, like UOJ, ' . $oj_name . ' supports Gravatar.',
    'q3' => $oj_name . ' Evaluation Environment?',
    'a3' => $a3,
    'q2' => 'Meanings of Various Evaluation Statuses?',
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
?>
