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
            <input type="radio" name="gender" id="male"> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" id="female"> Female
        </label>
    </div>





    <div id="datetimepicker" class="input-append date form-group">
      <input type="text"></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>

    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>    

    <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy'    
      });
    </script>









    <button type="submit" class="btn btn-default">Submit</button>


  </form>


</div>