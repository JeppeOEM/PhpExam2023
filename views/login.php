<main id="login" class="page">
    <h1>Login</h1>
    <form onsubmit="return validate(event, login)" method='post'>
        <input name=" user_email" type="text" placeholder="email" data-validate="email">
        <input name="user_password" type="text" placeholder="password" data-validate="str" data-min="2" data-max="20">
        <button>login</button>
    </form>
</main>