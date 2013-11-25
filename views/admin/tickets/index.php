<?php defined('BASEPATH') or die('No direct Script Access'); ?>

<div class="pageheader">

	<?php echo form_open('admin/tickets/index', 'class="searchbar" style="float:right"');?>
             <?php

             function list_categories($cats) {

                     foreach ($cats as $cat):?>
                     <option class="span2" value="<?php echo $cat->support_ticket_category_id;?>" <?php if(isset($_POST["support_ticket_category_id"])){ if($cat->support_ticket_category_id == $_POST["support_ticket_category_id"]){ echo "selected";} }?>><?php echo $cat->category; ?></option>
                     <?php                     
                     endforeach;
             }

             if(!empty($category_list))
             {
                     echo '<select name="support_ticket_category_id" style="height:38px">';
                     echo '<option value="">Filter by Category</option>';
                     list_categories($category_list);
                     echo '</select>';

             }?>

             <input type="text" class="span2" name="term" placeholder="To search type and hit enter..." <?php if(isset($_POST["term"])){?>value="<?=$_POST["term"];?>" <?php }?>/>
             <button class="btn" name="submit" value="search" style="height:35px; ">Search</button>

         </form>
   
	<div class="pageicon"><span class="iconfa-table"></span></div>
	<div class="pagetitle">
		<h5>Help</h5>
		<h1>Support Tickets Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
<div class="maincontentinner">

    
    
<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_ticket');?>');
}
</script>


<table class="table table-striped">
	<thead>
		<tr style="color:#fff">
			
			<?php
			if($by=='ASC')
			{
				$by='DESC';
			}
			else
			{
				$by='ASC';
			}
			?>
			
			<th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/support_ticket_id/');?>/<?php echo ($field == 'support_ticket_id')?$by:'';?>">ID
				<?php if($field == 'support_ticket_id'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?> </a></th>
				
			<th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/status/');?>/<?php echo ($field == 'status')?$by:'';?>">Status
				<?php if($field == 'status'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?> </a></th>
			
			<th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/priority/');?>/<?php echo ($field == 'priority')?$by:'';?>">Priority
				<?php if($field == 'priority'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
			
			<th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/firstname/');?>/<?php echo ($field == 'firstname')?$by:'';?>">Customer
				<?php if($field == 'firstname'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
			
            <th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/category/');?>/<?php echo ($field == 'category')?$by:'';?>">category
				<?php if($field == 'category'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
				
				
			 <th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/date_opened/');?>/<?php echo ($field == 'date_opened')?$by:'';?>">Created On
				<?php if($field == 'date_opened'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
			
			 <th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/date_closed/');?>/<?php echo ($field == 'date_closed')?$by:'';?>">Closed On
				<?php if($field == 'date_closed'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
			
			<th><a style="color:#fff" href="<?php echo site_url('admin/tickets/index/support_type_categories_id/');?>/<?php echo ($field == 'support_type_categories_id')?$by:'';?>">Group
				<?php if($field == 'support_type_categories_id'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
					
			<th></th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$page_links	= $this->pagination->create_links();
		
		if($page_links != ''):?>
		<tr><td colspan="9" style="text-align:center"><?php echo $page_links;?></td></tr>
		<?php endif;?>
		<?php echo (count($tickets) < 1)?'<tr><td style="text-align:center;" colspan="6">'.lang('no_customer_tickets').'</td></tr>':''?>
<?php foreach ($tickets as $ticket):?>
		<tr <?php if($ticket->status == 0){?>style="font-style:italic"<?php }?>>
			<td style="width:16px;"><?php echo  $ticket->support_ticket_id; ?></td>
			<td>			
				<?php if($ticket->status == 1)
				{
					echo 'Open';
				}
				else
				{
					echo 'Closed';
				}
				?></td>
			<td class="gc_cell_left"><?php 
			 switch ($ticket->priority) {
                 case '1' : echo 'Low';
                            break;
                 case '2' : echo 'Normal';
                            break;
                 case '3' : echo 'Urgent';
                            break;
                 case '4' : echo 'Emergency';
                            break;
               }
			?></td>
			<td><a href="<?=site_url("admin/customers/form/".$ticket->username);?>" target="_blank"><?php echo ucfirst($ticket->firstname). " ".ucfirst($ticket->lastname); ?></a> (<?=$ticket->email;?>)</td>
            <td class="gc_cell_left"><?php echo  $ticket->category; ?></td>
			<td class="gc_cell_left"><?php echo $ticket->date_opened; ?></td>
			<td class="gc_cell_left"><?php echo $ticket->date_closed; ?></td>
			<td class="gc_cell_left"><?php echo $ticket->support_type_categories_name; ?></td>
			
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn" href="<?php echo site_url('admin/tickets/form/'.$ticket->support_ticket_id); ?>" title="View Support Tickets"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo site_url('admin/tickets/delete/'.$ticket->support_ticket_id); ?>" onclick="return areyousure();" title="Delete Ticket"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
<?php endforeach;
		if($page_links != ''):?>
		<tr><td colspan="9" style="text-align:center"><?php echo $page_links;?></td></tr>
		<?php endif;?>
	</tbody>
</table>

<div class="divider15"></div>
</div>
</div>


