<h1>hello</h1>

<input type="text" id="search">

<div id="result"></div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#search').change(function(){

            $.ajax({
                type : 'GET',
                url : 'index-ajax.php?helper=Tests&action=test',
                success: function (msg){
                    console.log(msg);
                    $('#result').html(msg);
                }
            });

        });
    });
</script>