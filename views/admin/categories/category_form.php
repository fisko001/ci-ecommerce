<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<script type="text/javascript">
function areyousure()
{
	return confirm('Are you sure to delete it?');
}
</script>

<div class="pageheader">
   
	 <div class="pageicon"><span class="iconfa-pencil"></span></div>
	<div class="pagetitle">
		<h5>Category</h5>
		<h1>Categories Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
	<?php 
        if($errors[0]!="") {  ?>
            <div class="alert alert-error">
                <p><strong>ERRORS: </strong>
                        <?php foreach($errors as $error) echo $error; ?>
                </p>
            </div>
      <?php }  ?>
            
<div class="widgetbox box-inverse">
	<h4 class="widgettitle">Category Form</h4>
	<div class="widgetcontent nopadding">
		<form class="stdform stdform2"  action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<p>
					<label for="name">Name</label>				
					<span class="field"><?php
					$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'span5');
					echo form_input($data);
					?></span>
				   
				</p>
				
				<p>
				   <label for="name">Description</label>	
					<span class="field">
					<?php
					$data	= array('name'=>'description', 'class'=>'span5', 'value'=>set_value('description', $description));
					echo form_textarea($data);
					?>
					</span>
				</p>
				
				<p>
				   <label for="slug">Slug</label>
					<span class="field"><?php
					$data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'span5');
					echo form_input($data);
					?>
					</span>
				</p>
				
				<p>
					<label for="sequence">Sequence </label>
					<span class="field">			
					
					<?php
					$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span5');
					echo form_input($data);
					?></span>
				</p>
				
				<p>
					<label for="slug">Parent</label>
					<span class="field">	
					
					<?php
					/* 
					$data	= array(0 => 'Top Level Category');
					foreach($categories as $parent)
					{
						if($parent->id != $id)
						{
							$data[$parent->id] = $parent->name;
						}
					}
					echo form_dropdown('parent_id', $data, $parent_id);
					*/
	
					function list_categories($cats, $product_categories, $sub='',$parent_id='') {
		
							 foreach ($cats as $cat):?>
							 <option class="span2" value="<?php echo $cat['category']->id;?>" <?php if($parent_id == $cat['category']->id){ echo "selected"; }?>><?php echo  $sub.$cat['category']->name; ?></option>
							 <?php
							 if (sizeof($cat['children']) > 0)
							 {
									 $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
									 $sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
									 list_categories($cat['children'], $product_categories, $sub2, $parent_id);
							 }
							 endforeach;
					 }

					 if(!empty($categories))
					 {
							 echo '<select name="parent_id" style="height:38px">';
							 if($parent_id == 0){
							 	echo '<option value="0" selected>Top Level Category</option>';
							 }else{
							 	echo '<option value="0">Top Level Category</option>';
							 }
							 list_categories($categories,'','',$parent_id);
							 echo '</select>';
		
					 }
					?></span>
				</p>
				
				<p>
				   <label for="excerpt">Excerpt </label>
					<span class="field">
					
					<?php
					$data	= array('name'=>'excerpt', 'value'=>set_value('excerpt', $excerpt), 'class'=>'span5', 'rows'=>3, 'cols'=>120);
					echo form_textarea($data);
					?>
					</span>
				</p>
				
				<p>
					<label for="image">Image</label>
					<span class="field">
					
					
						<?php echo form_upload(array('name'=>'image'));?>
					
						
					<?php if($id && $image != ''):?>
					
					<div style="text-align:center; padding:5px; border:1px solid #ddd;"><img src="<?php echo base_url('uploads/images/small/'.$image);?>" alt="current"/><br/>Current file</div>
					
					<?php endif;?>
					</span>
				</p>
				
				<p>
				  <label for="seo_title">Seo Title</label>
						<span class="field"><?php
						$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span5');
						echo form_input($data);
						?>
					 </span>
				</p>
				
				<p>
				  <label>Meta</label> 
					<span class="field">
					
					<?php
					$data	= array('rows'=>3, 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span5');
					echo form_textarea($data);
					?>
					 </span>
				</p>
										
				<p class="stdformbutton">
					<button class="btn btn-primary">Submit</button>
					<button type="reset" class="btn">Reset</button>
				</p>
		</form>
	</div><!--widgetcontent-->
</div>
<div class="divider15"></div>
   </div>
</div>

			
<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>
