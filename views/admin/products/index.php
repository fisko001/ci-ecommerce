<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<?php 

//set "code" for searches
if(!$code)
{
	$code = '';
}
else
{
	$code = '/'.$code;
}
function sort_url($lang, $by, $sort, $sorder, $code, $admin_folder ="admin")
{
	if ($sort == $by)
	{
		if ($sorder == 'asc')
		{
			$sort	= 'desc';
			$icon	= ' <i class="icon-chevron-up"></i>';
		}
		else
		{
			$sort	= 'asc';
			$icon	= ' <i class="icon-chevron-down"></i>';
		}
	}
	else
	{
		$sort	= 'asc';
		$icon	= '';
	}
		

	$return = site_url($admin_folder.'/products/index/'.$by.'/'.$sort.'/'.$code);
	echo '<a href="'.$return.'" style="color:#fff">'.$lang.$icon.'</a>';
}

?>

<script type="text/javascript">
function areyousure()
{
	return confirm('Are you sure you want to delete this product?');
}
</script>
<style type="text/css">
	.pagination {
		margin:0px;
		margin-top:-3px;
	}
</style>

<div class="pageheader">
        <?php echo form_open('admin/products/index', 'class="searchbar" style="float:right"');?>
             <?php

             function list_categories($cats, $product_categories, $sub='') {

                     foreach ($cats as $cat):?>
                     <option class="span2" value="<?php echo $cat['category']->id;?>"><?php echo  $sub.$cat['category']->name; ?></option>
                     <?php
                     if (sizeof($cat['children']) > 0)
                     {
                             $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
                             $sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
                             list_categories($cat['children'], $product_categories, $sub2);
                     }
                     endforeach;
             }

             if(!empty($categories))
             {
                     echo '<select name="category_id" style="height:38px">';
                     echo '<option value="">Filter by Category</option>';
                     list_categories($categories);
                     echo '</select>';

             }?>

             <input type="text" class="span2" name="term" placeholder="To search type and hit enter..." />
             <button class="btn" name="submit" value="search" style="height:35px; ">Search</button>

         </form>
     <div class="pageicon"><span class="iconfa-table"></span></div>
     <div class="pagetitle">
             <h5>Catalog</h5>
             <h1>Products  Management</h1>
     </div>
</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">
        
        
	<?php
	//lets have the flashdata overright "$message" if it exists
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	
	if(function_exists('validation_errors') && validation_errors() != '')
	{
		$error	= validation_errors();
	}
	?>
	
	
	
	<?php if (!empty($message)): ?>
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $message; ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($error)): ?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $error; ?>
		</div>
	<?php endif; ?>
    	
    <?php
    if(!empty($term)):
            $term = json_decode($term);
            if(!empty($term->term) || !empty($term->category_id)):?>
                    <div class="alert alert-info">
                            <?php echo sprintf("Your searched returned %d result(s)", intval($total));?>
                    </div>
            <?php endif;?>
    <?php endif;?>
        
        <div style="text-align:right">
		<a class="btn" href="<?php echo site_url('admin/products/form'); ?>"><i class="icon-plus-sign"></i> Add New Product</a>
	</div>

<div class="row">
	<div class="span12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">
			<div class="span4">
				<?php echo $this->pagination->create_links();?>	&nbsp;
			</div>
			<div class="span8">
				
			</div>
		</div>
	</div>
</div>
<div class="btn-group pull-right">
</div>

    <?php echo form_open('admin/products/bulk_save', array('id'=>'bulk_form'));?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th><?php echo sort_url('sku', 'sku', $order_by, $sort_order, $code, 'admin');?></th>
				<th><?php echo sort_url('name', 'name', $order_by, $sort_order, $code, 'admin');?></th>
				<th><?php echo sort_url('price', 'price', $order_by, $sort_order, $code, 'admin');?></th>
				<th><?php echo sort_url('sale price', 'saleprice', $order_by, $sort_order,'admin');?></th>
				<th><?php echo sort_url('quantity', 'quantity', $order_by, $sort_order, $code, 'admin');?></th>
				<th><?php echo sort_url('enabled', 'enabled', $order_by, $sort_order, $code, 'admin');?></th>
				<th>
					<span class="btn-group pull-right">
						<button class="btn" href="#"><i class="icon-ok"></i> Bulk Save</button>
						
					</span>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php echo (count($products) < 1)?'<tr><td style="text-align:center;" colspan="7">There are currently no products.</td></tr>':''?>
                <?php foreach ($products as $product):?>
			<tr>
				<td><?php echo form_input(array('name'=>'product['.$product->id.'][sku]','value'=>form_decode($product->sku), 'class'=>'span1'));?></td>
				<td><?php echo form_input(array('name'=>'product['.$product->id.'][name]','value'=>form_decode($product->name), 'class'=>'span2'));?></td>
				<td><?php echo form_input(array('name'=>'product['.$product->id.'][price]', 'value'=>set_value('price', $product->price), 'class'=>'span1'));?></td>
				<td><?php echo form_input(array('name'=>'product['.$product->id.'][saleprice]', 'value'=>set_value('saleprice', $product->saleprice), 'class'=>'span1'));?></td>
				<td><?php echo ((bool)$product->track_stock)?form_input(array('name'=>'product['.$product->id.'][quantity]', 'value'=>set_value('quantity', $product->quantity), 'class'=>'span1')):'N/A';?></td>
				<td>
					<?php
					 	$options = array(
			                  '1'	=> "Enabled",
			                  '0'	=> "Disabled"
			                );

						echo form_dropdown('product['.$product->id.'][enabled]', $options, set_value('enabled',$product->enabled), 'class="span2"');
					?>
				</td>
				<td>
					<span class="btn-group pull-right">
						<a class="btn" href="<?php echo  site_url('admin/products/form/'.$product->id);?>" title="Edit"><i class="icon-pencil"></i></a>
						<a class="btn" href="<?php echo  site_url('admin/products/form/'.$product->id.'/1');?>" title="Copy"><i class="icon-share-alt"></i></a>
						<a class="btn btn-danger" href="<?php echo  site_url('admin/products/delete/'.$product->id);?>" onclick="return areyousure();" title="Delete"><i class="icon-trash icon-white"></i></a>
					</span>
				</td>
			</tr>
                <?php endforeach; ?>
		</tbody>
	</table>
    </form>
    <div class="divider15"></div>
   </div>
</div>

	
