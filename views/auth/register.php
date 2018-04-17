
<h1>РЕГЕСТРАЦІЯ</h1>


<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Login: </td>
            <td><input required type="text" name="user"></td>
        </tr>
        <tr>
            <td>Пароль: </td>
            <td><input required type="password" name="password"></td>
        </tr>
        <tr>
            <td>Емейл: </td>
            <td><input required type="email" name="email"></td>
        </tr>
        <tr>
            <td>ПІБ</td>
            <td><input required type="text" name="fio"></td>
        </tr>
        <tr>
            <td>Про себе</td>
            <td><textarea required name="about"></textarea></td>
        </tr>
        <tr>
            <td>Аватарка</td>
            <td><input type="file" name="img"></td>
        </tr>
    </table>



    <input type="submit" value="Зареєструватися">
</form>