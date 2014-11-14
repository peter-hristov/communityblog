<h1>hello</h1>

<input type="text" id="search">

<div id="result"></div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#search').change(function(){

            $.ajax({
                type : 'GET',
                url : 'index-ajax.php?controller=Tests&action=test&ajax=1',
                success: function (msg){
                    //console.log(msg);
                    //$('#result').html(msg);
                    //msg = JSON.parse(msg);
                    //for (var i = msg.length - 1; i >= 0; i--) {
                        //console.log(msg[i]);
                    //}
                    //
                    console.log(msg);

                }
            });

        });
    });
</script>