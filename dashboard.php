<?php
require_once("functions/functions.php");
include ("functions/config.php");
if (!check_session()){
    header ("Location: $serviceurl/?error=1");
    exit;
}
set_lang();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo _("Remote Power Management - dashboard");?></title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom RPM CSS -->
    <link href="css/rpm.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Modal smallScreen-->
<div class="modal fade " id="smallScreen" tabindex="-1" role="dialog" aria-labelledby="smallScreen" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Modal title</h4>

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal mediumScreen-->
<div class="modal fade" id="mediumScreen" tabindex="-1" role="dialog" aria-labelledby="mediumScreen" aria-hidden="true">
    <div class="modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Modal title</h4>

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $serviceurl."/dashboard.php";?>"><?php echo _("Remote Power Management");?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">



                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="settings.php" data-toggle="modal" data-target="#smallScreen"><i class="fa fa-gear fa-fw"></i><?php echo _("Settings");?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i><?php echo _("Logout");?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo $serviceurl."/dashboard.php";?>"><i class="fa fa-dashboard fa-fw"></i><?php echo _("Dashboard");?></a>
                        </li> 
                        
                        
                        <li <?php if (!is_admin()) echo 'class="hidden"';?>>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i><?php echo _("Configuration");?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="add_clients.php" data-toggle="modal" data-target="#smallScreen"><?php echo _("Add clients");?></a>
                                </li>

                                <li>
                                    <a href="add_group.php" data-toggle="modal" data-target="#smallScreen"><?php echo _("Add group");?></a>
                                </li>
                                <li>
                                    <a href="manage_groupmaps.php" data-toggle="modal" data-target="#mediumScreen"><?php echo _("Manage groupmaps");?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-desktop fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="total_clients_info"></div>
                                    <div><?php echo _("Total clients");?></div>
                                </div>
                            </div>
                        </div>
			<a href="#" data-toggle="collapse" data-target="#total_clients">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo _("View Details");?><div id="total_clients" class="collapse text-muted"><small><?php echo _("Number of total managed computers");?></small></div></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right" ></i></span>

				<div class="clearfix"></div>
                            </div>
			</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="total_groups_info"></div>
                                    <div><?php echo _("Total groups");?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#total_groups">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo _("View Details");?><div id="total_groups" class="collapse text-muted"><small><?php echo _("Number of total groups created");?></small></div></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-power-off fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="clients_on_info"></div>
                                    <div><?php echo _("Clients powered on");?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#clients_on">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo _("View Details");?><div id="clients_on" class="collapse text-muted"><small><?php echo _("Number of powered on clients");?></small></div></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-power-off fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="clients_off_info"></div>
                                    <div><?php echo _("Clients powered off");?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#clients_off">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo _("View Details");?><div id="clients_off" class="collapse text-muted"><small><?php echo _("Number of powered off clients");?></small></div></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-8">




                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo _("Client list");?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper" id="client_list">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable1">
                                    <thead>
                                        <tr>
                                            <th><?php echo _("Client name");?></th>
                                            <th><?php echo _("MAC address");?></th>
                                            <th><?php echo _("Group");?></th>
					    <th><input name="select_all" value="1" id="select_all" type="checkbox"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
			    <button type="button" id="power_submit"  class="btn btn-primary center-block"><?php echo _("Power ON/OFF");?></button>
                            </div>


                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->


                    </div>
                    <!-- /.panel -->

                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i><?php echo _(" Notifications Panel");?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
				<?php 
				    $event_array=get_SQL_array("SELECT * FROM eventlog ORDER BY id DESC LIMIT 10");
				    $x=0;
				    while ($event_array[$x]['id']){
					$event_class=$event_array[$x]['type'];
					$event_class=str_replace("LOGIN_SUCCESS", "fa fa-user fa-fw text-success",$event_class);
					$event_class=str_replace("LOGIN_FAILURE", "fa fa-user fa-fw text-danger",$event_class);
					echo '<a href="#" class="list-group-item">
                                        <i class="' . $event_class . '"></i>' . $event_array[$x]['event'] . '
                                	<span class="pull-right text-muted small"><em>' . $event_array[$x]['date'] . '</em>
                                	</span>
	                                </a>';
					++$x;
				    }?>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->



                        
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="js/multiselect.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/datatables-responsive/js/dataTables.responsive.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

<script>
function redraw_info_panels(){
    var db_info = new Array();
    $.get('db_info.php', function(data){
	db_info = data.split('\n');
    $('#total_clients_info').text(db_info[0]);
    $('#total_groups_info').text(db_info[1]);
    $('#clients_on_info').text(db_info[2]);
    $('#clients_off_info').text(db_info[3]);
});
}
</script>
<script>
$(document).ready(function() {
	redraw_info_panels();
	var oTable=$('#dataTable1').DataTable({
            responsive: true,
	    pageLength: 50,
	    destroy: true,
	    "ajax": 'client_table.php',
	    aoColumnDefs : [{
		orderable : false, aTargets : [3]
		}],
	    "language": {
		"emptyTable": "<?php echo _("No data available in table");?>",
		"lengthMenu": "<?php echo _("Show _MENU_ records");?>",
		"search": "<?php echo _("Filter records");?>",
	        "paginate": {
    		"previous": "<?php echo _("Previous");?>",
		"next": "<?php echo _("Next");?>"
		}
	    }
        });
    $("#power_submit").click(function(){
	$.ajax({
    	    url: "pm.php",
    	    type: "post",
    	    data: $('.clientid').serialize(),
    	    success: function(data) {
    	    $('#response').html(data);
	    }
	});
	redraw_info_panels();
	update_datatable1();
    });
});
function delete_client(clientid){
        $.post("delete_clients_do.php",
        {
          clientid: clientid
        });
	redraw_info_panels();
	update_datatable1();
}
function update_datatable1() {
	$('#dataTable1').DataTable().ajax.reload(null, false);
    }
    
    </script>
    <script>
	$("#select_all").click(function(){
	    $('.clientid').not(this).prop('checked', this.checked);
	});
    </script>

<script >
        $(document).on("hidden.bs.modal", function (e) {
            $(e.target).removeData("bs.modal").find(".modal-content").empty();
        });
</script>

</body>

</html>