<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta name="author" content="Rido Saputra" />
        <meta name="copyright" content="Rido Saputra" />
        <meta name="generator" content="uda_rido@yahoo.com" />
        <meta name="robots" content="index, follow" />
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
        <meta http-equiv="Cache-control" content="public" />
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <link rel="shortcut icon" href="<?php echo url('/'); ?>/favicon.ico" type="image/gif" />
        <link rel="icon" href="<?php echo url('/'); ?>/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo url('/'); ?>/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo url('/'); ?>/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" type="text/css" media="all" href=""<?php echo url('/'); ?>/plugin/DataTables-1.10.15/media/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo url('/'); ?>/plugin/DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo url('/'); ?>/plugin/jQuery-File-Upload-9.11.0/css/jquery.fileupload.css" />
        <title>Data Product</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="glyphicon glyphicon-qrcode" ></i> Data Product</h3>
                          </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <button id="tbladd" class="btn btn-info btn-flat" type="button"><i class="glyphicon glyphicon-plus-sign"></i> Add</button>
                                    <button id="tblreload" class="btn btn-warning btn-flat" type="button"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                                </div>
                            </div>
                            <hr />
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-12">
                                    <table id="listtabledata" class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Picture</th>                                                   
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                    </table>                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div id="message_display"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="modal fade" id="modalform">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="frmsavedata" class="form-horizontal" action="<?php echo action('product\ProductController@createUpdate'); ?>" method="POST">
                                    <div class="modal-header">
                                        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Form Product</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="txtname">Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" id="txtid" name="txtid" />
                                                <input type="hidden" id="txtproductpic" name="txtproductpic" />
                                                <input type="text" id="txtname" name="txtname" placeholder="Name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="txtpictemp">Picture</label>
                                            <div class="col-sm-2">                                            
                                                <span id="tblupload" class="btn btn-info fileinput-button">
                                                    <i class="glyphicon glyphicon-send"></i>
                                                    <span>Browse</span>
                                                    <input id="txtpictemp" type="file" name="txtpictemp" />
                                                </span>
                                            </div>
                                            <div class="col-sm-4">
                                                <div id="linkfile"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="txtprice">Price<span class="text-danger">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" id="txtprice" name="txtprice" placeholder="Price" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="message_display_frm" class="col-sm-offset-2 col-sm-10"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Close</button>
                                        <button id="tblsubmit" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-ok-circle"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>  
    <script type="text/javascript" src="<?php echo url('/'); ?>/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/jquery.confirm-master/jquery.confirm.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/jquery-validation-1.15.1/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/jQuery-File-Upload-9.11.0/js/vendor/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/jQuery-File-Upload-9.11.0/js/jquery.iframe-transport.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/jQuery-File-Upload-9.11.0/js/jquery.fileupload.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/'); ?>/plugin/bootstrap-growl-master/jquery.bootstrap-growl.min.js"></script>
    <script language="javascript" type="text/javascript">
        var oTable;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function base_url()
        {
            return "<?php echo url('/'); ?>/";
        }
        function get_token()
        {
            return $('meta[name="csrf-token"]').attr('content');
        }
        function clearimage()
        {
            $("#linkfile").html('');
            $("#txtproductpic").val('');
        }
        function renderfileattach(filename, fileurl)
        {
            $("#txtproductpic").val(filename);
            var detailattach = '<div><a href="javascript:void(0);" onclick="clearimage();return false;">';
            detailattach += '<i class="text-danger glyphicon glyphicon-remove"> </i>';
            detailattach += '</a>';
            detailattach += '<span class="text-primary"><img src="' + fileurl + '" alt="avatar" width="150" /></span></div>';
            $("#linkfile").html(detailattach);
        }
        function editdata(id)
        {
            var dataPost = "id=" + parseInt(id) + "&rnd=" + Math.random() + "&_token=" + get_token();
            var linkpost = "<?php echo action('product\ProductController@getOne'); ?>";
            $.ajax({
                type: "PUT",
                url: linkpost,
                dataType: 'json',
                data: dataPost,
                beforeSend: function() {
                    $("#message_display").html(
                        "<i class='text-info'><img src='<?php echo url('/'); ?>/images/lossading.gif' alt='Loading..' /> Send data to server</i>"
                    ).slideDown(100);
                },
                error: function (xhr, textStatus, errorThrown) {
                    var contentAlert = '<div class="alert alert-danger alert-dismissable">';
                    contentAlert += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
                    contentAlert += '<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4>';
                    contentAlert += '<p>' + textStatus + '</p>';
                    contentAlert += '</div>';
                    $("#message_display").html(contentAlert);
                },
                success: function(data, textStatus){
                    $("#message_display").slideUp(100);
                    if(data['response'] == true)
                    {
                        $("#txtid").val(data['data']['id']);
                        $("#txtname").val(data['data']['name']);
                        $("#txtproductpic").val(data['data']['picture']);
                        $("#txtprice").val(data['data']['price']);
                        if(data['data']["picture"] != "" || data['data']["picture"] != null)
                        {
                            renderfileattach(data['data']["picture"], "<?php echo url("/")."/images/"; ?>" + data['data']["picture"]);
                        }
                        $('#modalform').modal('show');
                    }
                    else
                    {
                       $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4><p>' + data.result['message'] + '</p>', {
                           type: "danger",
                           delay: 3000,
                           allow_dismiss: true
                       });
                    }	
                }
             });
        }
        function hapusdata(id)
        {
            $.confirm({
                title:"Confirm",
                text: "Are you sure want to delete this record ?",
                confirm: function() {   
                    var dataPost = "id[]=" + parseInt(id) + "&rnd=" + Math.random() + "&_token=" + get_token();
                    var linkpost = "<?php echo action('product\ProductController@delete'); ?>";
                    $.ajax({
                        type: "DELETE",
                        url: linkpost,
                        dataType: 'json',
                        data: dataPost,
                        beforeSend: function() {
                            $("#message_display").html(
                                "<i class='text-info'><img src='<?php echo url('/'); ?>/images/lossading.gif' alt='Loading..' /> Send data to server</i>"
                            ).slideDown(100);
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            var contentAlert = '<div class="alert alert-danger alert-dismissable">';
                            contentAlert += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
                            contentAlert += '<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4>';
                            contentAlert += '<p>' + textStatus + '</p>';
                            contentAlert += '</div>';
                            $("#message_display").html(contentAlert);
                        },
                        success: function(data, textStatus){
                            $("#message_display").slideUp(100);
                            if(data['response'] == true)
                            {
                                oTable.ajax.reload();
                               $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Success</strong></h4><p>' + data.result['message'] + '</p>', {
                                   type: "success",
                                   delay: 3000,
                                   allow_dismiss: true
                               });                               
                            }
                            else
                            {
                               $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4><p>' + data.result['message'] + '</p>', {
                                   type: "danger",
                                   delay: 3000,
                                   allow_dismiss: true
                               });
                            }	
                        }
                     });
                },
                confirmButton: "Yes",
                cancelButton: "Cancel"
            });
            return false;
        }
        $(document).ready(function(){ 
            $('#modalform').modal('hide');
            $('#txtpictemp').fileupload({
                url: '<?php echo action('product\ProductController@uploadImage'); ?>' + "?rnd=" + Math.random() + "&_token=" + get_token(),
                dataType: 'json',
                formData: {
                    filename : 'txtpictemp'
                },
                beforeSend: function(xhr, data) {
                    $("#message_display_frm").html(
                        "<i class='text-info'><img src='<?php echo url('/'); ?>/images/lossading.gif' alt='Loading..' /> Upload image to server</i>"
                    ).slideDown(100);
                    $("#tblupload").addClass("disabled");
                    $("#tblsubmit").addClass("disabled");
                },
                fail: function(e, data){
                    $("#tblupload").removeClass("disabled");
                    $("#tblsubmit").removeClass("disabled");
                    var contentAlert = '<div class="alert alert-danger alert-dismissable">';
                    contentAlert += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
                    contentAlert += '<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4>';
                    contentAlert += '<p>Fail upload image</p>';
                    contentAlert += '</div>';
                    $("#message_display_frm").html(contentAlert);
                },
                done: function (e, data) {
                    $("#message_display_frm").slideUp(100);
                    $("#tblupload").removeClass("disabled");
                    $("#tblsubmit").removeClass("disabled");
                    if(data.result['response'] == true)
                    {
                        renderfileattach(data.result.data["filename"], data.result.data["full_url"]);
                        $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Success</strong></h4><p>' + data.result['message'] + '</p>', {
                            type: "success",
                            delay: 3000,
                            allow_dismiss: true
                        });
                    }
                    else
                    {
                        $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4><p>' + data.result['message'] + '</p>', {
                            type: "danger",
                            delay: 3000,
                            allow_dismiss: true
                        });
                    }
                }
            });
            oTable = $('#listtabledata').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "bProcessing": true,
              "bServerSide": true,
              "autoWidth": false,
              "sAjaxSource": '<?php echo action('product\ProductController@listData'); ?>' + "?rnd=" + Math.random() + "&_token=" + get_token(), 
              "aoColumns": [ { "sWidth": "20px", "sClass" : "text-right" }, null, { "sClass" : "text-right","sWidth": "150px" }, { "sClass" : "text-center","sWidth": "250px","bSortable": false }, { "sWidth": "60px", "sClass" : "text-center","bSortable": false }]
            });
            $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search...');
            $('.dataTables_length select').addClass('form-control');
            $("#tblreload").click(function(){ 
                oTable.ajax.reload();
                return false;
            });
            $("#tbladd").click(function(){ 
                $("input[type=text], input[type=hidden]").val("");
                document.forms["frmsavedata"].reset();
                clearimage();
                $('#modalform').modal('show');
                return false;
            });
            $('#frmsavedata').validate({
                errorClass: 'help-block animated bounceIn',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group >').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();            
                },
                rules: {
                    'txtname': {
                        required: true
                    },
                    'txtprice': {
                        required: true,
                        number:true
                    }
                },
                submitHandler: function(form) {
                    var dataPost = $('#frmsavedata').serialize() + "&rnd=" + Math.random() + "&_token=" + get_token();
                    $.ajax({
                        type: "POST",
                        url: $('#frmsavedata').attr('action'),
                        dataType: 'json',
                        data: dataPost,
                        beforeSend: function() {
                            $("#message_display_frm").html(
                                "<i class='text-info'><img src='<?php echo url('/'); ?>/images/lossading.gif' alt='Loading..' /> Send data to server</i>"
                            ).slideDown(100);
                            $("#tblsubmit").addClass("disabled");
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            var contentAlert = '<div class="alert alert-danger alert-dismissable">';
                            contentAlert += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
                            contentAlert += '<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4>';
                            contentAlert += '<p>' + textStatus + '</p>';
                            contentAlert += '</div>';
                            $("#message_display_frm").html(contentAlert);
                            $("#tblsubmit").removeClass("disabled");
                        },
                        success: function(data, textStatus){
                            $("#message_display_frm").slideUp(100);
                            $("#tblsubmit").removeClass("disabled");
                             if(data['response'] == true)
                             {
                                clearimage();
                                if($("#txtid").val() !='')
                                {
                                    $('#modalform').modal('hide');
                                }
                                $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Success</strong></h4><p>' + data['message'] + '</p>', {
                                    type: "success",
                                    delay: 3000,
                                    allow_dismiss: true
                                });
                                document.forms["frmsavedata"].reset();
                                oTable.ajax.reload();
                             }
                             else
                             {
                                $.bootstrapGrowl('<h4><strong><i class="glyphicon glyphicon-remove-circle"></i> Fail</strong></h4><p>' + data['message'] + '</p>', {
                                    type: "danger",
                                    delay: 3000,
                                    allow_dismiss: true
                                });
                             }	
                        }
                     });
                    return false;
                }
            });
        });
    </script>
</html>