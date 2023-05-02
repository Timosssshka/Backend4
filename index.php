<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
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

        <h1>Регистрация</h1>
        <form action="submit.php" method="POST" id="form">
            <!-- Добавьте остальные поля формы с сохранением значений из cookie -->
            <label for="name">Имя:</label>
            <?= showError('name') ?>
            <input type="text" name="name" id="name"  value="<?= getFieldValue('name') ?>">

            <label for="email">E-mail:</label>
            <?= showError('email') ?>
            <input type="text" name="email" id="email"  value="<?= getFieldValue('email') ?>">

<!--             <label for="birth_year">Год рождения:</label> -->
           
<!--             <input type="text" name="birth_year" id="birth_year" value="<?= getFieldValue('birth_year') ?>"> -->
            <label for="birth_year">Год рождения:</label> 
            <?= showError('birth_year') ?>
            <select name="birth_year" id="birth_year" >
                <option   value="<?= getSelected('birth_year',"") ?>">Выберите год</option>
                <!-- Заполните значения для годов -->
            </select>

            <label>Пол:</label>
            <?= showError('gender') ?>
            <label><input type="radio" name="gender" value="male" <?= getChecked('gender', 'male') ?>> Мужской</label>
            <label><input type="radio" name="gender" value="female" <?= getChecked('gender', 'female') ?>> Женский</label>

            <label>Количество конечностей:</label>
            <?= showError('limbs') ?>
            <label><input type="radio" name="limbs" value="2" <?=getSelected('limbs', '2')?>> 2</label>
           <label><input type="radio" name="limbs" value="4" <?php if ($values['limbs'] == 4) {print 'checked';} ?>/>
                4</label>
            <label><input type="radio" name="limbs" value="6" <?=getSelected('limbs', '6')?>> 6</label>

<label for="abilities">Сверхспособности:</label>
            <select name="abilities[]" id="abilities" multiple>
                <option value="immortality" <?= getSelected('abilities', 'immortality') ?>>Бессмертие</option>
                <option value="wall_pass" <?= getSelected('abilities', 'wall_pass') ?>>Прохождение сквозь стены</option>
                <option value="levitation" <?= getSelected('abilities', 'levitation') ?>>Левитация</option>
                 <option value="Fly" <?= getSelected('abilities', 'Fly') ?>>Полёт</option>
               <option value="tp" <?= getSelected('abilities', 'Teleportation') ?>>Телепортация</option>
            </select>

            <label for="bio">Биография:</label>
            <textarea name="bio" id="bio"><?= getFieldValue('bio') ?></textarea>

            <label>
                <input type="checkbox" name="contract" value="accepted" <?= getChecked('contract', 'accepted') ?>> С контрактом ознакомлен
            </label>

            <input type="submit" value="Отправить">
        </form>
    </div>
     <script>
        // Заполнение списка годов
        const select = document.getElementById('birth_year');
        const currentYear = new Date().getFullYear();
        for (let i = currentYear; i >= currentYear - 100; i--) {
            const option = document.createElement('option');
            option.value = i;
            option.text = i;
            select.add(option);
        }
    </script>
</body>
</html>
