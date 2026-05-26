<?php
$message = '';
$button  = 'Добавить';
$row     = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {

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
        $message = '<p class="error">Ошибка: запись не добавлена (фамилия и имя обязательны)</p>';
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

        $query = "INSERT INTO contacts (lastname, firstname, patronymic, gender, birthdate, phone, address, email, comment)
                  VALUES ('$lastname', '$firstname', '$patronymic', '$gender', $birthdate, '$phone', '$address', '$email', '$comment')";

        $result = mysqli_query($mysqli, $query);

        if ($result) {
            $message = '<p class="success">Запись добавлена</p>';
        } else {
            $message = '<p class="error">Ошибка: запись не добавлена (' . mysqli_error($mysqli) . ')</p>';
        }
    }
}
?>

<?= $message ?>

<form name="form_add" method="post">
    <div class="column">
        <div class="add">
            <label>Фамилия</label>
            <input type="text" name="surname" placeholder="Фамилия" value="<?= isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : '' ?>">
        </div>
        <div class="add">
            <label>Имя</label>
            <input type="text" name="name" placeholder="Имя" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
        </div>
        <div class="add">
            <label>Отчество</label>
            <input type="text" name="lastname" placeholder="Отчество" value="<?= isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '' ?>">
        </div>
        <div class="add">
            <label>Пол</label>
            <select name="gender">
                <option value="мужской" <?= (isset($_POST['gender']) && $_POST['gender']==='мужской') ? 'selected' : '' ?>>мужской</option>
                <option value="женский" <?= (isset($_POST['gender']) && $_POST['gender']==='женский') ? 'selected' : '' ?>>женский</option>
            </select>
        </div>
        <div class="add">
            <label>Дата рождения</label>
            <input type="date" name="date" value="<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '' ?>">
        </div>
        <div class="add">
            <label>Телефон</label>
            <input type="text" name="phone" placeholder="Телефон" value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
        </div>
        <div class="add">
            <label>Адрес</label>
            <input type="text" name="location" placeholder="Адрес" value="<?= isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '' ?>">
        </div>
        <div class="add">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        </div>
        <div class="add">
            <label>Комментарий</label>
            <textarea name="comment" placeholder="Краткий комментарий"><?= isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '' ?></textarea>
        </div>
        <button type="submit" name="button" value="<?= $button ?>" class="form-btn"><?= $button ?></button>
    </div>
</form>
