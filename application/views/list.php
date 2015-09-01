<?php if (isSet($msg)) { ?>
<br/><br/>
<b>
<?php echo $msg; ?>
</b>
<br/><br/>
<?php } ?>
<a href="#" id="create_contact">Create a contact</a>
<br/><br/>
<form method="get">
Contacts per page 
<select name="cpp">
	<option<?php echo $per_page == 1 ? ' selected' : ''; ?>>1</option>
	<option<?php echo $per_page == 5 ? ' selected' : ''; ?>>5</option>
	<option<?php echo $per_page == 10 ? ' selected' : ''; ?>>10</option>
	<option<?php echo $per_page == 20 ? ' selected' : ''; ?>>20</option>
	<option<?php echo $per_page == 25 ? ' selected' : ''; ?>>25</option>
</select>
<br/><br/>
Sort by
<select name="sort">
	<option value="null"></option>
	<option value="1"<?php echo $order_view == 1 ? ' selected' : ''; ?>>Last Name</option>
</select>
<br/><br/>
Filter Last Name
<input type="text" name="ln_filter" value="<?php echo isSet($filter) ? $filter : ''; ?>">
<br/>
<input type="submit" value="Submit">
</form>
<br/><br/>
<table>
	<tr>
		<th>First name</th>
		<th>Last name</th>
		<th>Phone number</th>
		<th>Email</th>
		<th>Address</th>
		<th>City</th>
		<th>Zip</th>
		<th>Is Friend</th>
		<th>Action</th>
	</tr>
	<?php 
	if (isSet($contacts)) {
		foreach($contacts as $c) { ?>
		<tr>
			<td><?php echo $c['c_first_name']; ?></td>
			<td><?php echo $c['c_last_name']; ?></td>
			<td><?php echo $c['c_phone']; ?></td>
			<td><?php echo $c['c_email']; ?></td>
			<td><?php echo $c['c_adress']; ?></td>
			<td><?php echo $c['c_city']; ?></td>
			<td><?php echo $c['c_zip']; ?></td>
			<td><?php echo $c['c_friend'] == 1 ? 'YES' : 'NO'; ?></td>
			<td>
				<a href="<?php echo url::site('contacts/get/') . '?id=' . $c['c_id'];?>" class="edit">Edit</a>
				<a href="<?php echo url::site('contacts/delete/') . URL::query(array('id' => $c['c_id']));?>" class="delete">Delete</a>
			</td>
		</tr>
	<?php }
	}	?>
</table>
<?php echo $pagination; ?>
<br/><br/>
Total: <?php echo $total; ?>
<br/>
Total Friends: <?php echo $total_friends; ?>
<br/><br/>
<a href="<?php echo url::site('contacts/delete_all/') . URL::query();?>" class="delete">Delete all</a>
<div id="contact_cover" style="position: fixed; top: 00px; left: 00px; width: 100%; height: 100%; background: green; display: none;">
<div id="contact_info" style="position: fixed; top: 10px; left: 10px; width: 300px; background: red; display: none;">
	<div id="ajax-msg" style="font-wight: bold; text-align: center"></div>
	<form method='POST' action="<?php echo url::site('contacts/insert/'); ?>" id="ajax_submit">
		<input type="hidden" name="id"/>
		<table>
			<tr>
				<th>First name</th>
				<td>
					<input type="text" name="first_name"/>
				</td>
			</tr>
			<tr>
				<th>Last name</th>
				<td>
					<input type="text" name="last_name"/>
				</td>
			</tr>
			<tr>
				<th>Phone number</th>
				<td>
					<input type="text" name="phone"/>
				</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>
					<input type="text" name="email"/>
				</td>
			</tr>
			<tr>
				<th>Address</th>
				<td>
					<input type="text" name="address"/>
				</td>
			</tr>
			<tr>
				<th>City</th>
				<td>
					<input type="text" name="city"/>
				</td>
			</tr>
			<tr>
				<th>Zip</th>
				<td>
					<input type="text" name="zip"/>
				</td>
			</tr>
			<tr>
				<th>Is Friend</th>
				<td>
					<select name="is_friend">
						<option value="0">NO</option>
						<option value="1">YES</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Action</th>
				<td>
					<input type="submit" value="submit">
					<input type="button" value="close" id="close">
				</td>
			</tr>
		</table>
	</form>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://malsup.github.com/min/jquery.form.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.delete').click(function() {
			if (confirm('Are you sure?')) {
				window.location = $(this).attr('href') + '&accept=1';
			}
			return false;
		});
		
		$('.edit').click(function() {
			$.getJSON($(this).attr('href'), function(data) {
				$.each(data, function(key, val) {
					switch (key) {
						case 'c_first_name': $('#ajax_submit input[name=first_name]').val(val); break;
						case 'c_last_name': $('#ajax_submit input[name=last_name]').val(val); break;
						case 'c_phone': $('#ajax_submit input[name=phone]').val(val); break;
						case 'c_zip': $('#ajax_submit input[name=zip]').val(val); break;
						case 'c_email': $('#ajax_submit input[name=email]').val(val); break;
						case 'c_city': $('#ajax_submit input[name=city]').val(val); break;
						case 'c_adress': $('#ajax_submit input[name=address]').val(val); break;
						case 'c_friend': $('#ajax_submit select[name=is_friend]').val(val); break;
						case 'c_id': $('#ajax_submit input[name=id]').val(val); break;
					}
				});
				
				$('#contact_info').show();
				$('#contact_cover').show();
			});
			return false;
		});
		
		$('#close').click(function() {
			$('#contact_info').hide();
			$('#contact_cover').hide();
			
			window.location = "<?php echo url::site('contacts') . URL::query(); ?>";
			
			return false;
		});
		
		$('#create_contact').click(function() {
			$('#contact_info input[type=text]').val('');
			$('#contact_info').show();
			$('#contact_cover').show();
			return false;
		});
		
		var options = { 
			target:        '#ajax-msg',   // target element(s) to be updated with server response 
		}; 

		$('#ajax_submit').ajaxForm(options); 
	});
</script>