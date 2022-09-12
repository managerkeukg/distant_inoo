<?php
class DataTable
{ // actions
  public $action_name="actionsss"; public $action_page="pagesss"; public $action_view="viewsss"; public $action_add="addsss"; public $action_edit="editsss"; public $action_update="updatesss";
  public $action_save="savesss"; public $action_delete="deletesss"; public $action_show="showsss"; public $action_hide="hidesss";
  // -- end actions
  public $data_path=_COMMON_DATA_PATH_;
  private $auto_increment; public $id_parameter="idsss"; public $id_user; public $status_field=""; public $user_field="";
  public $cat;    public $array; public $data_array;  private $table_name; private $fields_array;
  public $text="nostra"; public $tr_hover_color="green"; public $bgcolor="white";
  //pagination block
  public $type_records_per_page="GET"; public $records_per_page_name="rppsss";
  public $records_per_page="20"; public $total_records; public $total_pages; public $current_page; public $start_from_record;
  // end pagination
  public $user_module_permissions=array ("1" => "1"); //echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
  public $headers; public $url;
  public $tr_javascript="";
  public $ORDER_BY_FIELD_NAME="";
 /* public $tr_javascript="
               onmouseover=\"this.style.background='green'; this.style.height=this.offsetHeight*1.5; this.style.border='10'; this.style.borderColor='red';
               \"

			   onmouseout=\"this.style.background='white';  this.style.height=this.offsetHeight/1.5; this.style.border='1'; this.style.borderColor='';
			   \"
               ";
*/
    private function is_int_obligatory ($variable) 
  {
  if (isset($variable) AND !empty($variable)) {
     if  (!empty($variable)) 
     { if(!preg_match("|^[\d]+$|", $variable)) { exit("Недопустимый формат URL-запроса"); } }	
  } else {exit("Недопустимый формат URL-запроса");}	 
  }

  private function is_int_ ($variable) 
  {
  if (isset($variable) AND !empty($variable)) {
     if  (!empty($variable)) 
     { if(!preg_match("|^[\d]+$|", $variable)) { exit("Недопустимый формат URL-запроса"); } }	
  } else {}	 
  }
  
   private function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

public function ORDER_BY_FIELD ($field, $type)
{
	$this->ORDER_BY_FIELD_NAME=" ORDER BY `".$field."` ".$type; ///echo $this->ORDER_BY_FIELD;
}
// functions	of class
  public function query ($table, $and_text=" ")
  { $this->table_name = $table;
    $this->count_table ($table, $and_text);
	$query="SELECT * FROM `".$table."` where 1=1 ".$and_text;
	if (isset($this->status_field) AND !empty($this->status_field)) {$sql_and_status=" AND (`".$this->status_field."`>='1') ";} else {$sql_and_status="";}
	$order_by_text=""; $order_by_text=$this->ORDER_BY_FIELD_NAME;
    $query=$query.$sql_and_status;
	$query=$query.$order_by_text;
	if ($this->records_per_page != 2000) 
		{ $query=$query." LIMIT ".$this->start_from_record.",".$this->records_per_page."";
	}
	else { //$query=$query.$sql_and_status;
	}
    //$query=$query.$sql_and_status." LIMIT ".$this->start_from_record.",".$this->records_per_page."";
	////echo $query;
	$cat = mysql_query($query);
    if($cat) 
         { if (mysql_num_rows($cat)> 0)
		    {  $this->table_info($this->table_name); // gets auto_increment field
			while( $array = mysql_fetch_assoc($cat)) { $this->data_array[]=$array;}  
 			   $this->headers =$this->table_fields ($this->data_array); //echo "<pre>"; print_r($this->headers); echo "</pre>";
			foreach  ($this->headers as $field_name) 
                {$this->fields_array[$field_name]['caption']['show']=$field_name;
				 $this->fields_array[$field_name]['caption']['view']=$field_name;
				 $this->fields_array[$field_name]['caption']['edit']=$field_name;
				 $this->fields_array[$field_name]['caption']['add']=$field_name;
				}		//echo "<pre>"; print_r($this->fields_array); echo "</pre>";	
			} else { //return "0";
			}
  		 }
      else {exit("query!!! ".mysql_error());}
  }
  
  private function table_info ($table)
  { 
    $cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
    if($cat) 
    {
	  if (mysql_num_rows($cat) > 0) {
       while ($row = mysql_fetch_assoc($cat))
		   {
		    $array[$row['Field']]=$row; //$fields[]=$row['Field']; //echo "<pre>"; print_r($row); echo "</pre>";
			if ($row['Extra']=="auto_increment" AND $row['Key']=="PRI") {$this->auto_increment=$row['Field'];}
           } 
       //echo "<pre>"; print_r($array); echo "</pre>";	   
	  }	
    }	  
  }
  
  private function count_table ($table, $and_text=" ")
  { if (isset($_GET[$this->action_page]) AND !empty($_GET[$this->action_page])) 
	{ $this->is_int_ ($_GET[$this->action_page]); $this->current_page=$_GET[$this->action_page]; 
    } else {$this->current_page = "1";}  //echo $this->records_per_page_name;
    if ($this->type_records_per_page=="POST") 
	{
	  if (isset($_POST[$this->records_per_page_name]) AND !empty($_POST[$this->records_per_page_name])) 
	  { $this->is_int_obligatory ($_POST[$this->records_per_page_name]); 
	    $this->records_per_page=$_POST[$this->records_per_page_name];
	  } else {$this->records_per_page="20";}
	}
    if ($this->type_records_per_page=="GET") 
	{
	  if (isset($_GET[$this->records_per_page_name]) AND !empty($_GET[$this->records_per_page_name])) 
	  { $this->is_int_obligatory ($_GET[$this->records_per_page_name]);
		  $this->records_per_page=$_GET[$this->records_per_page_name]; 
	  } else {$this->records_per_page="20";}	
	}
	
	if (isset($this->status_field) AND !empty($this->status_field)) {$sql_and_status=" AND (`".$this->status_field."`>='1') ";} else {$sql_and_status="";}
    $query = "SELECT COUNT(*) FROM `$table` where 1=1 ".$and_text." ".$sql_and_status."";

	require_once _COMMON_DATA_PATH_."classes/ClassPagination.php";
	$pagination= new Pagination; 
	$pagination_data=$pagination-> get_pagination_data ($query, $this->current_page, $this->records_per_page);
    //echo "<pre>"; print_r($pagination_data); echo "</pre>";
	$this->total_records=$pagination_data['total_records']; $this->total_pages=$pagination_data['total_pages']; 
	$this->start_from_record=$pagination_data['start_from_record'];

  }  //end function count_table

   public function url ($url)
  {
    $this->url =$url;
  }
   public function check_url ()
  {
    if (empty($this->url)) {$this->url="?";} else {	}
  }
  
