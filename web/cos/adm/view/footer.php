<?php
//***********************************************************************************
//*                             VIEW/FOOTER.PHP
//*                         Footer for all pages
//***********************************************************************************
?>
    <!-- END OF MAIN CONTENT -->
    <footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        
        <?php if($datatables): ?>
        <!-- Data Tables -->
        <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                $('table.data-table').dataTable();
        });
        </script>
        <?php endif; ?>

    </footer>
    </body>
</html>