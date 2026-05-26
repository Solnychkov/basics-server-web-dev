<?php
$message = '';
$button  = 'Сохранить';


$resAll = mysqli_query($mysqli, 'SELECT id, lastname, firstname FROM contacts ORDER BY lastname ASC, firstname ASC');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $currentId = (int)$_GET['id'];
} else {
    $firstRow  = mysqli_fetch_assoc($resAll);
    $currentId = $firstRow ? (int)$firstRow['id'] : 0;
    mysqli_data_seek($resAll, 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
    $editId     = (int)$_POST['edit_id'];
    $lastname   = trim($_POST['surname']);
    $firstname  = trim($_POST['name']);
    $patronymic = trim($_POST['lastname']);
    $gender     = $_POST['gender'];
    $birthdate  = $_POST['date'];
    $phone      = trim($_POST['phone']);
    $address    = trim($_POST['location']);
    $email      = trim($_POST['email']);
    $comment    = trim($_POST['comment']);

    if ($lastname === '' || $firstname === '') {
        $message = '<p class="error">Ошибка: фамилия и имя обязательны</p>';
    } else {
        $lastname   = mysqli_real_escape_string($mysqli, $lastname);
        $firstname  = mysqli_real_escape_string($mysqli, $firstname);
        $patronymic = mysqli_real_escape_string($mysqli, $patronymic);
        $gender     = mysqli_real_escape_string($mysqli, $gender);
        $birthdate  = $birthdate ? "'" . mysqli_real_escape_string($mysqli, $birthdate) . "'" : 'NULL';
        $phone      = mysqli_real_escape_string($mysqli, $phone);
        $address    = mysqli_real_escape_string($mysqli, $address);
        $email      = mysqli_real_escape_string($mysqli, $email);
        $comment    = mysqli_real_escape_string($mysqli, $comment);

        $query = "UPDATE contacts SET
                    lastname='$lastname', firstname='$firstname', patronymic='$patronymic',
                    gender='$gender', birthdate=$birthdate, phone='$phone',
                    address='$address', email='$email', comment='$comment'
                  WHERE id=$editId";

        if (mysqli_query($mysqli, $query)) {
            $message   = '<p class="success">Запись обновлена</p>';
            $currentId = $editId;
        } else {
            $message = '<p class="error">Ошибка: ' . mysqli_error($mysqli) . '</p>';
        }
    }
}

$row = null;
if ($currentId > 0) {
    $res = mysqli_query($mysqli, "SELECT * FROM contacts WHERE id=$currentId");
    $row = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
}
?>

<?= $message ?>

<div style="display:flex; gap:20px; justify-content:center;">

    <div class="div-edit">
    <?php
    if (mysqli_num_rows($resAll) === 0) {
        echo '<p>Записей нет.</p>';
    } else {
        while ($r = mysqli_fetch_assoc($resAll)) {
            $class = ($r['id'] == $currentId) ? 'currentRow' : '';
            $name  = htmlspecialchars($r['lastname'] . ' ' . $r['firstname']);
            echo '<div class="' . $class . '"><a href="index.php?action=edit&id=' . $r['id'] . '">' . $name . '</a></div>';
        }
    }
    mysqli_free_result($resAll);
    ?>
    </div>

    <?php if ($row): ?>
    <form name="form_add" method="post">
        <input type="hidden" name="edit_id" value="<?= $row['id'] ?>">
        <div class="column">
            <div class="add">
                <label>Фамилия</label>
                <input type="text" name="surname" value="<?= htmlspecialchars($row['lastname']) ?>">
            </div>
            <div class="add">
                <label>Имя</label>
                <input type="text" name="name" value="<?= htmlspecialchars($row['firstname']) ?>">
            </div>
            <div class="add">
                <label>Отчество</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($row['patronymic']) ?>">
            </div>
            <div class="add">
                <label>Пол</label>
                <select name="gender">
                    <option value="мужской" <?= $row['gender']==='мужской' ? 'selected' : '' ?>>мужской</option>
                    <option value="женский" <?= $row['gender']==='женский' ? 'selected' : '' ?>>женский</option>
                </select>
            </div>
            <div class="add">
                <label>Дата рождения</label>
                <input type="date" name="date" value="<?= htmlspecialchars($row['birthdate']) ?>">
            </div>
            <div class="add">
                <label>Телефон</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>">
            </div>
            <div class="add">
                <label>Адрес</label>
                <input type="text" name="location" value="<?= htmlspecialchars($row['address']) ?>">
            </div>
            <div class="add">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>">
            </div>
            <div class="add">
                <label>Комментарий</label>
                <textarea name="comment"><?= htmlspecialchars($row['comment']) ?></textarea>
            </div>
            <button type="submit" name="button" value="<?= $button ?>" class="form-btn"><?= $button ?></button>
        </div>
    </form>
    <?php else: ?>
        <p>Записей в базе данных нет.</p>
    <?php endif; ?>

</div>
