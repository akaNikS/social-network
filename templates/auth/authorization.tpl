<h1>Авторизация</h1>
<form method="post">
    <p>email:</p>
    <input name="email">
    {if (!empty($errors['email']))}
        <p style="color: red; font-size: 10px;">Неккоректный email</p>
    {/if}
    <p>Пароль</p>
    <input type="password" name="password">
    {if (!empty($errors['password']))}
        <p style="color: red; font-size: 10px;">пароль должен содержать минимум 8 знаков</p>
    {/if}
    <p></p>
    <input type="submit">
</form>