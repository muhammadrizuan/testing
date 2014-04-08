<html>

<head>
	<title>List of Category</title>
</head>
<body>
<style>
.footer
{
position: fixed;
bottom: 0;
width:30%;
border: 1px solid red;
}
</style>


	<table BORDER="5">
		<tr>
			<td>Category</td>
			<td>Books</td>
		</tr>
		<tr>
			<td>
				<table>
				<?php
					foreach ($result as $item)
					{
						?><tr>
						<td valign="top"><a href = "<?php echo base_url('index.php/welcome/mytest/'.$item['category_id']); ?>"><?php echo $item['name']; ?></a></td>
						</tr><?php
					}
	
				?>
				</table>
			</td>
			<td>
				<table>
				<tr>
					<td>
						Notification: <?php echo $update_result; ?>
					</td>
				</tr>
					<tr>
					<?php echo validation_errors(); ?>
						<td>
						<table border="1"> 
							<tr>
								<td>book id</td>
								<td>title</td>
								<td>synopsis</td>
								<td>bisac code</td>
								<td>Select Category</td>
								<td>Action</td>
							</tr>
							<?php echo form_open('welcome/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>
							<?php
								foreach ($book as $object) 
								{ 
									$current_category_bisac = substr($category_bisac,0,3).'<br />';
									$book_bisac = substr($object['bisac_code'],0,3).'<br />';
								
									// echo 'bisac code'. $object['bisac_code'].'<br />'; 
									//echo 'category bisac'. $category_bisac.'<br />';
								  
									if( $current_category_bisac ==  $book_bisac)
									{
										$is_ok = TRUE;
									}else{
										$is_ok = FALSE;
									}
						
									?>
										<tr <?php if(!$is_ok){ echo 'style="background:red;"';}?>> 
									
											<td><img src="http://images.e-sentral.com/<?php echo $object['s3_cover']; ?>-small.jpg"/>
											<td><?php echo $object ['title']; ?></td>
											<td><?php echo $object ['synopsis']; ?></td>
											<td>
												Category Bisac: <?php echo $category_bisac; ?>
												<input type="text" name="bisac[<?php echo $object['book_id']; ?>]" value="<?php echo $object ['bisac_code']; ?>" size="50" />
											</td>
											<td>
											
												<select name="category[<?php echo $object['book_id']; ?>]">
													<?php
													foreach ($result as $item)
													{
														?><option  value="<?php echo $item['category_id'] ?>"><?php echo $item['name']; ?></option><?php
													} ?>
												</select>
											</td>
								
										</tr>
										
									<?php
								}
							?>
							<div class="footer">
								<input  type="submit" value="Submit" />
							</div>
							</form>
						</table>							
						</td>
					 </tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>