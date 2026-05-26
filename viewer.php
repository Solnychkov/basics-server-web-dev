<?php
function getViewer($mysqli, $sort = 'id', $page = 1) {
    $perPage = 10;

    $allowedSort = ['id', 'lastname', 'birthdate'];
    if (!in_array($sort, $allowedSort)) $sort = 'id';

    $res = mysqli_query($mysqli, 'SELECT COUNT(*) FROM contacts');
    $row = mysqli_fetch_row($res);
    $total = $row[0];
    mysqli_free_result($res);

    $totalPages = ceil($total / $perPage);
    if ($page < 1) $page = 1;
    if ($totalPages > 0 && $page > $totalPages) $page = $totalPages;

    $offset = ($page - 1) * $perPage;

    $res = mysqli_query($mysqli, "SELECT * FROM contacts ORDER BY $sort ASC LIMIT $perPage OFFSET $offset");

    $html = '';

    if ($total == 0) {
        $html .= '<p>Записей в базе данных нет.</p>';
        return $html;
    }

    $html .= '<table>';
    $html .= '<tr>
        <th>№</th><th>Фамилия</th><th>Имя</th><th>Отчество</th>
        <th>Пол</th><th>Дата рождения</th><th>Телефон</th>
        <th>Адрес</th><th>E-mail</th><th>Комментарий</th>
    </tr>';

    $i = $offset + 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr>';
        $html .= '<td>' . $i . '</td>';
        $html .= '<td>' . htmlspecialchars($row['lastname'])   . '</td>';
        $html .= '<td>' . htmlspecialchars($row['firstname'])  . '</td>';
        $html .= '<td>' . htmlspecialchars($row['patronymic']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['gender'])     . '</td>';
        $html .= '<td>' . htmlspecialchars($row['birthdate'])  . '</td>';
        $html .= '<td>' . htmlspecialchars($row['phone'])      . '</td>';
        $html .= '<td>' . htmlspecialchars($row['address'])    . '</td>';
        $html .= '<td>' . htmlspecialchars($row['email'])      . '</td>';
        $html .= '<td>' . htmlspecialchars($row['comment'])    . '</td>';
        $html .= '</tr>';
        $i++;
    }
    $html .= '</table>';
    mysqli_free_result($res);

    if ($totalPages > 1) {
        $html .= '<div class="submenu">';
        for ($p = 1; $p <= $totalPages; $p++) {
            $class = ($p == $page) ? 'select' : '';
            $html .= '<a href="index.php?action=view&sort=' . $sort . '&page=' . $p . '" class="' . $class . '">' . $p . '</a>';
        }
        $html .= '</div>';
    }

    return $html;
}
?>
