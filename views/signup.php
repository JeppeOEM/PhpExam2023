<main id="signup" class="page">
    <form onsubmit="return validate(event,user_signup)" method='post'>
        <fieldset>
            <legend>Register as a <span id="signup_legend">user</span></legend>
            <input name=" user_name" value="ddddd" type="text" placeholder="name" data-validate="str" data-min="2" data-max="30">
            <input name="user_last_name" value="dddd" type="text" placeholder="last name" data-validate="str" data-min="2" data-max="50">
            <input name="user_email" value="oo@oo.dk" type="text" placeholder="email" data-validate="email">
            <input name="user_address" value="stenholmsvej 22" type="text" placeholder="address" data-validate="str" data-min="2" data-max="50">
            <input name="user_zip" value="2222" type="text" placeholder="zip" data-validate="str" data-min="3" data-max="5">
            <input name="user_city" value="kbh" type="text" placeholder="city" data-validate="str" data-min="2" data-max="40">
            <input id="signup_restaurant_name" class="hidden" name="restaurant_name" value="rest" type="text" placeholder="Restaurant name" data-validate="str" data-min="2" data-max="40">
            <input value="password" name="user_password" type="text" placeholder="password" data-validate="str" data-min="2" data-max="100">

            <input value="password" name="user_confirm_password" type="text" placeholder="confirm password" data-validate="match" data-match-name="user_password">
            <input id="user_role_input" type="hidden" name="user_role" value="user">
            <button>Signup</button>
        </fieldset>
        <!-- <button type="submit">Signup</button> -->
    </form>
    <span id="text_partner">
        <p>Want to sign up as a partner?</p><button class="change_signup_partner">Partner sign up</button>
    </span>
    <span id="text_user" class="hidden">
        <p>Want to sign up as a user?</p><button class="change_signup_user">User sign up</button>
    </span>
</main>