  public function display ($view_type="table")
	{ 
	  if(isset($_GET[$this->action_name]) 
		  AND 
		  ( ($_GET[$this->action_name]==$this->action_add) 
	        OR ($_GET[$this->action_name]==$this->action_view) OR ($_GET[$this->action_name]==$this->action_save) 
            OR ($_GET[$this->action_name]==$this->action_delete) OR ($_GET[$this->action_name]==$this->action_hide)
		    OR ($_GET[$this->action_name]==$this->action_show)  OR ($_GET[$this->action_name]==$this->action_edit)
		    OR ($_GET[$this->action_name]==$this->action_update)
		  ) 
		)
      { 
        if ($_GET[$this->action_name]==$this->action_save) {$this-> save_record ($this->id_user);}
        if ($_GET[$this->action_name]==$this->action_add) {
	        $this-> build_add_form();
		    if(isset($this->user_field) and !empty($this->user_field)) 
			{ //removes field
			 $this-> edit_form_field_delete($this->user_field);
			}
	        
	        $this-> add_form_display();
        }
		else 
		{ if (isset($_GET[$this->id_parameter]) AND !empty($_GET[$this->id_parameter])) 
		  {$this->is_int_obligatory ($_GET[$this->id_parameter]); }
		  else {exit;} 
		  $id = $this->clean($_GET[$this->id_parameter]);
		}

		if ($_GET[$this->action_name]==$this->action_view) {
	        $this-> build_view_record ($id);
	        if(isset($this->user_field) and !empty($this->user_field)) 
			{ //removes field
			 $this-> edit_form_field_delete($this->user_field);
			}
	        $this-> record_view_display ($id);
	    }
		
		if ($_GET[$this->action_name]==$this->action_edit) { 
	        //$datagrid-> edit_record ($id);
	        $this-> build_edit_form ($id);
	        if(isset($this->user_field) and !empty($this->user_field)) 
			{ //removes field
			 $this-> edit_form_field_delete($this->user_field);
			}
            $this-> edit_form_display();
	    }
	    
		if ($_GET[$this->action_name]==$this->action_delete) {$this-> delete_record ($id, $this->status_field);}
        if ($_GET[$this->action_name]==$this->action_hide) {$this-> hide_record ($id, $this->status_field);}
        if ($_GET[$this->action_name]==$this->action_show) {$this-> show_record ($id, $this->status_field);}
	    if ($_GET[$this->action_name]==$this->action_update) {$this-> update_record ($id);}
      }
	  else
	  {
	  //echo "<pre>"; print_r($this->data_array); echo "</pre>";
	  $this->check_url();
      if (!empty($this->data_array))
		{
	  $this->TableView ($view_type, $this->data_array, $this->headers, $this->tr_javascript);
		} else { //echo "Нет записей<br><br>";
		?><a href="<?php echo $this->url."&".$this->action_name."=".$this->action_add;?>" onclick="return confirm('Вы уверены, что хотите Добавить запись?');">
	  Добавить?<img src="<?php echo $this->data_path."images/add.jpg";?>" border="0" ></img></a>
		<?php
		   }
       }
  }
  private function table_fields ($data_array)
  {
    foreach ($data_array as  $array)
    { 
      $table_fields=array_keys($array);
    } 
	foreach ($table_fields as  $array)
    { 
      $new_fields[$array]=$array;
    }
	//echo "<pre>array"; print_r($new_fields); echo "</pre>";
  return $new_fields; 
  }
  
  public function table_field_substing($field, $start, $length)
  {
    foreach ($this->data_array  as $array) 
    {  $array[$field]=mb_substr($array[$field],$start,$length, 'UTF-8');
		$new_array[]=$array;
    }
	$this->data_array=$new_array;
  }

