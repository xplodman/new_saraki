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
<script>
    function check_national_id_1(element) {
        var textvalue = element.value;
        var textLength = textvalue.length;
        if(textLength != 14)
        {
            //red
            element.style.backgroundColor = "#FE7276";
            $('#national_id_check_1').prop('checked', false);
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
                        $('#national_id_check_1').prop('checked', true);
                    }
                    if (response == '1' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_1').prop('checked', false);
                    }
                    if (response == '2' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_1').prop('checked', false);
                    }
                    if (response == '3' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_1').prop('checked', false);
                    }
                    if (response == '4' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_1').prop('checked', false);
                    }
                    if (response == '5' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_1').prop('checked', false);
                    }
                    if (response == '6' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_1').prop('checked', false);
//                        $(':input[type="submit"]').prop('disabled', true);
                    }
                }
            });
        }
    }
</script>
<script>
    function check_national_id_2(element) {
        var textvalue = element.value;
        var textLength = textvalue.length;
        if(textLength != 14)
        {
            //red
            element.style.backgroundColor = "#FE7276";
            $('#national_id_check_2').prop('checked', false);
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
                        $('#national_id_check_2').prop('checked', true);
                    }
                    if (response == '1' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_2').prop('checked', false);
                    }
                    if (response == '2' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_2').prop('checked', false);
                    }
                    if (response == '3' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_2').prop('checked', false);
                    }
                    if (response == '4' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_2').prop('checked', false);
                    }
                    if (response == '5' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_2').prop('checked', false);
                    }
                    if (response == '6' ) {
                        national_id_state = false;
                        element.style.backgroundColor = "#FE7276";
                        $('#national_id_check_2').prop('checked', false);
//                        $(':input[type="submit"]').prop('disabled', true);
                    }
                }
            });
        }
    }
</script>
<script>
    $(".select2").select2();
    $(".bootstrapDualListbox").bootstrapDualListbox();
</script>
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#datatable tfoot th').not('.unsearchable').each( function () {
            var title = $(this).text();
            $(this).html( '<input class="col-lg-12" type="text" placeholder="'+title+'" />' );
        } );

        // DataTable
        var table = $('#datatable').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );
</script>
<script>
    // Date Picker
    jQuery('.date_autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'd-m-yy'
    });
</script>
<?php
mysqli_close($sqlcon);
?>