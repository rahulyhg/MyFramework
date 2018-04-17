<?php

echo "<h1>$error</h1>";
?>
<a href="/register">Регестрація</a>
<form action="" method="post">
    <table>
        <tr>
            <td>Login: </td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td>Пароль: </td>
            <td><input type="password" name="password"></td>
        </tr>

    </table>



    <input type="submit" value="Ввійти">
</form>