<html lang="ru">
<head>
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous">
    </script>
    <script src="/assets/main.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/auth/authorization.css">

    <title>Авторизация</title>
</head>

<body>
<div class="login">
    <div class="inner_container">
        <h1>АВТОРИЗАЦИЯ</h1>
        <form method="post" class="form_column">
            <div class="form_item form_item_with_error">
                <input class="form_item_input" type="email" name="email" placeholder="E-mail" id="email">
                {if (!empty($errors['email']))}
                    <p class="form_item__error">{$errors['email']}</p>
                {/if}
            </div>
            <div class="form_item form_item_with_error">
                <input class="form_item_input" type="password" name="password" placeholder="Пароль">
                {if (!empty($errors['password']))}
                    <p class="form_item__error">{$errors['password']}</p>
                {/if}
            </div>
            <div class="form_horizontal_spacer_before"></div>
            <div class="form_item form_row align_space_between align_base_line">
                <div class="form_item_element">
                    <input id="remember" type="checkbox" name="remember">
                    <label for="remember">Запомнить</label>
                </div>
                <input type="submit" value="Вход" class="button_submit">
            </div>
            <div class="form_horizontal_spacer"></div>
        </form>
    </div>
</div>

</body>
</html>