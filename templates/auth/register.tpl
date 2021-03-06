<html lang="ru">

<head>
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous">
    </script>
    <script src="/assets/main.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/auth/registration.css">

    <title>Регистрация</title>
</head>

<body>
<div class="login">
    <div class="inner_container">
        <h1>РЕГИСТРАЦИЯ</h1>
        <form class="form_column" method="post">
            <div class="form_item form_item_with_error">
                <input class="form_item_input" name="name" placeholder="Имя">
                {if (!empty($errors['name']))}
                    <p class="form_item__error">{$errors['name']}</p>
                {/if}
            </div>
            <div class="form_item form_item_with_error">
                <input class="form_item_input" name="surname" placeholder="Фамилия">
                {if (!empty($errors['surname']))}
                    <p class="form_item__error">{$errors['surname']}</p>
                {/if}
            </div>
            <div class="form_item form_item_with_error">
                <input class="form_item_input" name="middle_name" placeholder="Отчество">
                {if (!empty($errors['middle_name']))}
                    <p class="form_item__error">{$errors['middle_name']}</p>
                {/if}
            </div>
            <div class="form_item form_item_with_error">
                <input class="form_item_input" type="email" name="email" placeholder="E-mail">
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
            <div class="form_item align_center">
                <input class="button_submit" type="submit" value="Зарегистрироваться">
            </div>
            <div class="form_horizontal_spacer"></div>
        </form>
    </div>
</div>

</body>
</html>