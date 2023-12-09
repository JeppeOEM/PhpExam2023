<main id="signup" class="page">
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col justify-center items-center container-sm mx-auto">
            <form onsubmit="return validate(event, user_signup)" method="post" class="bg-gray-100 p-8 rounded-lg shadow-md">
                <fieldset>
                    <legend class="text-lg font-bold mb-4">Register as a <span id="signup_legend">user</span></legend>
                    <div class="flex">
                        <div class="w-1/2 pr-2">
                            <label for="user_name" class="text-sm text-gray-600">Name</label>
                            <input name="user_name" value="ddddd" type="text" placeholder="Name" data-validate="str" data-min="2" data-max="30" class="w-full p-2 rounded-lg mb-4">
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="user_last_name" class="text-sm text-gray-600">Last Name</label>
                            <input name="user_last_name" value="dddd" type="text" placeholder="Last Name" data-validate="str" data-min="2" data-max="50" class="w-full p-2 rounded-lg mb-4">
                        </div>
                    </div>
                    <label for="user_email" class="text-sm text-gray-600">Email</label>
                    <input name="user_email" value="oo@oo.dk" type="text" placeholder="Email" data-validate="email" class="w-full p-2 rounded-lg mb-4">

                    <label for="user_address" class="text-sm text-gray-600">Address</label>
                    <input name="user_address" value="stenholmsvej 22" type="text" placeholder="Address" data-validate="str" data-min="2" data-max="50" class="w-full p-2 rounded-lg mb-4">

                    <div class="flex mb-4">
                        <div class="w-1/2 pr-2">
                            <label for="user_zip" class="text-sm text-gray-600">Zip</label>
                            <input name="user_zip" value="2222" type="text" placeholder="Zip" data-validate="str" data-min="3" data-max="5" class="w-full p-2 rounded-lg">
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="user_city" class="text-sm text-gray-600">City</label>
                            <input name="user_city" value="kbh" type="text" placeholder="City" data-validate="str" data-min="2" data-max="40" class="w-full p-2 rounded-lg">
                        </div>
                    </div>

                    <div id="signup_restaurant_name">
                        <label for="restaurant_name" class="text-sm text-gray-600">Restaurant name</label>
                        <input name="restaurant_name" value="rest" type="text" placeholder="Restaurant name" data-validate="str" data-min="2" data-max="40" class="w-full p-2 rounded-lg mb-4">
                    </div>

                    <label for="user_password" class="text-sm text-gray-600">Password</label>
                    <input value="password" name="user_password" type="text" placeholder="Password" data-validate="str" data-min="2" data-max="100" class="w-full p-2 rounded-lg mb-4">

                    <label for="user_confirm_password" class="text-sm text-gray-600">Confirm Password</label>
                    <input value="password" name="user_confirm_password" type="text" placeholder="Confirm Password" data-validate="match" data-match-name="user_password" class="w-full p-2 rounded-lg mb-4">

                    <input id="user_role_input" type="hidden" name="user_role" value="user">

                    <button class="w-full p-2 rounded-lg bg-blue-500 text-white">Signup</button>
                </fieldset>
            </form>

            <span id="text_partner" class="text-center mt-4">
                <p>Want to sign up as a partner?</p><button class="change_signup_partner">Partner sign up</button>
            </span>
            <span id="text_user" class="hidden text-center mt-4">
                <p>Want to sign up as a user?</p><button class="change_signup_user">User sign up</button>
            </span>
        </div>
    </div>
</main>