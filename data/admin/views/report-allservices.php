
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Services Report (Hotel Order) </label>
            </div>
            <div class="ibox-content"> 
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label">Hotel Name</label> <small>( required ) </small>
                        <select name="title" id="" class="form-control m-b">
                            <option value="">-- Select --</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">Date From</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="daterange_in"  id="datetimepicker1" value="" />
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <label class="control-label">Date To</label> <small>( required ) </small>
                         <div class='input-group input-daterange'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                            <input type="text" class="form-control"  name="daterange_out" id="datetimepicker2" value="" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-info pull-right" name="action" value="display" type="submit">Display</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <label> Services Report (Hotel Order) </label>
            </div>
            <div class="ibox-content"> 
                <table class="table table-bordered dynamicDataTables">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Hotel Name</th>
                            <th class="text-center">Guests Name</th>
                            <th class="text-center">Order Name</th>
                            <th class="text-center">No. Of Orders</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Order Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>          
                        <tr class="lists-item">
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <i class="fa fa-pencil fa-2x" data-toggle="tooltip" title="Edit" style="color:green;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-trash fa-2x" data-toggle="tooltip" title="Delete" style="color:#333;"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/checktime.js"></script>
<?php include'views/script-foot.php' ?>