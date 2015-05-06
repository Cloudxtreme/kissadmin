<?php $this->title = _('Library') ?>
<?php $this->inc('header') ?>
<script src="x/js-dataTables"></script>
<script>
$(document).ready(function() {
    $('#files').dataTable( {
		"language": {
            "lengthMenu": "<?= _('Display _MENU_ records per page') ?>",
            "zeroRecords": "<?= _('Nothing found - sorry') ?>",
            "info": "<?= _('Showing page _PAGE_ of _PAGES_') ?>",
            "infoEmpty": "<?= _('No records available') ?>",
            "infoFiltered": "<?= _('(filtered from _MAX_ total records)') ?>",
			"paginate": {
				"previous": "<?= _('Previous') ?>",
				"next": "<?= _('Next') ?>"
			}
        }
    });
});
</script>
<h3><?= _('Library') ?></h3>
<div id="library" class="block">
	<h1><?= _('File Manager') ?> <a class="button" href="library/upload"><?= _('Upload File'); ?></a></h1>
	<form name="files">
	<table id="files" class="u-full-width">
	<thead>
		<tr>
			<th class="ch"><input type="checkbox" name="all" id="checkAll" /></th>
			<th class="name"><?= _('Name') ?></th>
			<th class="path"><?= _('Path') ?></th>
			<th class="upl"><?= _('Uploader') ?></th>
		</tr>
	</thead>
	<tbody>			
	<?php foreach ($this->data as $row): ?>
		<?= ($row['deleted'] == 1 ? '<tr class="bg-warning">' : '<tr>'); ?>
			<td class="ch"><input type="checkbox" name="select[]" value="<?= $row['id'] ?>"/></td>
			<td class="name"><a href="admin/file/<?= $row['uniqid'] ?>"><?= $row['uniqid'] ?></a></td>
			<td class="path"><?= $row['path'] ?></td>
			<td class="upl"><a href="admin/user/<?= $row['uploader'] ?>"><?= \Kiss\User\Helper::user($row['uploader'])['username'] ?></a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</form>
	<div class="u-cf"></div>
</div>
<?php $this->inc('footer') ?>