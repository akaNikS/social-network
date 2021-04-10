<html lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="/assets/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/auth/authorization.css">
    <title>Авторизация</title>
</head>

<body>
<div class="login">
    <div class="inner_container">
        <h1>АВТОРИЗАЦИЯ</h1>
        <form method="post" class="form_column">
            <div class="form_item">
                <input type="email" name="email" placeholder="E-mail" id="email">
                {if (!empty($errors['email']))}
                    <p class="form_item__error">{$errors['email']}</p>
                {/if}
            </div>
            <div class="form_item">
                <input type="password" name="password" placeholder="Пароль">
                {if (!empty($errors['password']))}
                    <p class="form_item__error">{$errors['password']}</p>
                {/if}
            </div>
            <div class="form_horizontal_spacer_before"></div>
            <div class="form_item direction_row">
                <label><input type="checkbox" name="remember"> Запомнить</label>
                <input type="submit" value="Вход" class="button_submit">
            </div>
            <div class="form_horizontal_spacer"></div>
        </form>
    </div>
</div>
</body>
</html>