<html>
<head>
    <title>National Insurance Number Validation with JavaScript</title>
    <meta charset="utf-8">
    <style type="text/css">
        <!--
        body {
            background:#CCCCFF;
        }

        div {
            width: 100%;
            text-align: center;
            margin-top:150px;
        }

        span {
            color: #000099;
            font: 8pt verdana;
            font-weight:bold;
            text-decoration:none;
        }

        input {
            color: #000000;
            background: #F8F8F8;
            border: 1px solid #353535;
            width:250px;
            font: 8pt verdana;
            font-weight:normal;
            text-decoration:none;
            margin-top:5px;
        }
        -->
    </style>
</head>
<body>

<div>
    <span id="status">Please enter a valid National Insurance Number.</span><br>
    <input type="text" id="myTextBox" name="myTextBox" oninput="checkLength(this)">
</div>
<script>
    function checkLength(element) {
        var textvalue = element.value;
        var textLength = textvalue.length;
        if(textLength != 14)
        {
            //red
            element.style.backgroundColor = "#FF0000";
        }
        else
        {
            //green
            if (textvalue == '') {
                national_id_state = false;
                return;
            }

            $.ajax({
                url: 'php/test_check_national_id.php',
                type: 'post',
                data: {
                    'national_id_check' : 1,
                    'national_id' : textvalue,
                },
                success: function(response){
                    if (response == '0' ) {
                        element.style.backgroundColor = "#00FF00";
                    }
                    if (response == '1' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FF0000";
                    }
                    if (response == '2' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FF0000";
                    }
                    if (response == '3' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FF0000";
                    }
                    if (response == '4' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FF0000";
                    }
                    if (response == '5' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FF0000";
                    }
                    if (response == '6' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FF0000";
                    }
                }
            });
        }
    }
</script>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<?php
$arr = get_defined_vars();
print_r($arr);

?>
</body>
</html>