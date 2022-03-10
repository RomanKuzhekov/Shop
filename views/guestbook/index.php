<h1>Гостевая книга</h1>
<? foreach ($comments as $comment): ?>
    <div class="comments">
        <p>ФИО: <?=$comment->fio?></p>
        <p>Email: <?=$comment->email?></p>
        <p>Текст: <?=$comment->text?></p>
        <p><i>Дата: <?=$comment->created_at?></i></p>
    </div>
<? endforeach; ?>
<hr>
<form method="post">
    <p><strong>Оставить отзыв о сайте:</strong></p>
    <p>Введите ФИО: <input type="text" name="fio" maxlength="30" required></p>
    <p>Введите Email: <input type="email" name="email" maxlength="20" required></p>
    <p>Введите Текст: <textarea name="text" rows="10" required></textarea></p>
    <p><input type="submit" name="submit"></p>
</form>