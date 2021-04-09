<link rel="stylesheet" type="text/css" href="/assets/main.css">

<div class="container__auth">
    <div class="container__title">
        <h1>Авторизация</h1>
    </div>
    <div class="container__auth__form">
        <form method="post" class="form_auth">
            <input class="auth_inp" type="email" name="email" placeholder="email" id="email">
            {if (!empty($errors['email']))}
                <p style="color: red; font-size: 10px;">{$errors['email']}</p>
            {/if}
            <input class="auth_inp" type="password" name="password" placeholder="password">
            {if (!empty($errors['password']))}
                <p style="color: red; font-size: 10px;">{$errors['password']}</p>
            {/if}
            <p></p>
            <input type="submit">
        </form>
    </div>
</div>