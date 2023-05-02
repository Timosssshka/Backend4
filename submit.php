<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages['saved'] = '
      <div class="success">
        <p class="fs-4 fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
          <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
          </svg>Спасибо, результаты сохранены.
        </p>
      </div>';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  if (isset($_COOKIE['name_error'])) {
    $errors['name'] = $_COOKIE['name_error'];
  } else {
    $errors['name'] = '';
  }
  if (isset($_COOKIE['email_error'])) {
    $errors['email'] = $_COOKIE['email_error'];
  } else {
    $errors['email'] = '';
  }
  $errors['birth_date'] = !empty($_COOKIE['birth_date_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['superpowers'] = !empty($_COOKIE['superpowers_error']);
  $errors['contract'] = !empty($_COOKIE['contract_error']);

  // Выдаем сообщения об ошибках.
  if ($errors['name'] == 1) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('name_error', '', 100000);
    // Выводим сообщение.
    $messages['name'] = '<div class="error-msg">Введите имя!</div>';
  } else if ($errors['name'] == 2) {
    setcookie('name_error', '', 100000);
    $messages['name'] = '<div class="error-msg">Допустимы только буквы А-Я, A-Z.</div>';
  }

  if ($errors['email'] == 1) {
    setcookie('email_error', '', 100000);
    $messages['email'] = '<div class="error-msg">Введите верный email!</div>';
  } else if ($errors['email'] == 2) {
    setcookie('email_error', '', 100000);
    $messages['email'] = '<div class="error-msg">Введите email верного формата!</div> <div class="error-msg">Пример: test@example.com</div>';
  }

  if ($errors['birth_date']) {
    setcookie('birth_date_error', '', 100000);
    $messages['birth_date'] = '<div class="error-msg">Введите дату рождения!</div>';
  }

  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages['gender'] = '<div class="error-msg">Выберите пол!</div>';
  }

  if ($errors['limbs']) {
    setcookie('limbs_error', '', 100000);
    $messages['limbs'] = '<div class="error-msg">Выберите количество конечностей!</div>';
  }

  if ($errors['superpowers']) {
    setcookie('superpowers_error', '', 100000);
    $messages['superpowers'] = '<div class="error-msg">Выберите суперспособности!</div>';
  }

  if ($errors['contract']) {
    setcookie('contract_error', '', 100000);
    $messages['contract'] = '<div class="error-msg">Для подтверждения знакомства с котрактом нажмите на чекбокс.</div>';
  }

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['birth_date'] = empty($_COOKIE['birth_date_value']) ? '' : $_COOKIE['birth_date_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['immortality'] = isset($_COOKIE['immortality_value']) ? 'selected' : '';
  $values['levitation'] = isset($_COOKIE['levitation_value']) ? 'selected' : '';
  $values['wall_passing'] = isset($_COOKIE['wall_passing_value']) ? 'selected' : '';
  $values['telekinesis'] = isset($_COOKIE['telekinesis_value']) ? 'selected' : '';
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['contract'] = empty($_COOKIE['contract_value']) ? '' : 'checked';

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $birth_date = $_POST['birth_date'];
  $gender = $_POST['gender'];
  $limbs = $_POST['limbs'];
  $superpowers = $_POST['superpowers'];
  $bio = $_POST['bio'];

  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['name'])) {
    // Выдаем куку на день с флажком об ошибке в поле name.
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (preg_match("/[^a-zA-Zа-яёА-ЯЁ ]/u", $_POST['name'])) {
    setcookie('name_error', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['email'])) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['birth_date'])) {
    setcookie('birth_date_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('birth_date_value', $_POST['birth_date'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['gender'])) {
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['limbs'])) {
    setcookie('limbs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['superpowers'])) {
    setcookie('superpowers_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    foreach ($superpowers as $item) {
      switch ($item) {
        case 'immortality':
          setcookie('immortality_value', $item, time() + 30 * 24 * 60 * 60);
          break;
        case 'levitation':
          setcookie('levitation_value', $item, time() + 30 * 24 * 60 * 60);
          break;
        case 'wall_passing':
          setcookie('wall_passing_value', $item, time() + 30 * 24 * 60 * 60);
          break;
        case 'telekinesis':
          setcookie('telekinesis_value', $item, time() + 30 * 24 * 60 * 60);
          break;
      }
    }
  }

  if (!empty($_POST['bio'])) {
    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['contract'])) {
    setcookie('contract_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('contract_value', $_POST['contract'], time() + 30 * 24 * 60 * 60);
  }

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  } else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('birth_date_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('limbs_error', '', 100000);
    setcookie('superpowers_error', '', 100000);
    setcookie('contract_error', '', 100000);
  }

  // Сохранение в БД.
  $conn = new mysqli('localhost', 'root', '', 'test');
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  } else {
    $stmt = $conn->prepare("INSERT INTO users(name, email, birth_date, gender, limbs, bio)
    VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $name, $email, $birth_date, $gender, $limbs, $bio);
    $stmt->execute();
    $last_id = mysqli_insert_id($conn);
    foreach ($superpowers as $item) {
        switch ($item) {
            case 'immortality':
                $superpower_id = 1;
              break;
            case 'levitation':
                $superpower_id = 2;
              break;
            case 'wall_passing':
                $superpower_id = 3;
              break;
            case 'telekinesis':
                $superpower_id = 4;
              break;
        }
      $query = "INSERT INTO user_superpowers (user_id, superpower_id) VALUES ('$last_id', '$superpower_id')";
      mysqli_query($conn, $query);
    }
    $stmt->close();
    $conn->close();
  }

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: submit.php');
}
