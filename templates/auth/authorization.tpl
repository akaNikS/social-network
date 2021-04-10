<html lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="/assets/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/auth/authorization.css">
    <title>Авторизация</title>
</head>

<body>
    <section>
        <div class="container__auth">
            <div class="container__title">
                <h1>АВТОРИЗАЦИЯ</h1>
            </div>
            <div class="container__auth__form">
                <form method="post" class="form_auth">
                    <div class="container__auth_input">
                        <input type="email" name="email" placeholder="  E-mail" id="email">
                        {if (!empty($errors['email']))}
                            <p style="color: red; font-size: 10px;">{$errors['email']}</p>
                        {/if}
                        <input type="password" name="password" placeholder="  Password">
                        {if (!empty($errors['password']))}
                            <p style="color: red; font-size: 10px;">{$errors['password']}</p>
                        {/if}
                    </div>
                    <div class="container__auth_submit">
                        <label id="test"><input type="checkbox" name="remember"> Запомнить</label>
                        <input type="submit" value="Вход" id="auth_button">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>