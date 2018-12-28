<table class="table table-responsive hidden" id="testtable1">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php  $a=1; foreach ($users as $u){ ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo $u['mm_user_full_name'];?></td>
            <td><?php echo $u['mm_user_email']; ?></td>
        </tr>
        <?php $a++; } ?>
    </tbody>
</table>
