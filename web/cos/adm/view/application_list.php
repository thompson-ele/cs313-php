<?php
//*********************************************************************************
//*                             VIEW/APPLICATION_LIST.PHP
//*                     Allows admin to view all applications
//*********************************************************************************
?>
<main>
    <div class="container">
        
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-graduation-cap fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo getApplications()->rowCount(); ?></div>
                                <div>Submitted Applications</div>
                            </div>
                        </div>
                    </div>
                    <a href="applications.php?id=new">
                        <div class="panel-footer">
                            <span class="pull-left">Add New Application</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div><!--/.col-lg-3-->
            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-pencil-square-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo getApplications(null, 'unapproved')->rowCount(); ?></div>
                                <div>Pending Applications</div>
                            </div>
                        </div>
                    </div>
                    <a href="applications.php?id=approve">
                        <div class="panel-footer">
                            <span class="pull-left">Approve Applications</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div><!--/.col-lg-3-->
            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-print fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo getApplications(null, 'approved')->rowCount(); ?></div>
                                <div>Certificates to Pickup</div>
                            </div>
                        </div>
                    </div>
                    <a href="applications.php?id=pickup">
                        <div class="panel-footer">
                            <span class="pull-left">Pickup Certificates</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div><!--/.col-lg-3-->
            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo getStudents()->rowCount(); ?></div>
                                <div>Students</div>
                            </div>
                        </div>
                    </div>
                    <a href="students.php">
                        <div class="panel-footer">
                            <span class="pull-left">View All Students</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div><!--/.col-lg-3-->
            
        </div><!--/.row-->
        
        <div class="panel panel-default">
            <div class="panel-heading">
                All Applications
            </div><!--/.panel-heading-->
            <div class="panel-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Student ID</th>
                            <th>Certificate Name</th>
                            <th>Date Submitted</th>
                            <th>Approved?</th>
                            <th>Picked Up?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($applications as $application): ?>
                        <tr>
                            <td><?php echo getStudent($application['student_id'])['last_name']; ?></td>
                            <td><?php echo getStudent($application['student_id'])['first_name']; ?></td>
                            <td><?php echo $application['student_id']; ?></td>
                            <td><?php echo getCertificate($application['program_id'])['program_name']; ?></td>
                            <td><?php echo date('m/d/Y', strtotime($application['submit_date'])); ?></td>
                            <td>
                                <?php
                                if($application['approved'] = 'Y') {
                                    echo '<span class="label label-success">Approved</span>';
                                } else {
                                    echo '<span class="label label-danger">Pending Approval</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if(!is_null($application['pickup_date'])) {
                                    echo '<span class="label label-success">Picked Up</span>';
                                } else {
                                    echo '<span class="label label-danger">Not Picked Up</span>';
                                }
                                ?>
                            </td>
                            <td><a class="btn btn-primary" href="applications.php?id=<?php echo $application['application_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                        </tr>    
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!--/.panel-body-->
        </div><!--/.panel panel-default-->

    </div><!--/.container-->
</main>