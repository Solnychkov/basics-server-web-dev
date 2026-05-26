<?php
$message = '';

if (isset($_GET['del']) && is_numeric($_GET['del'])) {
    $delId   = (int)$_GET['del'];
    $resName = mysqli_query($mysqli, "SELECT lastname FROM contacts WHERE id=$delId");
    $nameRow = mysqli_fetch_assoc($resName);
    mysqli_free_result($resName);

    if ($nameRow) {
        $fam = $nameRow['lastname'];
        if (mysqli_query($mysqli, "DELETE FROM contacts WHERE id=$delId")) {
            $message = '<p class="success">Запись с фамилией ' . htmlspecialchars($fam) . ' удалена</p>';
        } else {
            $message = '<p class="error">Ошибка при удалении: ' . mysqli_error($mysqli) . '</p>';
        }
    } else {
        $message = '<p class="error">Запись не найдена</p>';
    }
}

$res = mysqli_query($mysqli, 'SELECT id, lastname, firstname, patronymic FROM contacts ORDER BY lastname ASC, firstname ASC');
?>

<?= $message ?>

<div class="div-edit" style="width:auto; margin:0 auto;">
<?php
if (mysqli_num_rows($res) === 0) {
    echo '<p>Записей в базе данных нет.</p>';
} else {
    while ($row = mysqli_fetch_assoc($res)) {
        $initials  = mb_substr($row['firstname'],  0, 1, 'UTF-8') . '.';
        if ($row['patronymic']) {
            $initials .= mb_substr($row['patronymic'], 0, 1, 'UTF-8') . '.';
        }
        $text = htmlspecialchars($row['lastname'] . ' ' . $initials);
        echo '<div><a href="index.php?action=delete&del=' . $row['id'] . '">' . $text . '</a></div>';
    }
}
mysqli_free_result($res);
?>
</div>
