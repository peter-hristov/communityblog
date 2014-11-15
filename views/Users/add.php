<?php if(!isset($errors)) $errors = array(); ?>
<?php if(!isset($data)) $data = array(); ?>

<div class="col-sm-4">

  <h1 class="text-center">Register</h1>

  <form role="form" action="index.php?page=Users&action=add" method="post">

    <!-- Email Already Registered -->
    <div class="form-group">
        <label class="text-danger" id="label-email-registered"></label>
    </div>

    <!--  Email  -->
    <div class="form-group">
        <label for="email">Email</label>
        <div class="text-danger"> <label id="label-error-email"></label> </div>
        <div class="text-danger"> <label id="label-error-clone"></label> </div>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <div class="text-danger"> <label id="label-error-password"></label> </div>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label for="repassword">Confirm Password</label>
        <div class="text-danger"> <label id="label-error-repassword"></label> </div>
        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirm Password" required>
    </div>

    <!-- Real Name -->
    <div class="form-group">
        <label for="name">Real Name</label>
        <div class="text-danger"> <label id="label-error-name"></label> </div>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
    </div>

    <!-- Gender Options -->
    <div class="form-group">
        <label>Gender</label>

        <div class="text-danger"> <label id="label-error-gender"> </label> </div>

        <label class="radio-inline">
            <input type="radio" name="gender" value="male" id="male"> Male
        </label>

        <label class="radio-inline">
            <input type="radio" name="gender" value="female" id="female"> Female
        </label>
    </div>

    <!-- Birthday selector -->
    <div class="controlls form-inline form-group">
        <label>
            <select name="birth_day" id="birth_day"></select> Day
        </label>
        <label>
            <select name="birth_month" id="birth_month"></select> Month
        </label>
        <label>
            <select name="birth_year" id="birth_year"></select> Year
        </label>
    </div>

    <!-- Captcha -->
    <div class="text-danger"> <label id="label-error-captcha">  </label> </div>

    <?php
        echo \core\wrapper\CaptchaWrapper::createCaptcha(__ENVIRONMENT__)->html();
    ?>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<script type="text/javascript">

    var errorsMsg = {
        'email': "Your email is not valid!",
        'password': "Your password must contain at least 1 digit, 1 lowecase and 1 uppercase letter!",
        'repassword': "You did not enter your second password correctly!",
        'name': "Your name was not enter correctly!",
        'gender': "Please specify your gender!",
        'captcha': "You entered the captcha incorrectly!",
        'clone' : "User with the same email exists!"
    };

    for( var error in <?php echo json_encode($errors); ?> ) {
        document.getElementById('label-error-' + error).innerHTML = errorsMsg[error];
    }

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#email").change(function() {
            $.ajax({
                type: "POST",
                url: "./ajax/ajax-login.php",
                data: "&email=" + $('#email').val(),
                success: function(response) {
                    if (response == 1) {
                        document.getElementById('label-error-clone').innerHTML = '';
                    }
                    else
                        document.getElementById('label-error-clone').innerHTML = errorsMsg.clone;
                }
            });
        });
    });
</script>

<!-- Birthday selector script -->
<script type="text/javascript">

    var currentYear = 2014;

    var months = [
        {'name' : 'January', 'length' : 31 },
        {'name' : 'February', 'length' : 28},
        {'name' : 'March', 'length' : 31},
        {'name' : 'April', 'length' : 30},
        {'name' : 'May', 'length' : 31},
        {'name' : 'June', 'length' : 30},
        {'name' : 'July', 'length' : 31},
        {'name' : 'August', 'length' : 30},
        {'name' : 'September', 'length' : 31},
        {'name' : 'October', 'length' : 30},
        {'name' : 'November', 'length' : 31},
        {'name' : 'December', 'length' : 30},
    ];

    var dayElement = document.getElementById('birth_day');
    var monthElement = document.getElementById('birth_month');
    var yearElement = document.getElementById('birth_year');

    var data = '';
    for ( var x in months ) {
        data +='<option value=\'' + (parseInt(x)+1).toString() + '\'>' + months[x].name + '</option>';
    }
    monthElement.innerHTML = data;
    monthElement.addEventListener('change', change);

    data = '';
    for ( var i = currentYear ; i >= 1900 ; i -- ) {
        data += '<option>' + parseInt(i).toString() + '</option>';
    }
    yearElement.innerHTML = data;

    change ();

    function change()
    {
        var data = '';
        var maxDay = months[monthElement.selectedIndex].length;

        for ( var i = 1; i <= maxDay ; i++ ) {
            data += '<option>' + parseInt(i).toString() + '</option>';
        }

        dayElement.innerHTML = data;
    }
</script>