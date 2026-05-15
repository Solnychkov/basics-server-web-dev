<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .calc { max-width: 340px; }
        #display {
            width: 100%; padding: 12px; font-size: 1.4rem;
            text-align: right; border: 1px solid #ccc;
            border-radius: 4px; margin-bottom: 10px;
            font-family: monospace; box-sizing: border-box;
        }
        .keys { display: grid; grid-template-columns: repeat(4,1fr); gap: 6px; }
        .keys button {
            padding: 14px; font-size: 1rem; border: none;
            border-radius: 4px; cursor: pointer; background: #e8edf5;
        }
        .keys button:hover { background: #d0d8ea; }
        .keys .op  { background: #c8d8f0; }
        .keys .eq  { background: #1a3c6e; color: #fff; }
        .keys .clr { background: #c0392b; color: #fff; }
        .result-box { margin-top: 16px; padding: 14px; background: #f0f4ff; border: 1px solid #c0cfe8; border-radius: 4px; }
        .answer { font-size: 1.4rem; font-weight: bold; color: #1a3c6e; }
        .error  { color: #c0392b; font-weight: bold; }
    </style>
</head>
<body>
<header><h1>Калькулятор</h1></header>
<main>
    <h2>Вариант 17</h2>
    <div class="calc">
        <input type="text" id="display" readonly placeholder="0">

        <form method="POST" action="calc.php" id="f">
            <input type="hidden" name="expr" id="expr">
            <div class="keys">
                <button type="button" onclick="app('7')">7</button>
                <button type="button" onclick="app('8')">8</button>
                <button type="button" onclick="app('9')">9</button>
                <button type="button" class="op" onclick="app('/')">/</button>

                <button type="button" onclick="app('4')">4</button>
                <button type="button" onclick="app('5')">5</button>
                <button type="button" onclick="app('6')">6</button>
                <button type="button" class="op" onclick="app('*')">×</button>

                <button type="button" onclick="app('1')">1</button>
                <button type="button" onclick="app('2')">2</button>
                <button type="button" onclick="app('3')">3</button>
                <button type="button" class="op" onclick="app('-')">−</button>

                <button type="button" onclick="app('0')">0</button>
                <button type="button" onclick="app('.')">.</button>
                <button type="button" class="op" onclick="app('+')">+</button>
                <button type="button" class="op" onclick="app('(')">(</button>

                <button type="button" class="op" onclick="app(')')">)</button>
                <button type="button" class="clr" onclick="clr()">C</button>
                <button type="submit" class="eq" style="grid-column:span 2" onclick="go()">=</button>
            </div>
        </form>

        <?php if (isset($_GET['result'])): ?>
        <div class="result-box">
            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?= htmlspecialchars($_GET['result']) ?></p>
            <?php else: ?>
                <p><?= htmlspecialchars($_GET['expr']) ?></p>
                <p class="answer">= <?= htmlspecialchars($_GET['result']) ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</main>
<footer><p>Группа 251-321 — Солнышков И.Е.</p></footer>

<script>
var d = document.getElementById('display');
function app(v) { d.value += v; }
function clr()  { d.value = ''; }
function go()   { document.getElementById('expr').value = d.value; }
</script>
</body>
</html>
