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

            hideAfter: 3500
        });
        <?php
        }
        ?>
    });
</script>