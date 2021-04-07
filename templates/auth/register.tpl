
<h1>Регистрация</h1>
<form method="post">

    <p>Имя:</p>
    <input name="name" placeholder="Имя*">
    {if (!empty($errors['name']))}
        <p style="color: red; font-size: 10px;">{$errors['name']}</p>
    {/if}

    <p>Фамилия:</p>
    <input name="surname" placeholder="Фамилия*">
    {if (!empty($errors['surname']))}
        <p style="color: red; font-size: 10px;">{$errors['surname']}</p>
    {/if}

    <p>Отчество:</p>
    <input name="middle_name" placeholder="Отчество">
    {if (!empty($errors['middle_name']))}
        <p style="color: red; font-size: 10px;">{$errors['middle_name']}</p>
    {/if}

    <p>email:</p>
    <input name="email">
    {if (!empty($errors['email']))}
        <p style="color: red; font-size: 10px;">{$errors['email']}</p>
    {/if}

    <p>Пароль:</p>
    <input type="password" name="password">
    {if (!empty($errors['password']))}
        <p style="color: red; font-size: 10px;">{$errors['password']}</p>
    {/if}
    <p></p>
    <input type="submit">
</form>