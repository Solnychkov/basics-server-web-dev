<?php
if (!isset($_POST['expr']) || trim($_POST['expr']) === '') {
    redirect_error('Пустое выражение');
}

$raw = trim($_POST['expr']);

if (!preg_match('/^[0-9+\-*\/().]+$/', $raw)) {
    redirect_error('Недопустимые символы');
}

$tokens = tokenize($raw);
$pos = 0;
$result = parse_expr($tokens, $pos);

if ($pos < count($tokens)) {
    redirect_error('Синтаксическая ошибка');
}

if (is_nan($result) || is_infinite($result)) {
    redirect_error('Математическая ошибка');
}

$out = rtrim(rtrim(number_format($result, 10, '.', ''), '0'), '.');
header('Location: index.php?result=' . urlencode($out) . '&expr=' . urlencode($raw));
exit;

function tokenize($s) {
    $tokens = [];
    $i = 0;
    while ($i < strlen($s)) {
        if (ctype_digit($s[$i]) || $s[$i] === '.') {
            $n = '';
            while ($i < strlen($s) && (ctype_digit($s[$i]) || $s[$i] === '.')) $n .= $s[$i++];
            $tokens[] = ['n', (float)$n];
        } else {
            $tokens[] = ['o', $s[$i++]];
        }
    }
    return $tokens;
}

function parse_expr(&$t, &$p) {
    $v = parse_term($t, $p);
    while ($p < count($t) && $t[$p][0] === 'o' && in_array($t[$p][1], ['+','-'])) {
        $op = $t[$p++][1];
        $v = $op === '+' ? add($v, parse_term($t, $p)) : subtract($v, parse_term($t, $p));
    }
    return $v;
}

function parse_term(&$t, &$p) {
    $v = parse_unary($t, $p);
    while ($p < count($t) && $t[$p][0] === 'o' && in_array($t[$p][1], ['*','/'])) {
        $op = $t[$p++][1];
        $right = parse_unary($t, $p);
        $v = $op === '*' ? multiply($v, $right) : divide($v, $right);
    }
    return $v;
}

function parse_unary(&$t, &$p) {
    if ($p < count($t) && $t[$p] === ['o', '-']) { $p++; return multiply(-1, parse_primary($t, $p)); }
    return parse_primary($t, $p);
}

function parse_primary(&$t, &$p) {
    if (!isset($t[$p])) redirect_error('Ошибка в выражении');
    if ($t[$p][0] === 'n') return $t[$p++][1];
    if ($t[$p][1] === '(') {
        $p++;
        $v = parse_expr($t, $p);
        if (!isset($t[$p]) || $t[$p][1] !== ')') redirect_error('Нет закрывающей скобки');
        $p++;
        return $v;
    }
    redirect_error('Ошибка в выражении');
}

function add($a, $b)      { return $a + $b; }
function subtract($a, $b) { return $a - $b; }
function multiply($a, $b) { return $a * $b; }
function divide($a, $b)   { if ($b == 0) redirect_error('Деление на ноль'); return $a / $b; }

function redirect_error($msg) {
    header('Location: index.php?result=' . urlencode($msg) . '&error=1');
    exit;
}
