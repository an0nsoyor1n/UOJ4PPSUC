<?php

$oj_name = UOJConfig::$data['profile']['oj-name'];

$a3 = "
  <p>O ambiente de avaliação padrão é o Ubuntu Linux 20.04 LTS x64.</p>
  <p>Compilador C – gcc 9.3.0, comando de compilação: <code>gcc code.c -o code -lm -O2 -DONLINE_JUDGE</code>.</p>
  <p>Compilador C++ – g++ 9.3.0, comando de compilação: <code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>. Se C++11 for selecionado, adicione <code>-std=c++11</code> ao comando de compilação.</p>
  <p>Versão JDK Java8 – openjdk 1.8.0_275, comando de compilação: <code>javac code.java</code>.</p>
  <p>Versão JDK Java11 – openjdk 11.0.9, comando de compilação: <code>javac code.java</code>.</p>
  <p>Compilador Pascal – fpc 3.0.4, comando de compilação: <code>fpc code.pas -O2</code>.</p>
  <p>Python é compilado em códigos de byte otimizados (<samp>.pyo</samp>). As versões suportadas do Python são Python 2.7 e 3.8.</p>
";

$a4 = "
<ul>
  <li>Aceito: Resultado correto. Parabéns por resolver essa tarefa!</li>
  <li>Resposta Incorreta: Resultado incorreto. Passar os casos de teste não significa necessariamente um resultado correto; algo pode ter sido deixado de lado.</li>
  <li>Erro de Execução: Erro de tempo de execução. Problemas como acesso a memória inválida, ultrapassar o limite do array, deslocamentos de ponteiros ou chamadas a funções do sistema desabilitadas podem causar isso. Clique para detalhes no relatório de avaliação.</li>
  <li>Tempo Limite Excedido: Tempo limite excedido. Verifique se há um loop infinito no seu programa ou se há uma solução mais rápida possível.</li>
  <li>Memória Limite Excedido: Limite de memória excedido. Os dados podem precisar ser compactados ou seus arrays são muito grandes. Verifique por vazamentos de memória.</li>
  <li>Saída Limite Excedido: Limite de saída excedido. Sua saída é muito maior do que a resposta correta.</li>
  <li>Chamadas de Sistema Perigosas: Você usou algumas funções do sistema (perigosas)? Os participantes em CTF devem se aproximar da equipe SWAT de cibersegurança.</li>
  <li>Avaliação Falhou: Pode haver problemas com a máquina de avaliação ou o servidor.</li>
  <li>Sem Comentários: Sem detalhes. Se a máquina de avaliação não diz nada sobre o seu programa, você pode nos reportar a situação ou tentar novamente.</li>
</ul>
";

$q5 = "
Por que a recursão até 10<sup>7</sup> níveis não causa um desbordamento de pilha?
";

$a5 = "<p>Exceto em casos especiais, o tamanho da pilha durante a avaliação no " . $oj_name . " é o limite de memória da tarefa. Para mais informações, você pode entrar em contato com a comunidade de desenvolvedores do UOJ por e-mail.</p>";

$q6 = "Recebi AC localmente/ em outro OJ, mas não no " . $oj_name . ". O que devo fazer?";
$a6 = "
<p>Para esse problema, as possíveis causas são as seguintes:</p>
<ul>
  <li>No Linux, o caractere de nova linha é '\n', enquanto que no Windows é '\r\n' (um caractere extra). Os dados gerados no Windows podem não funcionar em um ambiente de avaliação Linux. Isso ocorre frequentemente na entrada de strings.</li>
  <li>O ambiente de avaliação se baseia no Linux e pode causar erros de tempo de execução se palavras-chave do Linux que funcionam bem no Windows forem usadas.</li>
  <li>O Linux impõe restrições mais rigorosas para o acesso à memória. Acessos inválidos a ponteiros ou índices de array que funcionam no Windows podem não funcionar no ambiente de avaliação.</li>
  <li>Graves vazamentos de memória podem fazer com que o módulo de proteção do sistema encerre seu processo. Portanto, toda a memória alocada com malloc (ou calloc, realloc, new) deve ser liberada completamente com free (ou delete).</li>
  <li>Claro, os dados podem estar realmente errados. No entanto, você não deve questionar os dados se muitas pessoas resolveram a tarefa com sucesso. Caso contrário, informe-nos imediatamente.</li>
</ul>
";

$q7 = "Instruções para usar o blog do " . $oj_name;
$a7 = $oj_name . " usa Markdown para seu blog. Para instruções específicas sobre Markdown, procure na internet. Os comentários não suportam HTML, mas podem usar fórmulas matemáticas.";

$q8 = "Como realizar testes locais para tarefas interativas";
$a8 = "
<p>(Parece que muitas pessoas não estão familiarizadas com a compilação de múltiplos arquivos de código juntos. Aqui está um guia do UOJ como referência.)</p>
<p>As tarefas interativas geralmente fornecem um arquivo de cabeçalho para incluir e um arquivo de código chamado grader.</p>
<p>Para C++ : <code>g++ -o code grader.cpp code.cpp</code></p>
<p>Para C : <code>gcc -o code grader.c code.c</code></p>
<p>Se você é iniciante em programação, não se preocupe! Basta inserir o conteúdo do arquivo grader após sua declaração de inclusão em seu código.</p>
<p>Para Pascal : Geralmente é fornecido um grader. Você deve escrever uma unidade de Pascal. O grader usará sua unidade. Portanto, nomeie seu arquivo fonte como nome_unidade + <code>.pas</code>, depois:</p>
<p>Para Pascal : <code>fpc grader.pas</code></p>
<p>Isso é tudo.</p>
";

$q9 = "Informações de contato";
$a9 = "Se você deseja sugerir problemas, organizar competições, reportar bugs ou propor melhorias para o site, você pode nos contatar das seguintes maneiras:
<ul>
  <li>Reporte um problema no repositório oficial do GitHub: https://github.com/Andrew82106/UOJ4PPSUC</li>
  <li>Entre para a Cyber SWAT e discuta suas ideias com o líder atual da equipe de algoritmos</li>
</ul>
";

return [
    'q1' => 'O que é ' . $oj_name . '?',
    'a1' => $oj_name . ' é uma plataforma para que os estudantes do PPSUC desenvolvam suas habilidades de programação, desenvolvida e mantida pela PPSUC Cyber SWAT. ' . $oj_name . ' coleta problemas de programação em Python, C/C++ e Java e organiza competições de programação. Todos são convidados a participar.',
    'q4' => 'Como enviar uma foto de perfil após se registrar',
    'a4' => $oj_name . ' não oferece um serviço para armazenar fotos de perfil. No entanto, ' . $oj_name . ' suporta Gravatar, semelhante ao UOJ.',
    'q3' => 'Ambiente de avaliação do ' . $oj_name . '?',
    'a3' => $a3,
    'q2' => 'Significados dos diferentes estados de avaliação',
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