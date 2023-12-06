<main id="signup" class="page">
    <form onsubmit="return validate(event,signup)" method='post'>
        <input name="user_name" type="text" placeholder="name" data-validate="str" data-min="2" data-max="20">

        <input name="user_last_name" type="text" placeholder="last name" data-validate="str" data-min="2" data-max="20">

        <input name="user_email" type="text" placeholder="email" data-validate="email">

        <input name="user_password" type="text" placeholder="password" data-validate="str" data-min="2" data-max="20">

        <input name="user_confirm_password" type="text" placeholder="confirm password" data-validate="match" data-match-name="user_password">

        <button>Signup</button>
        <!-- <button type="submit">Signup</button> -->

    </form>
</main>