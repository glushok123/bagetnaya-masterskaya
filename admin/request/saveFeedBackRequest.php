<?php
require_once '../../base/connect.php';

try {
    $stmt = $dbh->prepare("INSERT INTO feed_back(name, email, phone, comment, created_at) values (?,?,?,?,?)");

    $stmt->bindParam(1, $_POST['user_name']);
    $stmt->bindParam(2, $_POST['email']);
    $stmt->bindParam(3, $_POST['phone']);
    $stmt->bindParam(4, $_POST['comment']);
    $stmt->bindParam(5, date('Y-m-d H:i:s'));

    $stmt->execute();

    $orderId = $dbh->lastInsertId('id');

    $to      = 'manager@bagetnaya-masterskaya.com';
    //$to      = 'glushok19999@gmail.com';
    $subject = 'Заявка № ' . $orderId . ' на обратную связь';
    $message = "
            Заявка: <b> " . $orderId . "</b>
            <br>
            Имя: <b> " . $_POST['user_name'] . "</b>
            <br>
            Телефон: <b> " . $_POST['phone'] . "</b>
            <br>
            Тип связи: <b> " . $_POST['email'] . "</b>
            <br>
            Комментарий:<br><i>" . $_POST['comment'] . "</i><br>
        ";
    $headers = "From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type: text/html; charset = UTF-8\r\n";

    mail($to, $subject, $message, $headers);

    echo json_encode([
        'success' => true,
        'message' => 'Ваша заявка зарегистрирована под № ' . $orderId . '. В течении 10 минут с вами свяжется наш менеджер.',
        'order_id' => $orderId
    ], JSON_THROW_ON_ERROR);
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
