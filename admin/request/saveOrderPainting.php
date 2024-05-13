<?php
require_once '../../base/connect.php';

try {
    $stmt = $dbh->prepare("INSERT INTO orders_paintings(name, email, phone, painting_id, comment, type_dostavky, address, created_at) values (?,?,?,?,?,?,?,?)");

    $stmt->bindParam(1, $_POST['user_name']);
    $stmt->bindParam(2, $_POST['email']);
    $stmt->bindParam(3, $_POST['phone']);
    $stmt->bindParam(4, $_POST['painting_id']);
    $stmt->bindParam(5, $_POST['comment']);
    $stmt->bindParam(6, $_POST['type_dostavky']);
    $stmt->bindParam(7, $_POST['address']);
    $stmt->bindParam(8, date('Y-m-d H:i:s'));

    $stmt->execute();

    $orderId = $dbh->lastInsertId('id');

    $to = 'manager@bagetnaya-masterskaya.com';
    //$to      = 'glushok19999@gmail.com';
    $subject = 'Заказ № ' . $orderId . ' картины с Багетной мастерской';
    $message = "
            Заказ: <b> " . $orderId . "</b>
            <br>
            Имя: <b> " . $_POST['user_name'] . "</b>
            <br>
            Телефон: <b> " . $_POST['phone'] . "</b>
            <br>
            Почта: <b> " . $_POST['email'] . "</b>
            <br>
            Адрес самовывоза: <b> " . $_POST['type_dostavky'] . "</b>
            <br>
            Комментарий:<br><i>" . $_POST['comment'] . "</i><br>
            Ссылка на картину:<br>https://bagetnaya-masterskaya.com/admin/?paintings-id=" . $orderId . "<br>
        ";
    $headers = "From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type: text/html; charset = UTF-8\r\n";

    mail($to, $subject, $message, $headers);

    echo json_encode([
        'success' => true,
        'message' => 'Ваш заказ зарезервирован под № ' . $orderId . '. В течении 10 минут с вами свяжется наш менеджер.',
        'order_id' => $orderId
    ], JSON_THROW_ON_ERROR);
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
