<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-comments-alt"></span></div>
	<div class="pagetitle">
		<h5>More than just talk</h5>
		<h1>Topic Discussion</h1>
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
	
			<?php echo (count($topics) < 1)?'No topics found on this ticket.':''?>
			
			<?php 
				$signature = "Rudra S. Shrestha  | Tech Department";
				foreach ($topics as $topic):
						$customer = ucfirst($topic->firstname). " ".ucfirst($topic->lastname);					
						$priority = $topic->priority;
						$status = $topic->status;
						$category = $topic->category;
						$date_opened = $topic->date_opened;
						$support_ticket_id = $topic->support_ticket_id;
			 	endforeach;?>
			<div class="row-fluid">
			<div class="span9">
			  <h2 class="topictitle"><?=$category;?></h2>
				  
				  
            	<div class="topicpanel">
                <div class="author-thumb">
                      <img src="<?php echo base_url('assets/shamcey/images/photos/thumb1.png'); ?>" alt="" />
                </div><!--author-thumb-->
                   
				        
                <div class="topic-content">
                    <h5><a href="#"><strong><?=$customer;?></strong></a></h5>
                    <p><table width="720" class="fg">          
					  <tr>
						<td width="140"><b>Ticket ID:</b> <?php echo $support_ticket_id ?></td>
						<td width="272"><b>Date Opened:</b> <?php echo $date_opened ?></td>
						<td width="292"><b>Status:</b> <?php switch ($status) {
							 case '1' : echo 'Open';
										break;
							 case '0' : echo 'Closed';
										break;
							 
						   } ?></td>
					  </tr>
					</table></p>
					
                </div><!--topic-content-->
            </div><!--topicpanel-->
			
			
			<h3 class="widgettitle">Replies</h3>
            <br />
            <ul class="comments">
				<?php foreach ($topics as $frow):						
						$item = nl2br($frow->item);
						$support_type_categories_id  = $frow->support_type_categories_id;
						$priority = $frow->priority;
						$support_ticket_item_id = $frow->support_ticket_item_id;
						$user_id = $frow->user_id;
						$backend_reply = $frow->backend_reply;
						$date_openedList = $frow->date_opened;
						if($backend_reply == "1"){
							$customerList = ucfirst($frow->firstname). " ".ucfirst($frow->lastname);
						}else{
							$customerList = "Admin";
						}
						
						$this->load->model('ticket_model');
						$ticket_item = $this->ticket_model->get_supportticket_item($support_ticket_item_id);       
						
				?>
                    <li>
                        <a class="authorimg" href="#">  <img src="<?php echo base_url('assets/shamcey/images/photos/thumb1.png'); ?>" alt="" /></a> 
                        <div class="comment">
                            <div class="commentauthor">
                            <strong><?=$customerList;?></strong> <span class="commenttime"><?=$ticket_item->added_on;?></span></div>
                            <p class="commentbody"><?=$item;?></p>
                            
                        </div>                        
                    </li>
					<?php endforeach;?>
                   
            </ul>
			
			 <br /><br /><br />
                    
            <h4 class="widgettitle">Post a New Reply</h4>
            <div class="replypanel">
                <div class="author-thumb">
                    <img src="<?php echo base_url('assets/shamcey/images/photos/thumb1.png'); ?>" alt="" />
                </div><!--author-thumb-->
                        
                <div class="topic-content">
				<form  action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <h5><a href="#"><strong>Admin : Rudra S. Shrestha</strong></a></h5>
                    <p><textarea name="message"><?php echo htmlspecialchars("\r\n\r\n\r\nRegards\n$signature") ?></textarea></p>
                    <small>Did you know? You can highlight your code samples using the &lt;code&gt; &amp; &lt;/code&gt; tags. Many languages are supported like &lt;javascript&gt;, &lt;xml&gt;, &lt;html&gt;, &lt;ruby&gt;, &lt;php&gt;, &lt;python&gt;...</small>
					<br /><br />
					  
					  <?php
						$data	= array('name'=>'close', 'value'=>1);
						echo form_checkbox($data).' Close Ticket'; ?> 
					&nbsp;&nbsp;
					<select name="priority">
                            <option value="<?php echo $priority ?>"><?php
                            switch ($priority) {
                              case '1' : echo 'Low';
                                         break;
                              case '2' : echo 'Normal';
                                         break;
                              case '3' : echo 'Urgent';
                                         break;
                              case '4' : echo 'Emergency';
                                         break;
                            } ?></option>
                            <option value="1">Low</option>
                            <option value="2">Normal</option>
                            <option value="3">Urgent</option>
                            <option value="4">Emergency</option>
                        </select>
                    <br /><br />
					
                    <button class="btn btn-success">Reply</button>
					</form>
                </div><!--topic-content-->
            </div><!--replypanel-->
                    
				 </div><!--span9-->	
					 <div class="span3">
                    <div class="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Discussion Rules</h4>
                        <div class="divider15"></div>
                        <p>If one logged user replies the post, his/her user id is saved on the reply post. If you think, you aren't the right user to make a reply - just log out.</p>
                    </div>
                    
                    <br />
                            
                    <h3 class="subtitle2">Categories</h3>
                    <ul class="sidebarlist">
					<?php 
					foreach ($category_list as $cat):?>					
                        <li><i class="iconfa-angle-right"></i> <a href="<?=site_url('admin/tickets/index/'.$cat->support_ticket_category_id);?>"><?=$cat->category;?><span>21</span></a></li>
					<?php endforeach;?>

                    </ul>
                               
                </div><!--span3-->
			</div><!--row-fluid-->
            </div><!--widgetcontent-->
</div>
<div class="divider15"></div>
   </div>
</div>