  public $sort_fields;
  public function sort_by($field, $caption)
	  {
  $this->sort_fields[]=array ("field"=>$field, "caption"=>$caption);
  }
  public $sort_by_time;
  public function sort_by_time($field)
	  {
  $this->sort_by_time[]=$field;
  }
  public $data; public $header;
  private function TableView ($view_type, $data, $header, $tr_javascript)
	{ ////echo "<PRE>"; print_r($data); echo "</PRE>";
	  if ($view_type=="table") 
		{
	  ?><DIV > <!-- style="max-width:900;" -->
	  <?php 
		  if (isset($this->sort_fields) AND !empty($this->sort_fields))
		  { echo "<FORM action=\"\" method=\"post\"> Сортировать по <SELECT name=\"order_by\">";
		    foreach ($this->sort_fields as $key=>$array)
		    { if (isset($_POST['order_by']) AND $_POST['order_by']==$array['field']) { $selected= "selected";} else {$selected="";}
		     echo "<OPTION value=\"$array[field]\" $selected  >$array[caption]</OPTION>";
		    }
              echo "</SELECT><BR>";
			  if (isset($_POST['asc_type']) AND $_POST['asc_type']=="ASC") { $asc_checked= "checked";} else {$asc_checked="";}
			  if (isset($_POST['asc_type']) AND $_POST['asc_type']=="DESC") { $desc_checked= "checked";} else {$desc_checked="";}
			  echo "<INPUT type=\"radio\" name=\"asc_type\" value=\"ASC\" $asc_checked ></INPUT>По возрастанию
			  <br><INPUT type=\"radio\" name=\"asc_type\" value=\"DESC\" $desc_checked ></INPUT>По убыванию
			  <BR><INPUT type=\"submit\" value=\"Сортировать\"></INPUT></FORM>";
			  
	      }  else {}
		  
		 // echo "<pre>"; print_r($this->sort_fields); echo "</pre>";
  
 
		  ?>
          <?php  ///echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
				 if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['4']=='4') ) { ?>
		  <a href="<?php echo $this->url."&".$this->action_name."=".$this->action_add;?>" onclick="return confirm('Вы уверены, что хотите Добавить запись?');">
		  Добавить?<img src="<?php echo $this->data_path."images/add.jpg";?>" border="0" ></img></a>
		  <?php } ?>
	  <BR>
	  <TABLE id="my_table"   style="width:100%;" > <!--  align="center" border="0" cellPadding="3" cellSpacing="0" -->
	    <THEAD>
        <TR bgcolor="#023183" align="center" style="color:white" height="35">
	  <?php  //echo "<pre>header"; print_r($header); echo "</pre>"; 
		  foreach ($header as $key=>$value)
		{ //echo $this->status_field;
		  if($value==$this->status_field) {} 
		  else 
		  { if (isset($this->user_field) AND !empty($this->user_field) AND $this->user_field==$value ) 
			   {} else {
			   echo "<TH> $value</TH>";
			   //echo "<TH style=\"font-size:10;\">$value</TH>";   
			   }
		  }
		} 
	  ?>
	  <!-- <TD></TD> --> <!-- for show column -->
	  <!-- <TD>
	  </TD> --> 
	  <TH colspan="3"> <!-- for edit column -->
	     <?php 
		  //echo $this->url."&".$this->action_page."=".$this->current_page; 
	      $url_coded=""; //$url_coded=urlencode("&".$this->action_page);
	      ?>
	       <FORM action="<?php echo $this->url; ?>" method="GET">
	          <?php //echo $this->total_pages;
	          echo "<SELECT name=\"".$this->url."&".$this->records_per_page_name."=".$this->records_per_page."&".$this->action_page."\" onchange=\"this.form.submit()\">"; 
	          for($i=1;$i<=$this->total_pages;$i++)
			  { ?> <OPTION value="<?php echo $i;?>" <?php if (isset($_GET[$this->action_page]) AND $_GET[$this->action_page]==$i ){echo "selected";}?> ><?php echo $i;?></OPTION> <?php }
			  echo "</SELECT>";
			 ?>
		   </FORM>
		 </TH>
	     <TH align="right" width="11">
		   <?php  ///echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
				 if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['4']=='4') ) { ?>
			 <a href="<?php echo $this->url."&".$this->action_name."=".$this->action_add;?>" onclick="return confirm('Вы уверены, что хотите Добавить запись?');"><img src="<?php echo $this->data_path."images/add.jpg";?>" border="0" ></img></a>
           <?php } ?>
		 </TH>
		 </TR>
		 </THEAD>
		 <TBODY>
	  <?php $i="0";
	  foreach ($data as $row)
		{  $i++;  if($i % 2 == 0) {  $bgcolor="silver"; } else {  $bgcolor="white"; }
		  //echo "<pre>Row"; print_r($row); echo "</pre>"; 
		  ?><TR bgcolor="<?php echo $bgcolor; ?>" align="center" style="border:20;" <?php echo $tr_javascript; ?> >
		  <?php
		  foreach ($row as $key=>$columns)
			{ if( $key==$this->status_field) 
			  {}
              else 
			  {  if (isset($this->user_field) AND !empty($this->user_field) AND $this->user_field==$key ) 
					 { }  else {
			      $column_value=substr($columns,0,150); $column_value=$columns; 
			      //<a name="$array['id']"></a>
			      if($key==$this->auto_increment) {$anchor="<a name=\"$column_value\"></a>";} else {$anchor="";}
			      //foreign key
			      if (isset($this->foreign_key_array[$key]) AND !empty($this->foreign_key_array[$key]))
			      {
			       $column_value=$this-> get_foreign_field_value ($column_value, $this->foreign_key_array[$key]['table'], $this->foreign_key_array[$key]['field'], $this->foreign_key_array[$key]['key']);
			      }
			     echo "<TD>".$anchor."<DIV style=\"word-wrap: normal; word-break: break-all; \">".$column_value."</DIV></TD>";
			    } 
			  }
		    }
		  if (isset($this->status_field) AND !empty($this->status_field)) {
		    if ($row[$this->status_field]=='1') {$show=$this->action_hide; $show_image="hide";} 	
		    if ($row[$this->status_field]=='2') {$show=$this->action_show; $show_image="show";} 	
		  }
		     ?> 
			 <TD align="right" width="11">
			   <?php  ///echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
				 if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['2']=='2') ) { ?>
				 	 <a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_view."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo $this->data_path."images/next.png";?>" border="0" alt="Подробнее" ></img></a>
                <?php  }  ?>  
			 </TD>
			 <?php 
			 if (isset($this->status_field) AND !empty($this->status_field)) 
			 {
			   ?>
			   <TD align="right" width="11">
				 <?php  ///echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
				 if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['3']=='3') ) { ?>
				  <a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$show."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo $this->data_path."images/$show_image.gif";?>" border="0" alt="Скрыть" ></img></a>
				 <?php  }  ?>  
			   </TD>
			   <?php
			 } else {echo "<TD></TD>";}
			 ?>
			 <TD align="right" width="11">
			   <?php  ///echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
				 if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['5']=='5') ) { ?>
				 <a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_edit."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo $this->data_path."images/edit.gif";?>" border="0" alt="Редактировать"></img></a>
				<?php  }  ?>
			 </TD>
			 <TD align="right" width="11">
				<?php  ///echo "<pre>USER MODULE PERMISSIONS "; print_r($this->user_module_permissions) ; echo "</pre>";
				 if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['6']=='6') ) { ?>
				 <a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_delete."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $this->data_path."images/delete.gif";?>" border="0" ></img></a>
				<?php  }  ?> 
			 </TD>
			 <?php
		  echo "</TR>";
		}
	  echo "</TBODY></TABLE></DIV>"; 
	  ?>
		<script type="text/javascript">
			fix_header.fix('my_table');
		</script>
	  <?php
		}
		else if ($view_type=="div")
		{ 
           require_once _COMMON_DATA_PATH_."classes/default_div_twig.php";
		   $TableTwig= new TableTwig;
		   $link_view="?".$this->action_name."=".$this->action_view."&".$this->id_parameter."=";
           $link_edit="?".$this->action_name."=".$this->action_edit."&".$this->id_parameter."=";
           $link_delete="?".$this->action_name."=".$this->action_delete."&".$this->id_parameter."=";
           
		   $TableTwig-> view(
			     $array[]=array ('header'=>$header, 
			                     'data'=>$data,
			                     'links'=> array (
			                                 'url'=>1,
			                                 'data_path'=>$this->data_path,
			                                 $this->action_name => $this->action_view,
			                                 'view'=>$link_view,
			                                 'edit'=>$link_edit,
			                                 'delete'=>$link_delete
			                               )
		                        ) 
			                 );

		?>
        
	  <?php 
		  /*echo "<pre> Headers  "; print_r($header); echo "</pre>"; 
		  foreach ($header as $header_columns)
		  { echo "<DIV ><font color=red>$header_columns</font></DIV>";
		  }
		  */
		  /*
	      $i="0";
	      foreach ($data as $row)
			{  $i++;  if($i % 2 == 0) {  $bgcolor="silver"; } else {  $bgcolor="white"; }
			  //echo "<pre>"; print_r($row); echo "</pre>"; 
			  foreach ($row as $key=>$columns)
				{ $column_value=substr($columns,0,150); $column_value=$columns; 
				  echo "<DIV style=\"word-wrap: normal; word-break: break-all; \">$key ".$column_value."</DIV>";
			  }
            } */
		} // end view div  
		?>
		<FORM action="" method="<?php echo $this->type_records_per_page; ?>">
		<DIV style="align:right;">
		Показать по <SELECT id="<?php echo $this->records_per_page_name; ?>" name="<?php echo $this->records_per_page_name; ?>" onchange="this.form.submit();">
		    <OPTION value="2000" <?php if ($this->records_per_page=="2000") {echo "selected";} ?> >2000</OPTION>
			<OPTION value="1000" <?php if ($this->records_per_page=="1000") {echo "selected";} ?> >1000</OPTION>
			<OPTION value="500" <?php if ($this->records_per_page=="500") {echo "selected";} ?> >500</OPTION>
			<OPTION value="200" <?php if ($this->records_per_page=="200") {echo "selected";} ?> >200</OPTION>
			<OPTION value="100" <?php if ($this->records_per_page=="100") {echo "selected";} ?> >100</OPTION>
			<OPTION value="50" <?php if ($this->records_per_page=="50") {echo "selected";} ?> >50</OPTION>
			<OPTION value="30" <?php if ($this->records_per_page=="30") {echo "selected";} ?> >30</OPTION>
			<OPTION value="20" <?php if ($this->records_per_page=="20") {echo "selected";} ?> >20</OPTION>
			<OPTION value="10" <?php if ($this->records_per_page=="10") {echo "selected";} ?> >10</OPTION>
		  </SELECT> записей
		</DIV>  
		</FORM>
		<?php
		//$this->records_per_page=$pnumber; $this->total_records=$total; $this->total_pages=$number; 
		//$this->current_page=$this->current_page; $this->start_from_record=$start;
		///require_once _COMMON_DATA_PATH_."classes/ClassPagination.php";
		$pagination= new Pagination;
        $pagination-> pagination_view($this->current_page, $this->total_pages, $this->total_records, $this->url."&".$this->records_per_page_name."=".$this->records_per_page."&".$this->action_page);
    } //end function TableView


