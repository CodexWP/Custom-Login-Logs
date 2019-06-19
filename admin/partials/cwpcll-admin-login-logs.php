<link rel="stylesheet" type="text/css" href="<?=$dir_url?>css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?=$dir_url?>js/buttons.print.min.js"></script>

<style>
    #tbl-logs {
        border-collapse: collapse;
    }
    #tbl-logs td,  #tbl-logs th {
        border: 1px solid gainsboro;
    }
    .cwpcll{
        padding-right:20px;
    }
    #tbl-logs_filter, #tbl-logs_length{
        margin-bottom: 1em;
        margin-top:1em;
    }
    .tools button, .dt-buttons button, #tbl-logs_filter input{
        padding: 5px 15px;
        margin-bottom:1em;
        margin-right: 1em;
    }
    .dt-buttons{
        width: 50%;
        float: left;
        margin-top: 1em;
    }

</style>
<h2>Login Logs History</h2>
<hr>
<div class="cwpcll">


    <table id="tbl-logs" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>SL</th>
            <th>Email</th>
            <th>IP</th>
            <th>Log Time</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($logs as $log)
        {
            ?>
            <tr>
                <td><?=$log->id?></td><td><?=$log->email?></td><td><?=$log->ip?></td><td><?=$log->created?></td>
            </tr>
            <?php
        }
        ?>

        </tbody>
    </table>

    <div style="clear:both;"></div>
    <!--</br><hr></br>
    <div class="tools">
        <button class="clear-logs">Clear Logs</button>
    </div>-->
</div>


<script type="application/javascript">
    $ = jQuery;
    $(document).ready( function () {
        $('#tbl-logs').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 1, 'desc' ]]
        } );
    } );
</script>