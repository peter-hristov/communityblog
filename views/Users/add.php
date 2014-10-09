<div class="col-sm-4">    

  <h1 class="text-center">Register</h1>

  <form role="form" action="index.php?page=Users&action=add" method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
    </div>

    <div class="form-group">
        <label for="name">Real Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
    </div>

    <label>Gender</label>

    <div class="form-group">
        <label class="radio-inline">
            <input type="radio" name="gender" value="male" id="male"> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="female" id="female"> Female
        </label>
    </div>

    <div class="controlls form-inline form-group">
        <label>
            <select name="birth-day" id="birth-day"></select>Day
        </label>
        <label>
            <select name="birth-month" id="birth-month"></select>Month
        </label>
        <label>
            <select name="birth-year" id="birth-year"></select>Year
        </label>        
    </div>



    <script type="text/javascript">

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


        var dayElement = document.getElementById('birth-day')
        var monthElement = document.getElementById('birth-month')
        var yearElement = document.getElementById('birth-year')

        var data = '';
        for ( var x in months ) {
            data +='<option value=\'' + (x + 1) + '\'>' + months[x].name + '</option>';
        }
        monthElement.innerHTML = data;
        monthElement.addEventListener('change', change);

        data = '';
        for ( var i = 1900 ; i <= 2014 ; i ++ ) {
            data += '<option>' + i + '</option>';
        }
        yearElement.innerHTML = data;

        

        change ();

        function change()
        {
            var data = '';
            var maxDay = months[monthElement.selectedIndex].length;

            for ( var i = 1; i <= maxDay ; i++ ) {
                data += '<option>' + i + '</option>';
            }

            dayElement.innerHTML = data;
        }







    </script>














    <button type="submit" class="btn btn-default">Submit</button>


  </form>


</div>