public function column_hide_table ($column_name)
{
  
  if (!empty($this->data_array))
  {  ///echo "<pre>prev"; print_r($this->data_array); echo "</pre>";
	  foreach ($this->data_array as  $array)
    { 
     unset($array[$column_name]);
     $new_array[]=$array;
    } ///echo "<pre>after"; print_r($new_array); echo "</pre>";
  $this->data_array=$new_array;
  ///echo "<pre>headers prev "; print_r($this->headers); echo "</pre>"; 
  unset( $this->headers[$column_name]);
  ///echo "<pre>headers after "; print_r($this->headers); echo "</pre>"; 
  
  }
}
public function column_hide_view ($column_name)
{
}

public function column_hide_add ($column_name)
{
}

public function column_hide_edit ($column_name)
{
}

function addcolumn ($column_name, $value)
{
  foreach ($this->data_array as  $array)
  {
   $array[$column_name]=$value;
   $new_array[]=$array;
  }
  $this->data_array= $new_array;
  $this->headers[$column_name] = $column_name;
}

// column_value("image", '<img src="../../kel_data/images/{{image}}"  width="50">   ');
function column_value ($column_name, $string)
{
   //echo "<br>".$string;
  preg_match_all("/{{(.*?)}}/", $string, $out);
   ///echo "<pre>variables "; print_r($out[1]); echo "</pre>";
    foreach ($out[1] as $variable)
   { $variable=trim($variable);
    $variables[$variable]=$variable;
   }
  ///echo "<pre> Variables "; print_r($variables); echo "</pre>";
  
  foreach ($this->data_array as  $array)
  {
     $new_string=$string;
     foreach ($out[1] as $variable)
   { //$variable=trim($variable);
    $new1_string=str_replace('{{'.$variable.'}}', $array[$variables[$variable]], $new_string);
	$new_string=$new1_string;
	}
  
    $array[$column_name]=$new_string;
   //echo "<pre>"; print_r($array); echo "</pre>"; 
   $new_array[]=$array;
  }
  $this->data_array= $new_array;
}

private $image_fields_array;
// convertcolumn_toimage ("image", "../../kel_data/images/", $width="50");
public function convertcolumn_toimage ($column_name, $path, $width="50")
{
   $this->image_fields_array[$column_name]=array ("path"=>$path, "width"=>$width);
  foreach ($this->data_array as  $array)
  {
   if (file_exists($path.$array[$column_name]) AND !empty($array[$column_name]))
   { $array[$column_name]="<img src=\"".$path.$array[$column_name]."\" width=\"".$width."\"></img>"; 
	   }	
	   else {$array[$column_name]="";}   
   //$array[$column_name]="<img src=$image_source$array[$column_name] width=$width>"; 
   $new_array[]=$array;
  }
  $this->data_array= $new_array;
}

public function column_file ($column_name)
{
 /*
   $this->image_fields_array[$column_name]=array ("path"=>$path, "width"=>$width);
  foreach ($this->data_array as  $array)
  {
   if (file_exists($path.$array[$column_name]) AND !empty($array[$column_name]))
   { $array[$column_name]="<img src=\"".$path.$array[$column_name]."\" width=\"".$width."\"></img>"; 
	   }	
	   else {$array[$column_name]="";}    
   $new_array[]=$array;
  }
  $this->data_array= $new_array;
  */
}

public function convertcolumn_tolink ($column_name, $attributes_array)
{  //echo "<pre> attr"; print_r($attributes_array); echo "</pre>"; exit;  echo "<br>".$array[$column_name];
  if(!empty($this->data_array))
  {
    foreach ($this->data_array as  $array)
    { $link_text="<a "; 
       if (isset($attributes_array) AND (!empty($attributes_array))) 
	       {  $attributes=$attributes_array;
		    if ($attributes_array['href']=="self") {$attributes['href']=$array[$column_name]; }
            foreach($attributes as $attribute => $value) { $link_text=$link_text." ".$attribute."=\"".$value."\"";} }
    $link_text=$link_text." >".$array[$column_name]."</a>";  // ". $javascript."
	$array[$column_name]=$link_text;
    $new_array[]=$array; 
    }
    $this->data_array= $new_array;
  }
}

public function table_field_caption ($field, $caption)
{  //echo "<pre>"; print_r($this->headers); echo "</pre>";
  ///*
  $this->fields_array[$field]['caption']['show']=$caption;
  $this->fields_array[$field]['caption']['view']=$caption;
  $this->fields_array[$field]['caption']['edit']=$caption;
  $this->fields_array[$field]['caption']['add']=$caption;
  //*/
  //echo "<pre> Fields_array"; print_r($this->fields_array); echo "</pre>";
  if(!empty($this->headers))
  {	//echo "<pre> Headers_array $field prev "; print_r($this->headers); echo "</pre>";
	if (isset($this->headers[$field])) {$this->headers[$field]=$caption;}
	//echo "<pre>Headers_array $field after"; print_r($this->headers); echo "</pre>"; //exit;
  }
}

public function delete_record ($id,$status_field)
{ 
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['6']=='6') )
  {
	  if (isset($this->status_field) AND !empty($this->status_field)) 
	  {
		$query="UPDATE `".$this->table_name."` SET 
					   ".$status_field."='0'
					   WHERE `".$this->auto_increment."`='$id'";
	  }
	  else {
		$query="DELETE FROM `".$this->table_name."` WHERE `".$this->auto_increment."`='$id'";
	  }
	  $cat = mysql_query($query);
	  if($cat) 
			 {
				echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."&".$this->action_page."=".$this->current_page."'></HEAD></HTML>";
			 }
		  else {exit(mysql_error());}
   } // end if
    else {echo "  DELETE access Restricted for you";}
}

public function hide_record ($id,$status_field)
{
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['3']=='3') )
  {
	  if (isset($this->status_field) AND !empty($this->status_field)) 
	  {
	  $query="UPDATE `".$this->table_name."` SET 
					   ".$status_field."='2'
					   WHERE `".$this->auto_increment."`='$id'";
	  $cat = mysql_query($query);
	  if($cat) 
			 {
				echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."&".$this->action_page."=".$this->current_page."#".$id."'></HEAD></HTML>";
			 }
		  else {exit(mysql_error());}
	  }	else {} 
    } // end if
    else {echo "  Hide access Restricted for you";}
	  
}

