<?php if(!isset($errors)) $errors = array(); ?>
<?php if(!isset($data)) $data = array(); ?>

<div class="row">

    <div class="col-sm-12"><h1>Register</h1></div>

    <form role="form" action="index.php?page=Users&action=add" method="post">

    <div class="col-sm-4">

        <!-- Real Name -->
        <div class="form-group">
            <label for="name">Real Name</label>
            <div class="text-danger"><label class="label-name" id="label-error-name">Your name was not enter correctly!</label></div>
            <input type="text" class="txtbox form-control" id="name" name="name" placeholder="Your Name" required>
        </div>

        <!--  Email  -->
        <div class="form-group">
            <label for="email">Email</label>
            <div class="text-danger"><label class="label-email" id="label-error-email">Your email is not valid!</label></div>
            <div class="text-danger"><label class="label-email" id="label-error-clone">User with the same email exists!</label></div>
            <input type="text" class="txtbox form-control" id="email" name="email" placeholder="Enter Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="text-danger"><label class="label-password" id="label-error-password">Your password must contain at least 1 digit, 1 lowecase and 1 uppercase letter!</label></div>
            <input type="password" class="txtbox form-control" id="password" name="password" placeholder="Enter Password" required>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="repassword">Confirm Password</label>
            <div class="text-danger"><label class="label-repassword" id="label-error-repassword">You did not enter your second password correctly!</label></div>
            <input type="password" class="txtbox form-control" id="repassword" name="repassword" placeholder="Confirm Password" required>
        </div>

    </div>

    <div class="col-sm-8">

        <!-- Birthday selector -->
        <div class="controlls form-inline form-group">
            <div> <label>Birth Date</label> </div>
            <label>
                <select name="birth_day" id="birth-day"></select> Day
            </label>
            <label>
                <select name="birth_month" id="birth-month"></select> Month
            </label>
            <label>
                <select name="birth_year" id="birth-year"></select> Year
            </label>
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

        <!-- Captcha -->
        <div class="text-danger"> <label id="label-error-captcha">  </label> </div>

        <?php
            echo \core\wrapper\CaptchaWrapper::createCaptcha(__ENVIRONMENT__)->html();
        ?>


        <button type="submit" class="btn btn-default">Submit</button>
        <a href="#terms-and-conditions" id="link-terms">Show Terms and Conditions</a>
    </div>
</form>
</div>
<div class="col-sm-8">
    <div id="terms-and-confitions">
        <?php require __ROOT__.'/terms-and-conditions.html'; ?>
    </div>
    <div id="myID">

    </div>

</div>


<script type="text/javascript">

    $(".text-danger label").hide();

    $('#terms-and-confitions').hide();

    $('.txtbox').focus(function(event) {
        $('.label-' + this.id).hide();
    });

    for( var error in <?php echo json_encode($errors); ?> ) {
        $('#label-error-' + error).show();
    }

    $('#link-terms').click(function(event) {
        $('#terms-and-confitions').slideToggle('fast', function(){
            var $target = $('html,body');
            $target.animate({scrollTop: $target.height()}, 1000);
        });
    });

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
                        $('#label-error-clone').hide();
                    }
                    else
                        $('#label-error-clone').show();
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
    $('#birth-month').html(data);
    $('#birth-month').on('change', function(event) {

        var data = '';
        var maxDay = months[$('#birth-month').prop('selectedIndex')].length;

        for ( var i = 1; i <= maxDay ; i++ ) {
            data += '<option>' + parseInt(i).toString() + '</option>';
        }

        $('#birth-day').html(data);
    });
    $('#birth-month').trigger('change');
    data = '';
    for ( var i = currentYear ; i >= 1900 ; i -- ) {
        data += '<option>' + i.toString() + '</option>';
    }
    $('#birth-year').html(data);

</script>