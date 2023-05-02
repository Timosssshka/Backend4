<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superhero Registration</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .error {
            border: 2px solid red;
        }
    </style>
</head>

<body>
    <div class="w-100 bg-dark">
        <div class="container p-5 mb-2 text-white">
            <div class="row">
                <div class="col">
                    <img src="images/BingChilling.jpg" alt="Avatar" class="avatar">
                </div>
                <div class="col-8 me-4 align-self-center">
                    <h1>Superhero Registration</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <?php if (!empty($messages['saved'])) {print($messages['saved']);} ?>
        <form action="" method="POST">
            <p><a name="form"></a></p>
            <label>
                Поле для имени:<br />
                <input name="name" placeholder="Имя" class="form-control<?php if ($errors['name']) {print ' error';} ?>" value="<?php print $values['name']; ?>"/>
                <?php if (!empty($messages['name'])) {print($messages['name']);}?>
            </label><br /><br />
            <label>
                Поле для email:<br />
                <input name="email" placeholder="test@example.com" class="form-control<?php if ($errors['email']) {print ' error';} ?>" value="<?php print $values['email']; ?>"/>
                <?php if (!empty($messages['email'])) {print($messages['email']);}?>
            </label><br /><br />
            <label>
                Поле для даты рождения:<br />
                <input name="birth_date" type="date" class="form-control<?php if ($errors['birth_date']) {print ' error';} ?>" value="<?php print $values['birth_date']; ?>"/>
                <?php if (!empty($messages['birth_date'])) {print($messages['birth_date']);}?>
            </label><br /><br />
            Пол:<br />
            <label><input type="radio" name="gender" value="m" <?php if ($values['gender'] == 'm') {print 'checked';} ?>/>
                Мужчина
            </label>
            <label><input type="radio" name="gender" value="f" <?php if ($values['gender'] == 'f') {print 'checked';} ?>/>
                Женщина
            </label>
            <?php if (!empty($messages['gender'])) {print($messages['gender']);}?><br /><br />
            Количество конечностей:<br />
            <label><input type="radio" name="limbs" value="4" <?php if ($values['limbs'] == 4) {print 'checked';} ?>/>
                4
            </label>
            <label><input type="radio" name="limbs" value="6" <?php if ($values['limbs'] == 6) {print 'checked';} ?>/>
                6
            </label>
            <label><input type="radio" name="limbs" value="8" <?php if ($values['limbs'] == 8) {print 'checked';} ?>/>
                8
            </label>
            <?php if (!empty($messages['limbs'])) {print($messages['limbs']);}?><br /><br />
            <label>
                Сверхспособности:<br />
                <select name="superpowers[]" multiple="multiple" class="form-control<?php if ($errors['superpowers']) {print ' error';} ?>">
                    <option <?php print $values['immortality']; ?> value="immortality">бессмертие</option>
                    <option <?php print $values['levitation']; ?> value="levitation">левитация</option>
                    <option <?php print $values['wall_passing']; ?> value="wall_passing">прохождение сквозь стены</option>
                    <option <?php print $values['telekinesis']; ?> value="telekinesis">телекинез</option>
                </select>
                <?php if (!empty($messages['superpowers'])) {print($messages['superpowers']);}?>
            </label><br /><br />
            <label>
                Биография:<br />
                <textarea name="bio" placeholder="Введите информацию о себе" class="form-control"><?php print $values['bio']; ?></textarea>
            </label><br /><br />
            <label><input type="checkbox" name="contract" value="1" <?php print $values['contract']; ?>/>
                С контрактом ознакомлен(а)
            </label>
            <?php if (!empty($messages['contract'])) {print($messages['contract']);}?><br /><br />
            <button class="btn btn-outline-secondary mb-3">Отправить</button>
        </form>
        <div class="row rounded-pill bg-dark mb-4 py-4">
            <a class="col btn btn-light btn-outline-secondary mx-5" href="tables.php" role="button">Таблицы</a>
            <a class="col btn btn-light btn-outline-secondary mx-5" href="screenshots.html" role="button">Скриншоты</a>
        </div>
    </div>
</body>

</html>
