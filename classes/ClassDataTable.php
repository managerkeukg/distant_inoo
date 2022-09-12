<?php
class DataTable
{ 
	// actions
	public $action_name="actionsss"; public $action_page="pagesss"; public $action_view="viewsss"; public $action_add="addsss"; public $action_edit="editsss"; public $action_update="updatesss";
	public $action_save="savesss"; public $action_delete="deletesss"; public $action_show="showsss"; public $action_hide="hidesss";
	// -- actions
	private $auto_increment; public $id_parameter="idsss"; public $id_user; public $status_field=""; public $user_field="";
	public $cat;    public $array; public $data_array;  private $table_name; private $fields_array;
	public $text="nostra"; public $tr_hover_color="green"; public $bgcolor="white";
	//pagination
	public $records_per_page="20"; public $total_records; public $total_pages; public $current_page; public $start_from_record;
	// end pagination
	public $headers; public $url;
	public $tr_javascript="
               onmouseover=\"this.style.background='green'; this.style.height=this.offsetHeight*1.5; this.style.border='10'; this.style.borderColor='red';
               \"

			   onmouseout=\"this.style.background='white';  this.style.height=this.offsetHeight/1.5; this.style.border='1'; this.style.borderColor='';
			   \"
               ";

	public function query ($table, $and_text=" ")
	{ 
		$this->table_name = $table;
		$this->count_table ($table, $and_text);
		$query="SELECT * FROM `".$table."` where 1=1 ".$and_text;
		if (isset($this->status_field) AND !empty($this->status_field)) 
		{
			$sql_and_status=" AND (`".$this->status_field."`>='1') ";
		} else {$sql_and_status="";}
		$query=$query.$sql_and_status." LIMIT ".$this->start_from_record.",".$this->records_per_page."";
		$cat = mysql_query($query);
		if($cat) 
		{ 
			if (mysql_num_rows($cat)> 0)
			{  
				$this->table_info($this->table_name);
				while( $array = mysql_fetch_assoc($cat)) 
				{ 
					$this->data_array[]=$array;
				}  
				$this->headers = $this->table_fields ($this->data_array); 
				//echo "<pre>"; print_r($this->headers); echo "</pre>";
				foreach  ($this->headers as $field_name) 
				{
					$this->fields_array[$field_name]['caption']['show']=$field_name;
					$this->fields_array[$field_name]['caption']['view']=$field_name;
					$this->fields_array[$field_name]['caption']['edit']=$field_name;
					$this->fields_array[$field_name]['caption']['add']=$field_name;
				}		
				//echo "<pre>"; print_r($this->fields_array); echo "</pre>";	
			} else { 
				//return "0";
			}
		}
		else {exit(mysql_error());}
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
  { if (isset($_GET[$this->action_page]) AND !empty($_GET[$this->action_page])) {is_int_ ($_GET[$this->action_page]); $page = $_GET[$this->action_page]; } else {$page = "1";} 
	///if (isset($_POST['records_per_page']) AND !empty($_POST['records_per_page'])) {$records_per_page=$_POST['records_per_page'];} else {$records_per_page="20";}
	///  $this->records_per_page=$records_per_page;
	  $pnumber ="20";
	if (isset($this->status_field) AND !empty($this->status_field)) {$sql_and_status=" AND (`".$this->status_field."`>='1') ";} else {$sql_and_status="";}
    $query = "SELECT COUNT(*) FROM `$table` where 1=1 ".$and_text." ".$sql_and_status.""; // $permission_text
    $tot = mysql_query($query);
    if(!$tot) exit(mysql_error());
    $total = mysql_result($tot,0);
    $number = (int)($total/$pnumber); 
	if((float)($total/$pnumber) - $number != 0) $number++;
   if ( $number < $page) {$page= 1; }
    // Начальная позиция
    $start = (($page - 1)*$pnumber );
	
	//$this->records_per_page=$pnumber; 
	$this->total_records=$total; $this->total_pages=$number; $this->current_page=$page; $this->start_from_record=$start;
  }

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
	  if(isset($_GET[$this->action_name]) AND ( ($_GET[$this->action_name]==$this->action_add) 
	  OR ($_GET[$this->action_name]==$this->action_view) OR ($_GET[$this->action_name]==$this->action_save) 
      OR ($_GET[$this->action_name]==$this->action_delete) OR ($_GET[$this->action_name]==$this->action_hide) OR ($_GET[$this->action_name]==$this->action_show) 
	  OR ($_GET[$this->action_name]==$this->action_edit) OR ($_GET[$this->action_name]==$this->action_update)) )
      { 
        if ($_GET[$this->action_name]==$this->action_save) {$this-> save_record ($this->id_user);}
        if ($_GET[$this->action_name]==$this->action_add) {
	       $this-> build_add_form();
	       $this-> edit_form_field_delete("id_user");
	       $this-> add_form_display();
        } else 
		{ if (isset($_GET[$this->id_parameter]) AND !empty($_GET[$this->id_parameter])) {is_int_obligatory ($_GET[$this->id_parameter]); } else {exit;} 
		  $id = clean($_GET[$this->id_parameter]);
		}

		if ($_GET[$this->action_name]==$this->action_view) {
	        $this-> build_view_record ($id);
	        //$datagrid-> edit_form_field_delete("image");
	        $this-> record_view_display ($id);
	    }
		
		if ($_GET[$this->action_name]==$this->action_edit) { 
	        //$datagrid-> edit_record ($id);
	        $this-> build_edit_form ($id);
	        ///$datagrid-> edit_form_field_delete("id_user");
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
	  Добавить?<img src="<?php echo _DATA_PATH_."images/add.jpg";?>" border="0" ></a>
		<?php
		 }
       }
  }
  private function table_fields ($data_array)
  {
    foreach ($data_array as  $array)
    { 
      $table_fields=array_keys($array);;
    }
  return $table_fields;
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
	{ 
	  if ($view_type=="table") 
		{
	  ?><DIV style="max-width:900;">
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
      <a href="<?php echo $this->url."&".$this->action_name."=".$this->action_add;?>" onclick="return confirm('Вы уверены, что хотите Добавить запись?');">
	  Добавить?<img src="<?php echo _DATA_PATH_."images/add.jpg";?>" border="0" ></a>
	  <BR>
	  <TABLE border="0" cellPadding="3" cellSpacing="0"  align="center" >
        <TR bgcolor="#023183" align="center" style="color:white" height="35">
	  <?php
		  foreach ($header as $header_columns)
		{ if($header_columns==$this->status_field) {} 
		  else {echo "<TD >$header_columns</TD>"; 
		  }
		} 
		echo "<TD></TD>";
	  ?>
	  <TD>
	  </TD> 
	  <TD><?php //echo $this->total_pages;
	          echo "<SELECT>"; 
	          for($i=1;$i<=$this->total_pages;$i++)
			  { ?> <OPTION value="<?php echo $i;?>" <?php if (isset($_GET[$this->action_page]) AND $_GET[$this->action_page]==$i ){echo "selected";}?> ><?php echo $i;?></OPTION> <?php }
			  echo "</SELECT>";
			 ?>
		 </TD>
	     <TD align="right" width="11"><a href="<?php echo $this->url."&".$this->action_name."=".$this->action_add;?>" onclick="return confirm('Вы уверены, что хотите Добавить запись?');"><img src="<?php echo _DATA_PATH_."images/add.jpg";?>" border="0" ></a></TD>
		 </TR>
	  <?php $i="0";
	  foreach ($data as $row)
		{  $i++;  if($i % 2 == 0) {  $bgcolor="silver"; } else {  $bgcolor="white"; }
		  //echo "<pre>"; print_r($row); echo "</pre>"; 
		  ?><TR bgcolor="<?php echo $bgcolor; ?>" align="center" style="border:20;" <?php echo $tr_javascript; ?> >
		  <?php
		  foreach ($row as $key=>$columns)
			{ if($key==$this->status_field){}
              else { $column_value=substr($columns,0,150); $column_value=$columns; 
			  //<a name="$array['id']"></a>
			  if($key==$this->auto_increment) {$anchor="<a name=\"$column_value\"></a>";} else {$anchor="";}
		             echo "<TD>".$anchor."<DIV style=\"word-wrap: normal; word-break: break-all; \">".$column_value."</DIV></TD>";
			  }
		    }
		  if (isset($this->status_field) AND !empty($this->status_field)) {
		    if ($row[$this->status_field]=='1') {$show=$this->action_hide; $show_image="hide";} 	
		    if ($row[$this->status_field]=='2') {$show=$this->action_show; $show_image="show";} 	
		  }
		     ?> 
			 <TD align="right" width="11"><a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_view."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo _DATA_PATH_."images/next.png";?>" border="0" alt="Подробнее" ></a></TD>
			 <?php 
			 if (isset($this->status_field) AND !empty($this->status_field)) 
			 {
			   ?>
			   <TD align="right" width="11"><a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$show."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo _DATA_PATH_."images/$show_image.gif";?>" border="0" alt="Скрыть" ></a></TD>
			   <?php
			 } else {echo "<TD></TD>";}
			 ?>
			 <TD align="right" width="11"><a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_edit."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo _DATA_PATH_."images/edit.gif";?>" border="0" alt="Редактировать"></a></TD>
			 <TD align="right" width="11"><a href="<?php echo $this->url."&".$this->action_page."=".$this->current_page."&".$this->action_name."=".$this->action_delete."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo _DATA_PATH_."images/delete.gif";?>" border="0" ></a></TD>
			 <?php
		  echo "</TR>";
		}
	  echo "</TABLE></DIV>"; 
		}
		else
		{
		?><DIV style="max-width:900;">
        
	  <?php  echo "<pre>"; print_r($header); echo "</pre>"; 
		  foreach ($header as $header_columns)
		{ echo "<DIV ><font color=red>$header_columns</font></DIV>";
		} 
	  ?> 
	    
	  <?php $i="0";
	  foreach ($data as $row)
		{  $i++;  if($i % 2 == 0) {  $bgcolor="silver"; } else {  $bgcolor="white"; }
		  //echo "<pre>"; print_r($row); echo "</pre>"; 
		  ?><!-- <TR bgcolor="<?php echo $bgcolor; ?>" align="center" style="border:20;" <?php echo $tr_javascript; ?> > -->
		  <?php
		  foreach ($row as $key=>$columns)
			{ $column_value=substr($columns,0,150); $column_value=$columns; 
		      echo "<DIV style=\"word-wrap: normal; word-break: break-all; \">$key ".$column_value."</DIV>";
		  }
		     ?> 
			 <DIV align="right" width="23">
			     <a href="?<?php echo $this->action_name."=".$this->action_view."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img width="11" src="<?php echo _DATA_PATH_."images/next.png";?>" border="0" alt="Подробнее" ></a>
		         <a href="?<?php echo $this->action_name."=".$this->action_edit."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo _DATA_PATH_."images/edit.gif";?>" border="0" alt="Редактировать"></a>
			     <a href="?<?php echo $this->action_name."=".$this->action_delete."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo _DATA_PATH_."images/delete.gif";?>" border="0" ></a>
			 </DIV>
			 <?php
		  
		}
	  echo "</DIV>"; 
		} // end view div
		?>
		<FORM action="" method="POST">
		<DIV style="align:right;">
		По <SELECT id="records_per_page" name="records_per_page" onchange="this.form.submit();">
		    <OPTION value="100" <?php if ($this->records_per_page=="100") {echo "selected";} ?> >100</OPTION>
			<OPTION value="50" <?php if ($this->records_per_page=="50") {echo "selected";} ?> >50</OPTION>
			<OPTION value="30" <?php if ($this->records_per_page=="30") {echo "selected";} ?> >30</OPTION>
			<OPTION value="20" <?php if ($this->records_per_page=="20") {echo "selected";} ?> >20</OPTION>
			<OPTION value="10">10</OPTION>
		  </SELECT>
		</DIV>  
		</FORM>
		<?php
		//$this->records_per_page=$pnumber; $this->total_records=$total; $this->total_pages=$number; 
		//$this->current_page=$page; $this->start_from_record=$start;
		$this->pagination_view($this->current_page, $this->total_pages, $this->total_records);
    }


public function deletecolumn ($column_name)
{
  
  if (!empty($this->data_array))
  {
	  foreach ($this->data_array as  $array)
    {
     unset($array[$column_name]);
     $new_array[]=$array;
    }
  $this->data_array=$new_array;
  $key=array_search($column_name, $this->headers); 
  unset( $this->headers[$key]);
  }
}
function addcolumn ($column_name, $value)
{
  foreach ($this->data_array as  $array)
  {
   $array[$column_name]=$value;
   $new_array[]=$array;
  }
  $this->data_array= $new_array;
  $this->headers[] = $column_name;
}

public function convertcolumn_toimage ($column_name, $image_source, $width="50")
{
  foreach ($this->data_array as  $array)
  { 
   $array[$column_name]="<img src=$image_source$array[$column_name] width=$width>"; 
   $new_array[]=$array;
  }
  $this->data_array= $new_array;
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
  $this->fields_array[$field]['caption']['show']=$caption;
  $this->fields_array[$field]['caption']['view']=$caption;
  $this->fields_array[$field]['caption']['edit']=$caption;
  $this->fields_array[$field]['caption']['add']=$caption;
  //echo "<pre> Fields_array"; print_r($this->fields_array); echo "</pre>";
  if(!empty($this->headers))
  {	foreach ($this->headers as  $field_name)
    { 
    if ( $field_name==$field ) {$new_array[]=$caption;} 
	 else {$new_array[]=$field_name;}
    }
    $this->headers = $new_array;
	//echo "<pre>"; print_r($this->headers); echo "</pre>"; exit;
  }
}

public function delete_record ($id,$status_field)
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
}

public function hide_record ($id,$status_field)
{ if (isset($this->status_field) AND !empty($this->status_field)) 
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
}

public function show_record ($id,$status_field)
{ if (isset($this->status_field) AND !empty($this->status_field)) 
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
{ $this->edit_record_id=$id;
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
}

private $view_record_id;
public function build_view_record ($id)
{ $this->view_record_id=$id;
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
		    $record_array=$row;
           } 
      }
	  $this->field_array=$array;  //echo "<pre>"; print_r($array); echo "</pre>"; 
      if (!empty($record_array)) {$this->record_array=$record_array;}

    }
      else { exit(mysql_error());}
	//echo "<pre>"; print_r($record_array); echo "</pre>";  
}
public function build_add_form ()
{ //echo "tablename".$this->table_name; exit;
 
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
//     echo "<pre>"; print_r($array); echo "</pre>";  
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

public function field_type ($action, $field, $type)
{ //echo "<pre>"; print_r($this->field_array); echo "</pre>";
	$this->fields_array[$field]['type'][$action]=$type;
}

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
  {  $this->edit_form_show ($this->field_array,  $this->record_array);
  }
public function record_view_display ()
  {  if (!empty($this->record_array)) { $this->record_view ($this->field_array,  $this->record_array); } else {echo "Нет данных";}
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
		  // $input_text="<DIV  value=\"$record_array[$field]\" size=\"100%\"> </INPUT>";
		   echo "<br><br><DIV class=\"cnsnt_info\" id=\"$row[Field]\" name=\"$row[Field]\" align=left>".$this->fields_array[$field]['caption']['view']."<hr>".$record_array[$field]."</DIV>";
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
	    { 
		   if($row['Key']=="PRI" OR $row['Field']==$this->status_field) {}
		   else 
		    { $field=$row['Field']; 
		      $type="text"; 
		      if ($row['Inputtype']=="date") {$type="date";}
		      if ($row['Inputtype']=="file") {$type="file";}
		      $input_text="<INPUT type=\"$type\" id=\"$row[Field]\" name=\"$row[Field]\" value='".$record_array[$field]."' size=\"100%\"> </INPUT>";
		      if (isset($this->fields_array[$field]['type']['edit']) AND $this->fields_array[$field]['type']['edit']=='textarea') //$row['Inputtype']=='textarea'
		      {
		         $input_text="<textarea id=\"$row[Field]\" name=\"$row[Field]\" cols=\"100%\" rows=\"15\">$record_array[$field]</textarea>";
				 if(isset($this->fields_array[$field]['ckeditor']['edit']) AND $this->fields_array[$field]['ckeditor']['edit']=='1')
				 { $ckeditor[]=$field;}
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
	     foreach ($ckeditor as $ckeditor_field) { $this->edit_form_ckeditor_replace(_DATA_PATH_, $ckeditor_field); }
	   }
     } else{echo "Нет данных";}
}
//private $field_array;
public function add_form_display ()
  {  $this->add_form_show ($this->field_array);
 //echo "<pre>"; print_r($this->field_array); echo "</pre>";
  }
private function add_form_show ($array)
{ $this->check_url(); //echo "<pre>"; print_r($this->fields_array); echo "</pre>";
echo "<FORM action=\"".$this->url."&".$this->action_name."=".$this->action_save."\" method=\"POST\">";
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
		   if (isset($this->fields_array[$field]['type']['add']) AND $this->fields_array[$field]['type']['add']=='textarea') 
		    {
		     $input_text="<textarea id=\"$row[Field]\" name=\"$row[Field]\" cols=\"100%\" rows=\"15\"></textarea>";
		     if(isset($this->fields_array[$field]['ckeditor']['add']) AND $this->fields_array[$field]['ckeditor']['add']=='1')
				 { $ckeditor[]=$field;}
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
	     foreach ($ckeditor as $ckeditor_field) { $this->edit_form_ckeditor_replace(_DATA_PATH_, $ckeditor_field); }
	   }
}

public function update_record ($id)
{ $this->check_url();
	$cat = mysql_query("SHOW COLUMNS FROM  `".$this->table_name."`");
    if($cat) 
    {
	  if (mysql_num_rows($cat) > 0) {
       while ($row = mysql_fetch_assoc($cat))
		   { //$row['Label']=$row['Field'];
	         $fields[$row['Field']]=$row['Field'];  
			 $array[]=$row;
           } 
$update_text=""; $i="0";
foreach ($_POST as $field=>$value)
	  { $i++; if($i=='1') {
	   $update_text=$update_text."`".$field."`='".mysql_real_escape_string ($value)."'";} else {
	   $update_text=$update_text.", `".$field."`='".mysql_real_escape_string ($value)."'"; }      
} //echo $update_text;
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
}

public function save_record ($id_user)
{   $this->check_url();
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
	 if ($field=='id_user') { $value=$id_user;}
	 if($i=='1') {
		   $values=$values."'$value'";
		 } else {$values=$values.", '$value'"; }   
 } 
 $fields_text=$fields_text;
 echo "(".$fields_text.")";
 echo "<br>".$values;
 

       $query="INSERT INTO `".$this->table_name."` (".$fields_text.")
	                                  VALUES (".$values.")";
				  
  ///echo "<br>".$query;  exit; 
 // /*  
 $insert = mysql_query($query);
 if($insert) 
           { echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."'></HEAD></HTML>";
           }      else {exit(mysql_error());}
//*/
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

    // Постраничная навигация
	private function pagination_view($page, $number, $total)
   { 
    $current_size="3"; $size="2";
	echo "<table width=\"800px\" cellpadding=\"3px\" cellspacing=\"2px\"><tr><td>";
	//$number_row=0;
    for($i = 1; $i <= $number; $i++)
    {
      $number_row = (int)($i/30);  if((float)($i/30) - $number_row != 0) {$row_end="";} else {$row_end="</td></tr><tr><td>";}
	  if($i != $number)
      {
        if($page == $i) // if current page
        {
          echo "<a style=\"padding:2px 4px; color: rgb(255, 255, 255); background-color: white; border: 1px solid rgb(155, 155, 155);\">
		  <font color=black size=$current_size>".$i."</font></a>&nbsp;".$row_end;
		  // <font color=white size=$current_size>[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]</font>
        }
        else
        { //echo "<table width=100% ><tr><td width=\"100%\">";
		  // <a style="color: rgb(255, 255, 255); background-color: black; border: 1px solid rgb(255, 255, 255);">49</a>
          echo "<a href=".$this->url."&".$this->action_page."=".$i." 
		  style=\"padding:2px 0px; color: rgb(255, 255, 255); background-color: black; border: 1px solid rgb(255, 255, 255);\">
		  <font color=white size=$size>".$i."</font>
		  </a>&nbsp;".$row_end;  // .(($i - 1)*$pnumber + 1)."-".$i*$pnumber.
		  // $_SERVER[PHP_SELF] instead of index.php
          //echo "</td></tr></table>";
        }
      }
      else
      {
        if($page == $i)
        {
          echo "<a style=\"padding:3px 3px; color: rgb(255, 255, 255); background-color: white; border: 1px solid rgb(155, 155, 155);\">
		  <font color=black size=$current_size>".$i."</font>&nbsp;".$row_end;   // ($total)  instead of  ($total - 1)
		  // [".(($i - 1)*$pnumber + 1)."-".($total)."]
        }
        else
        {  
          //echo "<table width=\"100%\"><tr><td>";
          echo "<a href=".$this->url."&".$this->action_page."=".$i."
		  style=\"padding:3px 3px; color: rgb(255, 255, 255); background-color: black; border: 1px solid rgb(255, 255, 255);\">
		  <font color=white size=$size>".$i."</font>
		  </a>&nbsp;".$row_end;  /// [".(($i - 1)*$pnumber + 1)."-".($total)."]
		  // $_SERVER[PHP_SELF] instead of index.php   and     ($total)  instead of  ($total - 1)
		  //echo "</td></tr></table>";
        }
      }
    }

	  echo "</td></tr></table>"; 
   } // end of function
   
} // end of class





?>