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
        <div class="text-danger"><label id="label-error-email">Your email is not valid!</label></div>
        <div class="text-danger"><label id="label-error-clone">User with the same email exists!</label></div>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <div class="text-danger"><label id="label-error-password">Your password must contain at least 1 digit, 1 lowecase and 1 uppercase letter!</label></div>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label for="repassword">Confirm Password</label>
        <div class="text-danger"><label id="label-error-repassword">You did not enter your second password correctly!</label></div>
        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirm Password" required>
    </div>

    <!-- Real Name -->
    <div class="form-group">
        <label for="name">Real Name</label>
        <div class="text-danger"><label id="label-error-name">Your name was not enter correctly!</label></div>
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

    $('.text-danger label').hide();

    for( var error in <?php echo json_encode($errors); ?> ) {
        $('#label-error-' + error).show();
    }

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#email").change(function() {
            $.ajax({
                type: "GET",
                url: "./ajax/index.php",
                data: "&email=" + $('#email').val() + "&helper=" + 'Users' + '&action=' + 'doesUserExist' ,
                success: function(response) {
                    if (response == '0') {
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

    var currentYear = new Date().getFullYear();
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

    var data = '';
    for ( var i = 0 ; i < months.length ; i++ ) {
        data +='<option value=\'' + (i + 1).toString() + '\'>' + months[i].name + '</option>';
    }
    $('#birth_month').html(data);
    $('#birth_month').on('change', function(event) {

        var data = '';
        var maxDay = months[$('#birth_month').prop('selectedIndex')].length;

        for ( var i = 1; i <= maxDay ; i++ ) {
            data += '<option>' + parseInt(i).toString() + '</option>';
        }

        $('#birth_day').html(data);
    });
    $('#birth_month').trigger('change');
    data = '';
    for ( var i = currentYear ; i >= 1900 ; i -- ) {
        data += '<option>' + i.toString() + '</option>';
    }
    $('#birth_year').html(data);

</script>