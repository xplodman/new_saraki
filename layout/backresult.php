<?php
if (isset($_GET['backresult'])){
    $backresult=$_GET['backresult'];
    if ($backresult ==  "0") {
        ?>
        <script>
            $.toast({
                heading: 'أسم المستخدم أو كلمة المرور خطأ',
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: 'error',
                hideAfter: 3500
            })
        </script>
        <?php
    }elseif ($backresult ==  "7"){
        ?>
        <script>
            $.toast({
                heading: 'برجاء التواصل مع مدير النظام',
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: 'error',
                hideAfter: 3500
            })
        </script>
        <?php
    }
}
?>