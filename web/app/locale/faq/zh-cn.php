<?php

$oj_name = UOJConfig::$data['profile']['oj-name'];

$a3 = "
  <p>默认的测评环境是 Ubuntu Linux 20.04 LTS x64。</p>
  <p>C的编译器是 gcc 9.3.0，编译命令：<code>gcc code.c -o code -lm -O2 -DONLINE_JUDGE</code>。</p>
  <p>C++的编译器是 g++ 9.3.0，编译命令：<code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>。如果选择C++11会在编译命令后面添加<code>-std=c++11</code>。</p>
  <p>Java8的JDK版本是 openjdk 1.8.0_275，编译命令：<code>javac code.java</code>。</p>
  <p>Java11的JDK版本是 openjdk 11.0.9，编译命令：<code>javac code.java</code>。</p>
  <p>Pascal的编译器是 fpc 3.0.4，编译命令：<code>fpc code.pas -O2</code>。</p>
  <p>Python会先编译为优化过的字节码<samp>.pyo</samp>文件。支持的Python版本分别为Python 2.7和3.8。</p>
";

$a4 = "
<ul>
	<li>Accepted: 答案正确。恭喜你通过了这道题。</li>
	<li>Wrong Answer: 答案错误。仅仅通过样例数据的测试并不一定是正确答案，一定还有你没想到的地方。</li>
	<li>Runtime Error: 运行时错误。像非法的内存访问，数组越界，指针漂移，调用禁用的系统函数都可能出现这类问题，请点击评测详情获得输出。</li>
	<li>Time Limit Exceeded: 时间超限。请检查程序是否有死循环，或者应该有更快的计算方法。</li>
	<li>Memory Limit Exceeded: 内存超限。数据可能需要压缩，或者你数组开太大了，请检查是否有内存泄露。</li>
	<li>Output Limit Exceeded: 输出超限。你的输出居然比正确答案长了很多！</li>
	<li>Dangerous Syscalls: 危险系统调用，你是不是带了文件，或者使用了某些有意思的（危险的）system函数？CTF选手请右转Cyber SWAT网络攻防部门。</li>
	<li>Judgement Failed: 评测失败。可能是评测机或者服务器出了点问题。</li>
	<li>No Comment: 没有详情。评测机对您的程序无话可说，那么可以向我们报告情况，或者再提交一次</li>
</ul>
";

$q5 = "
递归 10<sup>7</sup> 层怎么没爆栈啊
";

$a5 = "<p>除非是特殊情况，" . $oj_name . "测评程序时的栈大小与该题的空间限制相等，至于其原因，可以发邮件向UOJ开发社区了解详情。</p>";

$q6 = "我在本地/某某OJ上AC了，但在" . $oj_name . "却过不了...这咋办？";

$a6 = "
<p>对于这类问题，在这里简单列一下可能原因：</p>
	<ul>
		<li>Linux中换行符是'\n'而windows中是'\r\n'（多一个字符）。有些数据在Windows下生成，而这里的评测环境为Linux系统。这种情况在字符串输入中非常常见。</li>
		<li>评测系统建立在Linux下，可能由于使用了Linux的保留字而出现CE，但在Windows下正常。</li>
		<li>Linux对内存的访问控制更为严格，因此在Windows上可能正常运行的无效指针或数组下标访问越界，在评测系统上无法运行。</li>
		<li>严重的内存泄露的问题很可能会引起系统的保护模块杀死你的进程。因此，凡是使用malloc(或calloc,realloc,new)分配而得的内存空间，请使用free(或delete)完全释放。</li>
		<li>当然数据可能真的有问题。但是如果不止一个人通过了这道题，那最好不要怀疑是数据的锅。反之，可以立即联系我们上报！</li>
	</ul>
";

$q7 = $oj_name . "博客使用指南";
$a7 = $oj_name ."博客使用的是Markdown,Markdown的具体教程请自行百度。评论区不可以用任何HTML,但是可以使用数学公式";

$q8 = "交互式类型的题怎么本地测试";
$a8="
<p>（好像大家对多个源文件一起编译还不太熟悉，这里把UOJ的教程搬过来给大家看看）</p><p>交互式的题一般给了一个头文件要你include进来，以及一个实现接口的源文件grader。</p>
	<p>对于C++：<code>g++ -o code grader.cpp code.cpp</code></p>
	<p>对于C语言：<code>gcc -o code grader.c code.c</code></p>
	<p>如果你是悲催的电脑盲，实在不会折腾没关系！你可以把grader的文件内容完整地粘贴到你的code的include语句之后，就可以了！</p>
	<p>什么你是萌萌哒Pascal选手？一般来说都会给个grader，你需要写一个Pascal单元。这个grader会使用你的单元。所以你只需要把源文件取名为单元名 + <code>.pas</code>，然后：</p>
	<p>对于Pascal语言：<code>fpc grader.pas</code></p>
	<p>即可</p>
";

$q9 = "联系方式";
$a9 = "如果你想出题、想办比赛、发现了BUG或者对网站有什么建议，可以通过下面的方式联系我们：
<ul>
	<li>向官方Github仓库提issue：https://github.com/Andrew82106/UOJ4PPSUC</li>
	<li>加入Cyber SWAT，并且向在任的算法部门负责人提出你的想法</li>
</ul>
";
return [
	'q1' => '什么是' . $oj_name . '?',
	'a1' => $oj_name . '是面向PPSUC校内学生进行计算机编程能力训练的平台，由PPSUC Cyber SWAT开发并维护。' . $oj_name . '上会搜集Python、C/C++、Java的编程训练题目，并且会举办编程竞赛，欢迎大家的参与。',
	'q4' => '注册后怎么上传头像',
	'a4' => $oj_name . '不提供头像存储服务。但是和UOJ一样，' . $oj_name .'支持Gravatar',
	'q3' => $oj_name .'的测评环境？',
	'a3' => $a3,
	'q2' => '各种评测状态的含义？',
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
