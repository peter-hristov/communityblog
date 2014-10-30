<div class='omg'></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.omg').html('<img src="http://i.imgur.com/90Mmdcm.png">');

        $('.omg img').hover(function(){
            this.src = 'http://i.imgur.com/nTj3Fxx.gif';
        }, function (){
            this.src = 'http://i.imgur.com/90Mmdcm.png';
        });

        $('.omg img').mousedown(function(){

            this.src = 'http://i.imgur.com/Rfj0a80.png';

            $('.omg').append('<img class="demo-hadouken" src="http://i.imgur.com/oTyQRvX.gif">');

            $('.demo-hadouken').animate({
                "margin-left": "600px"
            }, 1000, 'swing', function() {
                this.remove();
            });
        });

        $('.omg img').mouseup(function(){this.src = 'http://i.imgur.com/90Mmdcm.png';});
    });
</script>