<?php
class TableSelectBox 
{   public $data_array="";
    //public $query=""; public $select_name="";  public $caption="Университеты:"; 
	public $caption_all="Все"; public $value_all="Все";
    public $autoincrement_field="id"; public $show_field="name";
	public $form_id="TableSelect"; public $form_name="TableSelect";
	public function DisplayTableSelectBox ()
	{ 
      ?>
	  <SCRIPT type="text/javascript">
		  function remove_elem ()
		{ 
		  //alert(arguments[0]);
		  //var elem = document.getElementById(arguments[0]);
          //elem.parentNode.removeChild(elem);
	    }
	  </SCRIPT>
	 <!--  var element = document.getElementById("element-id");
element.outerHTML = "";
delete element; -->
	  <?php
	  echo "<FORM id=\"".$this->form_id."\" name=\"".$this->form_name."\" method=\"POST\">";
      if (isset($this->data_array) AND !empty($this->data_array))
		 { $close_div="";
		   //echo "<pre>"; print_r($this->data_array); echo "</pre>"; 
		        
		   foreach ($this->data_array as $key=>$value)
		    {  ///echo "<pre>Post"; print_r($_POST); echo "</pre>";
		       ///*
		       if (isset($value['query_and']) )  //AND !empty($value['query_and'])
			   { //foreach ($value['query_and'] as $field => $select_choose)
				 //{
				  //  $query_and_text=$query_and_text." `".$field."`='".$_POST[$select_choose]."' AND ";
			      //}
                 $query_and_text="";
				 foreach ($value['query_and'] as $field => $select_choose)
				 {
				   $query_and_text=$query_and_text." `".$select_choose['field']."` ".$select_choose['equation']." '".$_POST[$select_choose['post']]."' AND ";
			     }
			      
			   } 
			   //*/
			   if (isset($value['parent_table']) AND !empty($value['parent_table']))
				{ 
			       
			       if (isset($_POST[$value['parent_select_name']]) AND !empty($_POST[$value['parent_select_name']]))
				   {$array="";
					$array['id']=$value['id'];
					$array['id_sub']=$value['id_sub'];
					//$array['query_and']=$value['query_and'];
					$array['name']=$value['select_name'];
					$array['value_all']="all";
					$array['caption_all']="Все";
					$array['autoincrement_field']="id";
					$array['show_field']=$value['show_field'];
					$array['caption']= $value['caption'];
		            $parent_where=""; 
					if (isset($value['key_field']) AND !empty($value['key_field'])) 
						{$parent_where="`".$value['key_field']."`='".$_POST[$value['parent_select_name']]."' AND ";} else {$parent_where="";}
					$query="SELECT * FROM ".$value['table']." WHERE ".$parent_where." ".$query_and_text."  `status`='1'";
					///echo "<BR>".$query;
					$array['data']=$this->get_array($query);
					$this->display_select_box($array);
					$query_and_text="";
				   }
				   $close_div=$close_div."</DIV>";
			   }
			   else {
				$array="";
				$array['id_sub']=$value['id_sub'];
				$array['id']=$value['id'];
				$array['name']=$value['select_name'];
				$array['value_all']="all";
				$array['caption_all']="Все";
				$array['autoincrement_field']="id";
				$array['show_field']=$value['show_field'];
				$array['caption']= $value['caption'];
		        $parent_where=""; 
				if (isset($value['key_field']) AND !empty($value['key_field'])) 
					{$parent_where="`".$value['key_field']."`='".$_POST[$value['parent_select_name']]."' AND ";} else {$parent_where="";}
		        $query="SELECT * FROM ".$value['table']." WHERE ".$parent_where." ".$query_and_text."  `status`='1'";
				///echo "<BR>".$query;
		        $array['data']=$this->get_array($query);;
				$this->display_select_box($array);
				$query_and_text="";
			   }
		    }// end foreach
			$close_div=$close_div."</DIV>";
			echo $close_div;
		 }
	  ?>
		</FORM>
	  <?php
	} // end function DisplayTableSelectBox

	private function get_array($query1)
	{
	  $rez1 = mysql_query($query1);
      if(!$rez1) exit(mysql_error());
      if(mysql_num_rows($rez1) > 0)
      { 
		  while($array1 = mysql_fetch_array($rez1))
		  {
		    $return_array[]=$array1;
		  }
		  return $return_array;
	  } else {return "0";}
	} // end function get_array
	
	private function display_select_box($array)
	{
      if (isset($array['data']) AND !empty($array['data']))
	 {
	  echo "<DIV id=\"".$array['id']."\">";
	  echo $array['caption']."<SELECT name=\"".$array['name']."\" onchange='remove_div(\"".$array['id_sub']."\"); this.form.submit();'>"; // remove_elem(\"".$array['id_sub']."\");
      echo "<OPTION value=\"".$array['value_all']."\">".$array['caption_all']."</OPTION>";
      foreach ($array['data'] as $value)
      {
       if( $_POST[$array['name']] == $value[$array['autoincrement_field']])   {$selected = "selected";}  else { $selected = ""; }
       echo "<OPTION value=\"".$value[$array['autoincrement_field']]."\" $selected>".$value[$array['show_field']]."</OPTION>";
	  }
      echo "</SELECT><br><br>";
	 }
	}
	
}
?>