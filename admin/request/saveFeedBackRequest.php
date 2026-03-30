<?php
require_once '../../base/connect.php';

header('Content-Type: application/json; charset=UTF-8');

try {
    $userName = trim((string) ($_POST['user_name'] ?? ''));
    $phone = trim((string) ($_POST['phone'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $comment = trim((string) ($_POST['comment'] ?? ''));

    if ($userName === '') {
        echo json_encode([
            'success' => false,
            'message' => 'необходимо заполнить имя',
        ], JSON_THROW_ON_ERROR);
        exit;
    }

    if ($phone === '') {
        echo json_encode([
            'success' => false,
            'message' => 'необходимо заполнить номер телефона',
        ], JSON_THROW_ON_ERROR);
        exit;
    }

    if ($comment === '') {
        echo json_encode([
            'success' => false,
            'message' => 'необходимо заполнить комментарий',
        ], JSON_THROW_ON_ERROR);
        exit;
    }

    $duplicateStmt = $dbh->prepare("
        SELECT id
        FROM feed_back
        WHERE name = ?
          AND email = ?
          AND phone = ?
          AND comment = ?
          AND created_at >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)
        ORDER BY id DESC
        LIMIT 1
    ");
    $duplicateStmt->execute([$userName, $email, $phone, $comment]);
    $existingOrderId = $duplicateStmt->fetchColumn();

    if ($existingOrderId !== false) {
        echo json_encode([
            'success' => true,
            'duplicate' => true,
            'message' => 'Заявка уже была принята недавно. Повторное письмо не отправлялось.',
            'order_id' => (int) $existingOrderId,
        ], JSON_THROW_ON_ERROR);
        exit;
    }

    $stmt = $dbh->prepare("INSERT INTO feed_back(name, email, phone, comment, created_at) values (?,?,?,?,?)");
    $createdAt = date('Y-m-d H:i:s');

    $stmt->bindParam(1, $userName);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);
    $stmt->bindParam(4, $comment);
    $stmt->bindParam(5, $createdAt);
    $stmt->execute();

    $orderId = $dbh->lastInsertId('id');

    $to = 'manager@bagetnaya-masterskaya.com';
    //$to      = 'glushok19999@gmail.com';
    $subject = 'Заявка № ' . $orderId . ' на обратную связь';
    $message = "
            Заявка: <b> " . $orderId . "</b>
            <br>
            Имя: <b> " . $userName . "</b>
            <br>
            Телефон: <b> " . $phone . "</b>
            <br>
            Тип связи: <b> " . $email . "</b>
            <br>
            Комментарий:<br><i>" . $comment . "</i><br>
        ";
    $headers = "From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type: text/html; charset = UTF-8\r\n";

    mail($to, $subject, $message, $headers);

    echo json_encode([
        'success' => true,
        'message' => 'Ваша заявка зарегистрирована под № ' . $orderId . '. В течении 10 минут с вами свяжется наш менеджер.',
        'order_id' => $orderId
    ], JSON_THROW_ON_ERROR);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal Server Error',
    ], JSON_THROW_ON_ERROR);
}
