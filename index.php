<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'submit.php'; ?>

    <div class="container">
        <?php
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            echo '<div class="errors">';
            foreach ($_SESSION['errors'] as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        } elseif (isset($_COOKIE['name'])) {
            echo '<div class="success">';
            echo '<p>Форма успешно отправлена</p>';
            echo '</div>';
        }
        ?>

        <h1>Суперспособности</h1>
        <form action="submit.php" method="POST" id="form">
            <!-- Добавьте остальные поля формы с сохранением значений из cookie -->
            <label for="name">Имя:</label>
            <?= showError('name') ?>
            <input type="text" name="name" id="name" <?php if ($error) {echo 'class="errorsi"';} ?> value="<?= getFieldValue('name') ?>">

            <label for="email">E-mail:</label>
            <?= showError('email') ?>
            <input type="text" name="email" id="email" value="<?= getFieldValue('email') ?>">

           <label for="birth_year">Год рождения:</label>
           <?= showError('birth_year') ?>
            <select name="birth_year" id="birth_year" >
                <option value="<?= getSelected('birth_year', "") ?>">Выберите год</option>
                <!-- Заполните значения для годов -->
            </select>
            <label>Пол:</label>
            <?= showError('gender') ?>
            <label><input type="radio" checked="checked" name="gender" value="male" <?= getChecked('gender', 'male') ?>> Мужской</label>
            <label><input type="radio" name="gender" value="female" <?= getChecked('gender', 'female') ?>> Женский</label>

            <label>Количество конечностей:</label>
            <?= showError('limbs') ?>
            <label><input type="radio" checked="checked" name="limbs" id="limbs" value="2" <?= getChecked('limbs', '2') ?>> 2</label>
            <label><input type="radio" name="limbs" id="limbs" value="4" <?= getChecked('limbs', '4') ?>> 4</label>
            <label><input type="radio" name="limbs" id="limbs" value="6" <?= getChecked('limbs', '6') ?>> 6</label>
            <label for="abilities">Сверхспособности:</label>
            <select name="abilities[]" id="abilities" multiple>
                 <option value="immortality" <?= getSelected('abilities', 'immortality') ?>>Бессмертие</option>
                <option value="wall_pass" <?= getSelected('abilities', 'wall_pass') ?>>Прохождение сквозь стены</option>
                <option value="levitation" <?= getSelected('abilities', 'levitation') ?>>Левитация</option>
                 <option value="Flying" <?= getSelected('abilities', 'Flying') ?>>Полет</option>
                 <option value="Teleportation" <?= getSelected('abilities', 'Teleportation') ?>>Телепортация</option>
               </select>
            <?php if (!empty($messages['abilities'])) {print($messages['abilities']);}?>

            <label for="bio">Биография:</label>
            <textarea name="bio" id="bio"><?= getFieldValue('bio') ?></textarea>

            <label>
                <input type="checkbox" name="contract" value="accepted" <?= getChecked('contract', 'accepted') ?>> С контрактом ознакомлен
            </label>

            <input type="submit" value="Отправить">
        </form>
          <script>
              const select = document.getElementById('birth_year');
              const currentYear = new Date().getFullYear();
              for (let i = currentYear; i >= currentYear - 100; i--) {
                  const option = document.createElement('option');
                  option.value = i;
                  option.text = i;
                  if(i == <?= isset($_COOKIE['birth_year']) ? $_COOKIE['birth_year'] : '""' ?>) 
                     {
                     option.selected = true; // выбираем этот элемент, если год сохранен в куке
                     }
                  select.add(option);
}

    </script>
    </div>
</body>
</html>
