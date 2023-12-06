<main id="signup" class="page">
    <form onsubmit="return validate(event,signup)" method='post'>
        <fieldset>'
            <legend>Register an account</legend>
            <input name="user_name" type="text" placeholder="name" data-validate="str" data-min="2" data-max="30">

            <input name="user_last_name" type="text" placeholder="last name" data-validate="str" data-min="2" data-max="50">

            <input name="user_email" type="text" placeholder="email" data-validate="email">

            <input name="user_address" type="text" placeholder="address" data-validate="str" data-min="2" data-max="50">
            <input name="user_zip" type="text" placeholder="zip" data-validate="int" data-min="3" data-max="4">
            <input name="user_city" type="text" placeholder="city" data-validate="str" data-min="2" data-max="40">

            <input name="user_password" type="text" placeholder="password" data-validate="str" data-min="2" data-max="100">

            <input name="user_confirm_password" type="text" placeholder="confirm password" data-validate="match" data-match-name="user_password">
            <input type="hidden" name="user_role" value="user">
            <button>Signup</button>
        </fieldset>
        <!-- <button type="submit">Signup</button> -->
    </form>
    <p>Want to sign up as a partner?</p><button>Partner sign up</button>
</main>