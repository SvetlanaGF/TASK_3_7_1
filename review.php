<?php
$host = 'localhost';
$dbname = 'reviews_db';
$user = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $product_id = $_POST['product_id'];
    $user_name = $_POST['user_name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Валидация данных
    if (!empty($product_id) && !empty($user_name) && !empty($rating) && !empty($comment)) {
        // Подготовка и выполнение запроса на вставку данных
        $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_name, rating, comment) VALUES (:product_id, :user_name, :rating, :comment)");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);

        if ($stmt->execute()) {
            echo "Спасибо за ваш отзыв!";
        } else {
            echo "Ошибка отправки отзыва.";
        }
    } else {
        echo "All fields are required!";
    }
}