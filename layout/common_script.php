<script>
    $(document).ready(function() {
        <?php
        if (isset($_GET['backresult']))
        {
        $backresult = $_GET['backresult'];
        ?>
        $.toast({
            position: 'top-right',
            <?php
            switch ($backresult) {
                case "0":
                    echo "
                            heading: 'لم تتم العملية بنجاح',
                            loaderBg:'#ff6849',
                            icon: 'error',";
                    break;
                case "1":
                    echo "
                            heading: 'تمت العملية بنجاح',
                            loaderBg:'#ff6849',
                            icon: 'success',";
                    break;
                case "2":
                    echo "
                            heading: 'رقم الحيازة مكرر, برجاء التأكد من الرقم...',
                            loaderBg:'#ff6849',
                            icon: 'info',";
                    break;
                case "3":
                    echo "
                            heading: 'رقم القضية مكرر, برجاء التأكد من الرقم...',
                            loaderBg:'#ff6849',
                            icon: 'info',";
                    break;
            }
            ?>

            hideAfter: 6000
        });
        <?php
        }
        ?>
    });
</script>
<script>
    $('document').ready(function(){
        var username_state = false;
        $('#national_id_2').on('blur', function(){
            var national_id = $('#national_id_2').val();

            if (national_id == '') {
                national_id_state = false;
                return;
            }

            $.ajax({
                url: 'php/check_national_id.php',
                type: 'post',
                data: {
                    'national_id_check' : 1,
                    'national_id' : national_id,
                },
                success: function(response){
                    if (response == 'taken' ) {
                        national_id_state = false;
                        alert("هذا الرقم القومي تم إدخاله مسبقاً  !!!!");
                        $('#national_id_2').val("");
                    }
                }
            });
        });
        $('#national_id').on('blur', function(){
            var national_id = $('#national_id').val();

            if (national_id == '') {
                national_id_state = false;
                return;
            }

            $.ajax({
                url: 'php/check_national_id.php',
                type: 'post',
                data: {
                    'national_id_check' : 1,
                    'national_id' : national_id,
                },
                success: function(response){
                    if (response == 'taken' ) {
                        national_id_state = false;
                        alert("هذا الرقم القومي تم إدخاله مسبقاً  !!!!");
                        $('#national_id').val("");
                    }
                }
            });
        });
    });
</script>
<?php
mysqli_close($con);
?>