public function show_record ($id,$status_field)
{ 
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['3']=='3') )
  {	
	 if (isset($this->status_field) AND !empty($this->status_field)) 
	 {
	  $query="UPDATE `".$this->table_name."` SET 
					   ".$status_field."='1'
					   WHERE `".$this->auto_increment."`='$id'";
	  $cat = mysql_query($query);
	  if($cat) 
			 {
				echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."&".$this->action_page."=".$this->current_page."#".$id."'></HEAD></HTML>";
			 }
		  else {exit(mysql_error());}
	 }
   } // end if
    else {echo "  SHOW access Restricted for you";}
}
public function edit_record ($id)
{ 
 $cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
 if($cat) 
    {
	  if (mysql_num_rows($cat) > 0) {
       while ($row = mysql_fetch_assoc($cat))
		   {
		    $array[]=$row; $fields[]=$row['Field'];
           } 
       echo "<FORM action=\"\" method=\"POST\">";
	   echo "<TABLE align=\"center\" width=\"100%\">";
       foreach ($array as $row)
		  { 
		   if($row['Key']=="PRI" OR $row['Field']==$this->status_field) {}
		   else {
	             echo "<TR><TD align=right><label for=\"$row[Field]\">$row[Field]</label></TD><TD><INPUT type=\"text\" id=\"$row[Field]\" name=\"$row[Field]\"> </INPUT></TD></TR>";
		   }
	   }
	   echo "<TR><TD align=right></TD><TD><INPUT type=\"submit\" value=\"submit\" 
	   onclick=\"if(document.getElementById('name').value==0) {alert('Поле name пустое!'); document.getElementById('name').focus(); return false; }\"
	   ></TD></TR>
		  ";
	   echo "</TABLE>";
	   echo "</FORM>";
	  echo "<pre>"; print_r($fields); echo "</pre>";
      echo "<pre>"; print_r($array); echo "</pre>";
      }
    }
      else {exit(mysql_error());} 
    
    
}
private $edit_record_id;
public function build_edit_form ($id)
{ 
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['5']=='5') )
  {
	 $this->edit_record_id=$id;
	 $cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
	 if($cat) 
		{
		  if (mysql_num_rows($cat) > 0) {
		   while ($row = mysql_fetch_assoc($cat))
			   { $row['Label']=$row['Field'];
				 $row['Inputtype']=$row['Type'];
				$array[]=$row; //$fields[]=$row['Field'];
			   } 
		  }
		}
		  else {exit(mysql_error());} 
	 $cat = mysql_query("SELECT * FROM `".$this->table_name."` WHERE `".$this->auto_increment."`=$id");
	 if($cat) 
		{
		  if (mysql_num_rows($cat) > 0) {
		   while ($row = mysql_fetch_assoc($cat))
			   {
				$record_array=$row;
			   } 
		  }
		  $this->field_array=$array;
		  if (!empty($record_array)) {$this->record_array=$record_array;}

		}
		  else {exit(mysql_error());}
		///echo "<pre>"; print_r($record_array); echo "</pre>";  
  }   // end if
    else {echo "  Edit access Restricted for you";}
}

private $view_record_id;
public function build_view_record ($id)
{
   if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['2']=='2') )
  {
	 $this->view_record_id=$id;
	 $cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
	 if($cat) 
		{
		  if (mysql_num_rows($cat) > 0) {
		   while ($row = mysql_fetch_assoc($cat))
			   { $row['Label']=$row['Field'];
				 $row['Inputtype']=$row['Type'];
				$array[]=$row; //$fields[]=$row['Field'];
			   } 
		  }
		}
		  else { exit(mysql_error());}  //echo "<pre>"; print_r($array); echo "</pre>"; 
	 $cat = mysql_query("SELECT * FROM `".$this->table_name."` WHERE `".$this->auto_increment."`='".$this->view_record_id."'");
	 if($cat) 
		{
		  if (mysql_num_rows($cat) > 0) {
		   while ($row = mysql_fetch_assoc($cat))
			   {
				$record_array=$row; //echo "<pre>"; print_r($record_array); echo "</pre>";
				//image  
				if(isset($this->image_fields_array) AND !empty($this->image_fields_array)){
					foreach ($this->image_fields_array as $field => $data) {
						if(isset($record_array[$field])) { 
						   if (file_exists($data['path'].$record_array[$field]) AND !empty($record_array[$field]))
							 {$record_array[$field]="<img src=\"".$data['path'].$record_array[$field]."\" width=\"".$data['width']."\"> </img>";
							 } else {$record_array[$field]="<img src=\"".$this->data_path."/images/general/nophoto.jpg\" width=\"".$data['width']."\"> </img>";}
						}
						}// foreach
					} //if
			   } //while
		  }
		  $this->field_array=$array;  //echo "<pre>"; print_r($array); echo "</pre>"; 
		  if (!empty($record_array)) {$this->record_array=$record_array;}

		}
		  else { exit(mysql_error());}
		//note
		//echo "<pre>"; print_r($record_array); echo "</pre>"; 
		//echo "<pre>"; print_r($this->record_array); echo "</pre>"; 
		//echo "<pre>ghj"; print_r($this->image_fields_array); echo "</pre>";
  } // end if
  else {echo "View access Restricted for you";}
}
public function build_add_form ()
{ //echo "tablename".$this->table_name; exit;
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['4']=='4') )
  { 
				
	 $cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
	 if($cat) 
		{
		  if (mysql_num_rows($cat) > 0) {
		   while ($row = mysql_fetch_assoc($cat))
			   { $row['Label']=$row['Field'];
				 $row['Inputtype']=$row['Type'];
				$array[]=$row;
			   } 
		  }
		}
		  else {exit(mysql_error());} 
		  $this->field_array=$array;
		 ///echo "<pre>"; print_r($array); echo "</pre>"; 
  } // end if
  else {echo "Add access Restricted for you";}
}

public function edit_form_field_label ($field, $caption)
{ //echo "<pre>"; print_r($this->field_array); echo "</pre>";
	foreach ($this->field_array as  $key=>$array)
  { 
    if ( $array['Field']==$field ) {$this->field_array[$key]['Label']=$caption;} 
	 else {}
  }
}

public function field_label ($action, $field, $caption)
{ //echo "<pre>"; print_r($this->field_array); echo "</pre>";
	$this->fields_array[$field]['caption'][$action]=$caption;
}

// only for edit and add,  field_type("edit", "text", "textarea");
public function field_type ($action, $field, $type)
{ //echo "<pre>"; print_r($this->field_array); echo "</pre>";
	$this->fields_array[$field]['type'][$action]=$type;
}

// not yet used
public function edit_form_field_type ($field, $type)
{ //echo "<pre>"; print_r($this->field_array); echo "</pre>";
	foreach ($this->field_array as  $key=>$array)
  { 
    if ( $array['Field']==$field ) {$this->field_array[$key]['Inputtype']=$type;} 
	 else {} 
  } 
  //echo "<pre>"; print_r($this->field_array); echo "</pre>";
}
public function edit_form_field_delete($field)
{ //echo "<pre>"; print_r($this->field_array); echo "</pre>";
	foreach ($this->field_array as  $key=>$array)
  { 
    if ( $array['Field']==$field ) {} 
	 else { $new_array[]=$array;}
  }
  $this->field_array= $new_array; 
}
private $field_array; private $record_array; 
public function edit_form_display ()
  {  
	if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['5']=='5') )
    {
	 $this->edit_form_show ($this->field_array,  $this->record_array);
    } // end if
    else {echo "  Edit access Restricted for you";}
  }
public function record_view_display ()
  {  
	if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['2']=='2') )
    { if (!empty($this->record_array)) { $this->record_view ($this->field_array,  $this->record_array); } else {echo "Нет данных";}
	}  // end if
    else {echo "  View access Restricted for you";}
  }
private function record_view ($array, $record_array)
{  //echo "<pre>"; print_r($array); echo "</pre>";
   //echo "<pre>"; print_r($this->fields_array); echo "</pre>";
echo "<a href=\"javascript:history.back();\">Назад</a><DIV>";
	  foreach ($array as $row)
		  { 
		   if($row['Key']=="PRI" OR $row['Field']==$this->status_field) {}
		   else { $field=$row['Field'];
		   $type="text"; 
		   if ($row['Inputtype']=="date") {$type="date";}
		   if ($row['Inputtype']=="file") {$type="file";}
		   $column_value="";
		   $column_value=$record_array[$field];
		   if (isset($this->foreign_key_array[$field]) AND !empty($this->foreign_key_array[$field]))
			  {
			  $column_value=$this-> get_foreign_field_value ($column_value, $this->foreign_key_array[$field]['table'], $this->foreign_key_array[$field]['field'], $this->foreign_key_array[$field]['key']);
			  }
		  // $input_text="<DIV  value=\"$record_array[$field]\" size=\"100%\"> </INPUT>";
		   echo "<br><br><DIV class=\"cnsnt_info\" id=\"$row[Field]\" name=\"$row[Field]\" align=left>".$this->fields_array[$field]['caption']['view']."<hr>".$column_value."</DIV>";
		   }  // .$row['Label']."<hr> previous
	   }
	   
	   echo "</DIV><a href=\"javascript:history.back();\">Назад</a>";
}

