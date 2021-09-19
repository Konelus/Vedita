<?php require_once($_SERVER['DOCUMENT_ROOT']."/controller.php"); ?>

<!DOCTYPE html>

<html lang = 'ru'>
    <head>
        <title>Vedita</title>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/styles.css">
    </head>
    <body>
        <div>
            <table>
                <thead>
                    <tr>
                        <td class = 'center'>№</td>
                        <td class = 'center'>Название</td>
                        <td class = 'center'>Цена</td>
                        <td class = 'center'>Артикул</td>
                        <td class = 'center'>Количество</td>
                        <td class = 'center'>Дата</td>
                        <td class = 'center'>Скрыть</td>
                    </tr>
                </thead>
                <tbody>
                <?php if ($productsList != '') { $count = 0; foreach($productsList as $key => $value) { $count++; ?>
                    <tr>
                        <form method = "post">
                            <td class = 'center'><?= $count ?></td>
                            <?php foreach($value as $key2 => $value2) { ?>
                                <td>
                                    <?= $value2 ?>
                                    <?php if ($key2 == 'PRODUCT_QUANTITY') { ?>
                                    <input type = 'submit' value = '+' name = 'q_edit' class = 'btn-edit'>
                                    <input type = 'submit' value = '-' name = 'q_edit' class = 'btn-edit'>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <td class = 'center'>
                                <input type = 'submit' value = 'Скрыть' name = 'hid' class = 'btn-hid'>
                                <input type = 'hidden' value = '<?= $key ?>' name = 'id'>
                            </td>
                        </form>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>