
<html><head><link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></head>
<body>

<div class="panel panel-default ">
    <div class="panel-heading">Posts </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="30%">Title</th>
                    <th width="65%">Content</th>
                </tr>
            </thead>
            <tbody id="userData">
                <?php if(!empty($posts)): foreach($posts as $post): ?>
                <tr>
                    <td><?php echo '#'.$post['id']; ?></td>
                    <td><?php echo $post['title']; ?></td>
                    <td><?php echo (strlen($post['content'])>150)?substr($post['content'],0,150).'...':$post['content']; ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="3">Post(s) not found......</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- render pagination links -->
<ul class="pagination pull-right">
    <?php echo $this->pagination->create_links(); ?>
</ul>
	
</body>
</html>