<?php
function getSubmenu($sort = 'id') {
    $html = '<aside><div class="submenu">';

    $items = [
        'id'        => 'По порядку добавления',
        'lastname'  => 'По фамилии',
        'birthdate' => 'По дате рождения',
    ];

    foreach ($items as $key => $label) {
        $class = ($sort === $key) ? 'select' : '';
        $html .= '<a href="index.php?action=view&sort=' . $key . '" class="' . $class . '">' . $label . '</a>';
    }

    $html .= '</div></aside>';
    return $html;
}
