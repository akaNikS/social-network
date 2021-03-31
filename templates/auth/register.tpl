
<h1>Регистрация</h1>
<form method="post">
    <p>Имя:</p>
    <input name="name" placeholder="Имя*">
    {if (!empty($errors['name']))}
        <p style="color: red; font-size: 10px;">Укажите имя</p>
    {/if}

    <p>Фамилия:</p>
    <input name="surname" placeholder="Фамилия*">
    {if (!empty($errors['surname']))}
        <p style="color: red; font-size: 10px;">Укажите фамилию</p>
    {/if}

    <p>Отчество:</p>
    <input name="middle_name" placeholder="Отчество">

    <p>email:</p>
    <input name="email">
    {if (!empty($errors['email']))}
        <p style="color: red; font-size: 10px;">Неккоректный email</p>
    {/if}

    <p>Пароль:</p>
    <input type="password" name="password">
    {if (!empty($errors['password']))}
        <p style="color: red; font-size: 10px;">пароль должен содержать минимум 8 знаков</p>
    {/if}
    <p></p>
    <input type="submit">
</form>