private function edit_form_show ($array, $record_array)
{ 
$this->check_url();
if (!empty($this->record_array)) { 
echo "<FORM  enctype='multipart/form-data' action=\"".$this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_update."&".$this->id_parameter."=".$this->edit_record_id."\" method=\"POST\">";
	   echo "<TABLE align=\"center\" width=\"100%\">";
       foreach ($array as $row)
	    {  //echo "<pre>"; print_r($row); echo "</pre>";
		   if($row['Key']=="PRI" OR $row['Field']==$this->status_field) {}
		   else 
		    { $field=$row['Field']; 
		      $type="text"; 
		      if ($row['Inputtype']=="date") {$type="date";}
		      if ($row['Inputtype']=="file") {$type="file";}
			  $input_text="<INPUT type=\"$type\" id=\"$row[Field]\" name=\"$row[Field]\" value='".$record_array[$field]."' size=\"100%\"> </INPUT>";
			  //images
			  if(isset($this->image_fields_array) AND !empty($this->image_fields_array))
			  { 
				foreach ($this->image_fields_array as $field_1 => $data) {
				 if($field==$field_1) { //echo $field; 
				     if (file_exists($data['path'].$record_array[$field]) AND !empty($record_array[$field]))
					 { $input_text="<img src=\"".$data['path'].$record_array[$field]."\" width=\"".$data['width']."\"> </img>"; }
					 else {$input_text="<img src=\"".$this->data_path."/images/general/nophoto.jpg\" width=\"".$data['width']."\"> </img>";}
			     
				///*
				$input_text=$input_text." Изменить <input type=\"checkbox\" id=\"".$field."_change_allow\"
				
				 onclick=\"this.form.$row[Field].disabled = !this.checked;\">
				 " ;
				 //*/
				 $input_text=$input_text."<INPUT type=\"file\" id=\"$row[Field]\" name=\"$row[Field]\" value='".$record_array[$field]."' size=\"100%\" disabled=\"disabled\"> </INPUT>";
				 
				 }
				} 
			  }
			 /*note  
		      if (isset($this->fields_array[$field]['type']['edit']) AND $this->fields_array[$field]['type']['edit']=='image') 
			  { $input_text="<img src=\"../../student/photo/$record_array[$field]\" style=\"padding:5px 5px;\"";
			  }
		    // */ 
			  if (isset($this->fields_array[$field]['type']['edit']) AND $this->fields_array[$field]['type']['edit']=='textarea') //$row['Inputtype']=='textarea'
		      {
		         $input_text="<textarea id=\"$row[Field]\" name=\"$row[Field]\" cols=\"100%\" rows=\"15\">$record_array[$field]</textarea>";
				 if(isset($this->fields_array[$field]['ckeditor']['edit']) AND $this->fields_array[$field]['ckeditor']['edit']=='1')
				 { $ckeditor[]=$field;}
		      }
			  //foreign key
			  
			  if (isset($this->foreign_key_array[$row[Field]]) AND !empty($this->foreign_key_array[$row[Field]]))
			  { //echo "<pre>"; print_r ($this->foreign_key_array); echo "</pre>";
				$foreign_field_array= $this->get_foreign_table ($this->foreign_key_array[$row[Field]]['table'], $this->foreign_key_array[$row[Field]]['field'], $this->foreign_key_array[$row[Field]]['key']);
				////echo "<pre>"; print_r ($foreign_field_array); echo "</pre>";
				////echo "<pre>"; print_r ($record_array[$field]); echo "</pre>";
				$input_text=$this->create_selectbox ($foreign_field_array, $field, $field, $record_array[$field]);
			  }
			 
	          echo "<TR><TD align=right><label for=\"$row[Field]\">".$this->fields_array[$field]['caption']['edit']."</label></TD><TD>".$input_text."</TD></TR>"; // $row['Label']."</label>
		   }
	    }
	   echo "<TR><TD align=right></TD><TD><INPUT type=\"submit\" value=\"Изменить\" 
	   onclick=\"if(document.getElementById('name').value==0) {alert('Поле name пустое!'); document.getElementById('name').focus(); return false; }\"
	   ></INPUT>
	   <INPUT type=\"reset\" value=\"Сбросить\"></INPUT>
	   <INPUT type=\"button\" value=\"Отмена\" onclick=\"history.back();\"></INPUT></TD></TR>
		  ";
	   echo "</TABLE>";
	   echo "</FORM>";
	   if (isset($ckeditor) AND !empty($ckeditor)) 
	   { 
	     foreach ($ckeditor as $ckeditor_field) { $this->edit_form_ckeditor_replace($this->data_path, $ckeditor_field); }
	   }
     } else{echo "Нет данных";}
}
//private $field_array;
public function add_form_display ()
{ 
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['4']=='4') )
  {$this->add_form_show ($this->field_array);
     //echo "<pre>"; print_r($this->field_array); echo "</pre>";
  }  // end if
  else {echo "   Add access Restricted for you";}
}
private function add_form_show ($array)
{ $this->check_url(); //echo "<pre>"; print_r($this->fields_array); echo "</pre>";
echo "<FORM enctype='multipart/form-data' action=\"".$this->url."&".$this->action_name."=".$this->action_save."\" method=\"POST\">";
	   echo "<TABLE align=\"center\" width=\"100%\">";
       foreach ($array as $row)
	    { 
		 if($row['Key']=="PRI" OR $row['Field']==$this->status_field) {}
		 else 
		  {$field=$row['Field']; 
		   $type="text"; 
		   if ($row['Inputtype']=="date") {$type="date";}
		   if ($row['Inputtype']=="file") {$type="file";}
		   $input_text="<INPUT type=\"$type\" id=\"$row[Field]\" name=\"$row[Field]\" value=\"\" size=\"100%\"> </INPUT>";
		   //image
		   if(isset($this->image_fields_array) AND !empty($this->image_fields_array))
			  { 
				foreach ($this->image_fields_array as $field_1 => $data) {
				 if($field==$field_1) { //echo $field; 
			    /* $input_text="<INPUT type=\"file\" id=\"$row[Field]\" name=\"$row[Field]\" value='".$record_array[$field]."' size=\"100%\" > </INPUT>"; //disabled=\"disabled\"
				 */
				 $input_text="";
				 }
				} 
			  }
		   
		   if (isset($this->fields_array[$field]['type']['add']) AND $this->fields_array[$field]['type']['add']=='textarea') 
		    {
		     $input_text="<textarea id=\"$row[Field]\" name=\"$row[Field]\" cols=\"100%\" rows=\"15\"></textarea>";
		     if(isset($this->fields_array[$field]['ckeditor']['add']) AND $this->fields_array[$field]['ckeditor']['add']=='1')
				 { $ckeditor[]=$field;}
		    }
		   
		   //foreign key
			  
			  if (isset($this->foreign_key_array[$row[Field]]) AND !empty($this->foreign_key_array[$row[Field]]))
			  { //echo "<pre>"; print_r ($this->foreign_key_array); echo "</pre>";
			  $foreign_field_array= $this->get_foreign_table ($this->foreign_key_array[$row[Field]]['table'], $this->foreign_key_array[$row[Field]]['field'], $this->foreign_key_array[$row[Field]]['key']);
			  ////echo "<pre>"; print_r ($foreign_field_array); echo "</pre>"; 
			  ////echo "<pre>"; print_r ($record_array); echo "</pre>";
			  ///if(isset($this->binded_field_value) AND !empty($this->binded_field_value)) {$selected_value123=}
			  $input_text=$this->create_selectbox ($foreign_field_array, $field, $field, $this->binded_field_value[$field]);
			  }
		   
	       echo "<TR><TD align=right><label for=\"$row[Field]\">".$this->fields_array[$field]['caption']['add']."</label></TD><TD>".$input_text."</TD></TR>"; // $row[Label]
		  }
	   }
	   echo "<TR><TD align=right></TD><TD><INPUT type=\"submit\" value=\"Добавить\" 
	   onclick=\"if(document.getElementById('name').value==0) {alert('Поле name пустое!'); document.getElementById('name').focus(); return false; }\"
	   ></INPUT>
	   <INPUT type=\"reset\" value=\"Сбросить\"></INPUT>
	   <INPUT type=\"button\" value=\"Отмена\" onclick=\"history.back();\"></INPUT></TD></TR>
		  ";  // history.back()   onclick=\"window.location='?';\"
	   echo "</TABLE>";
	   echo "</FORM>";
	   if (isset($ckeditor) AND !empty($ckeditor)) 
	   { 
	     foreach ($ckeditor as $ckeditor_field) { $this->edit_form_ckeditor_replace($this->data_path, $ckeditor_field); }
	   }
}

