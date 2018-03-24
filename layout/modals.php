<div class="modal inmodal" id="add_possession_record" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">إضافة قيد</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_possession_record.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="example-search-input" class="col-md-1 col-form-label">رقم الحيازة</label>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <input required  type="number" name="possession_number" id="possession_number" class="form-control" placeholder="رقم">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <input required type="number" name="possession_year" id="possession_year" class="form-control" placeholder="سنة">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-md-1 col-form-label">رقم القضية</label>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <input required  type="number" name="case_number" id="case_number" class="form-control" placeholder="رقم">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <input required  type="number" name="case_year" id="case_year" class="form-control" placeholder="سنة">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <select required name="main_ledger" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <option value="" disabled selected>جدول</option>
                                        <?php
                                        $query = "SELECT * FROM main_ledger";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $main_ledger){
                                            ?>
                                            <option value="<?php echo $main_ledger["id"];?>"><?php echo $main_ledger["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <select required name="depart" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <option value="" disabled selected>القسم</option>
                                        <?php
                                        $query = "SELECT * FROM depart";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $depart){
                                            ?>
                                            <option value="<?php echo $depart["id"];?>"><?php echo $depart["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">تاريخ الورود</label>
                                    <input required type="text" name="receive_date" id="receive_date" class="form-control date_autoclose" placeholder="تاريخ الورود">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">موضوع التنازع</label>
                                    <select required name="subject" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <option value="" disabled selected></option>
                                        <?php
                                        $query = "SELECT * FROM subject";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $subject){
                                            ?>
                                            <option value="<?php echo $subject["id"];?>"><?php echo $subject["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group has-danger">
                                    <label class="control-label">أسم العضو المعروض عليه القضية</label>
                                    <select required name="prosecutor" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <option value="" disabled selected></option>
                                        <?php
                                        $query = "SELECT * FROM prosecutor";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $prosecutor){
                                            ?>
                                            <option value="<?php echo $prosecutor["id"];?>"><?php echo $prosecutor["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group has-danger">
                                    <label class="control-label">أسم الشاكي</label>
                                    <input required type="text" name="plaintiff" id="" class="form-control" placeholder="أسم الطرف">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">الرقم القومي</label>
                                    <input required oninvalid="this.setCustomValidity('برجاء إدخال رقم قومي صحيح')" oninput="setCustomValidity('')" type="text" name="plaintiff_id" id="national_id" class="form-control" placeholder="الرقم القومي" onkeypress="return isNumberKey(event)" minlength="14" maxlength="14">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group has-danger">
                                    <label class="control-label">أسم المشكو في حقه</label>
                                    <input required type="text" name="defendant" id="" class="form-control" placeholder="أسم الطرف">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">الرقم القومي</label>
                                    <input required oninvalid="this.setCustomValidity('برجاء إدخال رقم قومي صحيح')" oninput="setCustomValidity('')"type="text" name="defendant_id" id="national_id_2" class="form-control" placeholder="الرقم القومي"  onkeypress="return isNumberKey(event)" minlength="14" maxlength="14">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                    <label class="control-label">تاريخ قرار الإستيفاء</label>
                                    <input type="text" name="completion_send_date" id="receive_date" class="form-control date_autoclose" placeholder="تاريخ قرار الإستيفاء">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label class="control-label">أسم المندوب</label>
                                    <input type="text" name="completion_delegate" id="" class="form-control" placeholder="أسم المندوب">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                    <label class="control-label">تاريخ ورود رد الإستيفاء</label>
                                    <input type="text" name="completion_receive_date" id="receive_date" class="form-control date_autoclose">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group has-success">
                                    <label class="control-label">قرار النيابة</label>
                                    <textarea type="text" name="prosecution_decision" id="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                    <label class="control-label">تاريخ تصدير القضية</label>
                                    <input type="text" name="case_send_date" id="receive_date" class="form-control date_autoclose">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="control-label">رقم الصادر</label>
                                    <input type="text" name="case_send_number" id="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> تسجيل</button>
                            <button class="btn btn-inverse"  type="button" data-dismiss="modal">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
