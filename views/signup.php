<main id="signup" class="page mt-12">
    <div class="max-w-2xl mx-auto">
        <div id="text_partner" class=" mt-4 text-xl pb-4 flex justify-center">
            <button class="change_signup_partner">Want to sign up as a partner? <span class="text-blue-500">Click here</span></button>
        </div>
        <div id="text_user_btn" class="flex hidden mt-4  pb-4 text-xl justify-center">
            <button name="change_sign" class=" change_signup_user"> Want to sign up as a user?<span class="text-blue-500"> Click here</span></button>
        </div>
        <div class="flex flex-col justify-center items-center container-sm mx-auto">
            <form onsubmit="return validate(event, user_signup)" method="post" class="bg-gray-100 p-8 rounded-lg shadow-md ">
                <fieldset>
                    <legend class="text-xl font-bold mb-4">Register as a <span id="signup_legend">user</span></legend>
                    <div class="flex">
                        <div class="w-1/2 pr-2">
                            <label for="user_name">Name</label>
                            <input name="user_name" value="ddddd" type="text" placeholder="Name" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>" class="w-full p-2 rounded-lg mb-4">
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="user_last_name">Last Name</label>
                            <input name="user_last_name" value="dddd" type="text" placeholder="Last Name" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>" class="w-full p-2 rounded-lg mb-4">
                        </div>
                    </div>
                    <label for="user_email">
                        Email
                    </label>
                    <input name="user_email" type="text" onblur="is_email_available(event)" onfocus='document.querySelector("#msg_email_not_available").classList.add("hidden")' data-validate="email" class="w-full p-2 rounded-lg mb-4">
                    <div id="msg_email_not_available" class="hidden pb-4 text-red-600">
                        <span>
                            Email is not available or not valid
                        </span>
                    </div>
                    <label for="user_address">Address</label>
                    <input name="user_address" value="stenholmsvej 22" type="text" placeholder="Address" data-validate="str" data-min="<?= USER_ADDRESS_MIN ?>" data-max="<?= USER_ADDRESS_MAX ?>" class="w-full p-2 rounded-lg mb-4">

                    <div class="flex mb-4">
                        <div class="w-1/2 pr-2">
                            <label for="user_zip">Zip</label>
                            <input name="user_zip" value="2222" type="number" step="1" placeholder="Zip" data-validate="int" data-min="<?= USER_ZIP_MIN ?>" data-max="<?= USER_ZIP_MAX ?>" class="w-full p-2 rounded-lg">
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="user_city">City</label>
                            <input name="user_city" value="kbh" type="text" placeholder="City" data-validate="str" data-min="<?= USER_CITY_MIN ?>" data-max="<?= USER_CITY_MAX ?>" class=" w-full p-2 rounded-lg">
                        </div>
                    </div>

                    <div id="signup_restaurant_name" class="hidden">
                        <label for="restaurant_name text-gray-600">Restaurant name</label>
                        <input name="restaurant_name" value="rest" type="text" placeholder="Restaurant name" data-min="<?= USER_RESTAURANT_MIN ?>" data-max="<?= USER_RESTAURANT_MAX ?>" class="w-full p-2 rounded-lg mb-4">
                    </div>

                    <label for="user_password text-gray-600">Password</label>
                    <input value="password" name="user_password" type="text" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>" class=" w-full p-2 rounded-lg mb-4">

                    <label for="user_confirm_password">Confirm Password</label>
                    <input value="password" name="user_confirm_password" type="text" placeholder="Confirm Password" data-validate="match" data-match-name="user_password" class="w-full p-2 rounded-lg mb-4">

                    <input id="user_role_input" type="hidden" name="user_role" value="user">

                    <button class="w-full p-2 rounded-lg bg-blue-500 text-white">Signup</button>
                </fieldset>
            </form>


        </div>
    </div>
</main>