public function update_record ($id)
{ 
  if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['5']=='5') )
  {
	$this->check_url();
	$cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
    if($cat) 
    {
	  if (mysql_num_rows($cat) > 0) {
        while ($row = mysql_fetch_assoc($cat))
		{ //$row['Label']=$row['Field'];
	         $fields[$row['Field']]=$row['Field'];  
			 $array[]=$row;
        }
	  if(!empty($_FILES))
      { 
	   //echo "<pre>"; print_r($_POST); echo "</pre>";
	   //echo "<pre>"; print_r($_FILES); echo "</pre>";
	   //echo "<pre>"; print_r($this->image_fields_array); echo "</pre>"; //exit;
	   if (isset($this->image_fields_array) AND !empty($this->image_fields_array))
	   {
	    foreach ($_FILES as $fieldname => $array) 
	    { 
	     if (isset($this->image_fields_array[$fieldname]) AND !empty($this->image_fields_array[$fieldname]))
	     {  $filename=""; $ext=""; $content=""; $newfilename="";
	     $filename= $_FILES[$fieldname]['name'];
	     $ext= pathinfo($filename, PATHINFO_EXTENSION);
         if($ext == 'jpg' || $ext == 'JPG' || $ext == 'jpeg' || $ext == 'JPEG' || $ext=='png' || $ext == 'PNG' || $ext=='gif' || $ext=='GIF') 
          { 
		   $content = file_get_contents($_FILES[$fieldname]['tmp_name']);  
           unlink($_FILES[$fieldname]['tmp_name']);
           $newfilename=$id.".".$ext;
		   $file_fields[$fieldname]=$newfilename;
		   //echo $file_fields[$fieldname];
	       // Экранируем спецсимволы в бинарном содержимом файла
           //$content = mysql_escape_string($content);
	       if (file_put_contents($this->image_fields_array[$fieldname]['path'].$newfilename, $content)) 
		   { //echo "<br>Файл успешно закачен";
	       } 
	        else {echo "Невозможно сохранить файл";}
          }  else {echo "Недопустимый формат файла      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$filename;}
	     }
	    } // foreach
	   }
	    //exit;
     }
            $update_text=""; $i="0";
      foreach ($_POST as $field=>$value)
	  { $i++; 
	    if($i=='1') 
	      {
		   //if (isset($file_fields[$field]) AND !empty($file_fields[$field])) {$value=$file_fields[$field];}
	        $update_text=$update_text."`".$field."`='".mysql_real_escape_string ($value)."'";
		  } 
		  else {
	      $update_text=$update_text.", `".$field."`='".mysql_real_escape_string ($value)."'"; 
		  }      
      } //foreach
	  //echo $update_text;
	  if (isset($file_fields) AND !empty($file_fields)) 
	  { foreach ($file_fields as $field=>$value)
	    {$update_text=$update_text.", `".$field."`='".mysql_real_escape_string ($value)."'";
		}
	  }
	   //echo $update_text; exit;
       $query="update `".$this->table_name."` SET 
				   $update_text  where `".$this->auto_increment."`='$id'
				   "; 
      }
    }
      else {exit(mysql_error());} 
      $update = mysql_query($query);
      if($update) 
           { echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."&".$this->action_page."=".$this->current_page."#".$id."'></HEAD></HTML>";
           }      else {}
  } // end if
    else {echo "  Update access Restricted for you";}
}

public function save_record ($id_user)
{  
   if ($this->user_module_permissions['1']=='1' OR ($this->user_module_permissions['4']=='4') )
  {
	$this->check_url();
	$cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
    if($cat) 
    {
	  if (mysql_num_rows($cat) > 0) {
       while ($row = mysql_fetch_assoc($cat))
		   { //$row['Label']=$row['Field'];
	         $fields[$row['Field']]=$row['Field'];  
			 $array[$row['Field']]=$row;
           } 
      }
      else {exit(mysql_error());} 
	}
	
 ///echo "<pre>"; print_r($_POST); echo "</pre>";
 ///echo "<pre>"; print_r($array); echo "</pre>";
 ///echo "<pre>"; print_r($fields); echo "</pre>";
 $fields_text=""; $i="0"; $values="";
 foreach ($fields as $field)
	{
	 $i++; if($i=='1') {$fields_text=$fields_text."`".$field."`";} else {$fields_text=$fields_text.", "."`".$field."`"; }
	 $value=$_POST[$field];
	 if ($array[$field]['Key']=='PRI') { $value="NULL";}
	 if ($field==$this->status_field) { $value="1";}
	 if(isset($this->user_field) and !empty($this->user_field)) {
	    if ($field==$this->user_field) { $value=$this->id_user;}
	 }
	 
	 if($i=='1') {
		   $values=$values."'$value'";
		 } else {$values=$values.", '$value'"; }   
 }
 $fields_text=$fields_text;
 //echo "(".$fields_text.")";
// echo "<br>".$values;
       $query="INSERT INTO `".$this->table_name."` (".$fields_text.")
	                                  VALUES (".$values.")";
				  
 // echo "<br>".$query;  exit; 
 // /*  
 $insert = mysql_query($query);
 if($insert) 
           { echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."'></HEAD></HTML>";
           }      else {exit(mysql_error());}
//*/
  } // end if
    else {echo "  Save access Restricted for you";}
}

public function edit_form_ckeditor_replace($path,$field)
  { 
?>
<script type="text/javascript" src="<?php echo $path."ckeditor/ckeditor.js"; ?>"></script>
<script type="text/javascript">
				CKEDITOR.replace( '<?php echo $field;?>' );
			</script><?php
  }

public function ckeditor_replace($action, $field)
  { //echo "<pre>"; print_r($this->fields_array); echo "</pre>";
	$this->fields_array[$field]['ckeditor'][$action]="1";
}
  
public function DBLookup($field, $tablename, $key_field, $id)
  { //echo "<pre>"; print_r($this->data_array); echo "</pre>";
    if (!empty($this->data_array))
	{	
       foreach ($this->data_array as  $array)
       { //echo "<pre>"; print_r($array); echo "</pre>";
	  $array[$field]= $this->get_key_value($array[$field], $tablename, $key_field, $id);
	  $new_array[]=$array;
       }
       $this->data_array= $new_array;
	} else {}
  }  

private function get_key_value($key, $tablename, $key_field, $id)
{ 
      $value="";
	  $query = "SELECT * FROM `$tablename`
              WHERE `$id` = '$key'";
      $rez= mysql_query($query);
      if(!$rez) exit(mysql_error());
      if(mysql_num_rows($rez) > 0)
      {
         while($array= mysql_fetch_array($rez))
        {
          $value=trim($array[$key_field]);
	    }
	    return $value;	
	  } else { return "0";}
} // end of function

   private $foreign_key_array;
   public function foreign_key ($field, $foreign_table, $foreign_field, $foreign_field_id)
   {
	   $this->foreign_key_array[$field]= array ("table"=>$foreign_table, "field"=>$foreign_field, "key"=>$foreign_field_id);
	   //echo "<pre>"; print_r($this->foreign_key_array); echo "</pre>";
   }
   
   public function get_foreign_field_value ($id, $foreign_table, $foreign_field, $foreign_field_id)
   { $value="";
	$query = "SELECT * FROM `".$foreign_table."`
              WHERE `".$foreign_field_id."` = $id";
    $rez = mysql_query($query);
    if(!$rez) exit(mysql_error());
    if(mysql_num_rows($rez) > 0)
    {
      while($array = mysql_fetch_array($rez))
      {
        $value=trim($array[$foreign_field]);
	  }
       return $value;
	} else {}
   }
   
   private function get_foreign_table ($foreign_table, $foreign_field, $foreign_field_id)
   { $table_array="";
    if (isset($this->status_field) AND !empty($this->status_field)) {$foreign_where=" WHERE `".$this->status_field."`='1' ";} else {$foreign_where="";}
	$query = "SELECT * FROM `".$foreign_table."` ".$foreign_where." ORDER BY ".$foreign_field." ASC";
    $rez = mysql_query($query);
    if(!$rez) exit(mysql_error());
    if(mysql_num_rows($rez) > 0)
    {
      while($array = mysql_fetch_array($rez))
      {
        //$table_array[]= array (trim($foreign_field_id)=>$array[$foreign_field_id], trim($foreign_field)=> $array[$foreign_field]);
		$table_array[trim($array[$foreign_field_id])]=$array[$foreign_field];
	  }
       return $table_array;
	} else {}
	
	
   }
   
   private function create_selectbox ($array, $name, $id, $selected_value)
   {   $select_text="<SELECT id=\"$id\" name=\"$name\">";
       $select_text=$select_text."<OPTION value=\"0\">--выбрать--</OPTION>";
	   foreach ($array as $value => $text)
	   {   
		   if ($value==$selected_value) {$selected="selected";} else {$selected="";}
		   $select_text=$select_text."<OPTION value=\"$value\" $selected >$text</OPTION>";
	   }
	   $select_text=$select_text."</SELECT>";
	   return $select_text;
   }
   
   private $binded_field_value=array();
   public function bind_field_with_parameter ($field, $value)
   {   
		$this->binded_field_value[$field]=$value;
   }
} // end of class





?>
<script type="text/javascript">
/*<![CDATA[*/
//-----------------------------------------------------
// Фиксированный заголовок у таблицы
//-----------------------------------------------------
// by ManHunter / PCL (www.manhunter.ru)
//-----------------------------------------------------
fix_header={
  'fixed_el': null,
  'new_table': null,

  bind : function(el, eventName, callback) {
    if (el) {
      if (el.addEventListener) {
        el.addEventListener(eventName, callback, false);
      }
      else if (el.attachEvent) {
        el.attachEvent("on" + eventName, callback);
      }
    }
  },

  get_position: function(el) {
    var offsetLeft = 0, offsetTop = 0;
    do {
      offsetLeft += el.offsetLeft;
      offsetTop  += el.offsetTop;
    }
    while (el = el.offsetParent);
    return {x:offsetLeft, y:offsetTop};
  },

  chk_position: function() {
    var doc = document.documentElement;
    var body = document.body;

    if (typeof(window.innerWidth) == 'number') {
      my_width = window.innerWidth;
      my_height = window.innerHeight;
    }
    else if (doc && (doc.clientWidth || doc.clientHeight)) {
      my_width = doc.clientWidth;
      my_height = doc.clientHeight;
    }
    else if (body && (body.clientWidth || body.clientHeight)) {
      my_width = body.clientWidth;
      my_height = body.clientHeight;
    }

    if (doc.scrollTop) { dy=doc.scrollTop; } else { dy=body.scrollTop; }

    var coord=fix_header.get_position(fix_header.fixed_el);

    // Заголовок таблицы еще на экране или таблица уже не на экране
    if (coord.y>dy || (coord.y+fix_header.fixed_el.clientHeight)<dy) {
      fix_header.new_table.style.left='-9999px';
    }
    // Заголовок уже прокручен вверх
    else {
      fix_header.new_table.style.left=
        fix_header.fixed_el.getBoundingClientRect().left+'px';
    }
  },

  fix: function (id) {
    var tmp,st;
    var ftable=document.getElementById(id);
    if (ftable) {
      if (this.new_table!=null) {
        if (this.new_table.parentNode!=undefined) {
          this.new_table.parentNode.removeChild(this.new_table);
        }
        this.new_table=null;
      }
      else {
        this.bind(window,'scroll',this.chk_position);
        this.bind(window,'resize',this.chk_position);
      }

      this.fixed_el=ftable;

      tmp=ftable.getElementsByTagName('thead');
      if (tmp) {
        var fthead=tmp[0];

        new_table=document.createElement('table');

        for(var i in this.fixed_el.style) {
          if (this.fixed_el.style[i]!='') {
            try {
              new_table.style[i]=this.fixed_el.style[i];
            }
            catch (e) {};
          }
        }

        new_table.id='fixed_'+id;
        //new_table.rules='all';
        new_table.border='0';
        new_table.style.position='fixed';
        new_table.style.left='-9999px';
        new_table.style.top='0px';

        var cln = fthead.cloneNode(true);
        var cth=cln.getElementsByTagName('th');
        var fth=fthead.getElementsByTagName('th');

        for(var i=0; i<fth.length; i++) {
          cth[i].style.width=(fth[i].clientWidth+(window.opera?1:0))+'px';
          cth[i].style.paddingLeft='0';
          cth[i].style.paddingRight='0';
          cth[i].style.borderWidth=fth[i].style.borderWidth;
        }
        new_table.appendChild(cln);

        this.fixed_el.parentNode.appendChild(new_table);
        this.new_table=new_table;
        this.chk_position();
      }
    }
  }
};
/*]]>*/
</script>
<STYLE>
	th {
		font-size:12px;
		padding:0px 0px;
	}

	
</STYLE>
