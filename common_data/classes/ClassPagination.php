<STYLE>
.pagination_td {
   text-align:center;
   width:30px;
   background-color: black;
   border:1px solid white;
}
.pagination_table {
   margin:0px auto;
}
</STYLE>
<?php
class Pagination
{
	private $records_per_page=20; private $query; private $array_data;
	private $tot; private $total_records; private $total_pages; private $current_page; private $start_from_record;
	public function get_pagination_data ($query, $current_page, $records_per_page)
	{   
		$this->query= $query;
		$this->current_page= $current_page;
		$this->records_per_page= $records_per_page;
        $this->tot = mysql_query($this->query);
		if(!$this->tot) exit(mysql_error());
		$this->total_records = mysql_result($this->tot,0);
		$this->total_pages = (int)($this->total_records/$this->records_per_page); 
		if((float)($this->total_records/$this->records_per_page) - $this->total_pages != 0) $this->total_pages++;
		if ( $this->total_pages < $this->current_page) {$this->current_page=1; }
		$this->start_from_record = (($this->current_page - 1)*$this->records_per_page ); 
		$this->array_data['total_records']=$this->total_records;
        $this->array_data['total_pages']=$this->total_pages;
        $this->array_data['start_from_record']=$this->start_from_record;
        return $this->array_data;
	}
	
	
	private $font_size_current="3"; private $font_size="2"; private $count_per_row="20"; private $i;
	private $number_row; private $row_end; private $url;
	public function pagination_view($current_page, $total_pages, $total_records, $url)
   { //echo $current_page."-".$this->total_pages."-".$total_records;
	$this->current_page= $current_page;
    $this->total_pages= $total_pages;
    $this->url= $url;
    echo "<TABLE  class=\"pagination_table\"  cellpadding=\"3px\" cellspacing=\"2px\"><TR>";
	//$number_row=0;
    for($this->i = 1; $this->i <= $this->total_pages; $this->i++)
    {
      $this->number_row = (int)($this->i/$this->count_per_row);  if((float)($this->i/$this->count_per_row) - $this->number_row != 0) {$this->row_end="";} else {$this->row_end="</TR><TR>";}
	  if($this->i != $this->total_pages) // if the page is not last
      {
        if($this->current_page == $this->i) // if current page
        {
          echo "<TD class=\"pagination_td\"><a style=\"padding:3px 3px; color: rgb(255, 255, 255); background-color: white;\">
		  <font color=black size=".$this->font_size_current.">".$this->i."</font></a></TD>".$this->row_end;
        }
        else
        { 
		   echo "<TD class=\"pagination_td\"><a href=".$this->url."=".$this->i." 
		  style=\"padding:0px 0px; color: rgb(255, 255, 255); background-color: black;\">
		  <font color=white size=".$this->font_size.">".$this->i."</font>
		  </a></TD>".$this->row_end;
        }
      }
      else // if the page is last
      {
        if($this->current_page == $this->i)
        {
          echo "<TD class=\"pagination_td\"><a style=\"padding:3px 3px; color: rgb(255, 255, 255); background-color: white;\">
		  <font color=black size=".$this->font_size_current.">".$this->i."</font></TD>".$this->row_end;
        }
        else
        {  
          echo "<TD class=\"pagination_td\"><a href=".$this->url."=".$this->i."
		  style=\"padding:0px 0px; color: rgb(255, 255, 255); background-color: black;\">
		  <font color=white size=".$this->font_size.">".$this->i."</font>
		  </a></TD>".$this->row_end;
        }
      }
    }

	  echo "</TR></TABLE>"; 
   } // end of function
}
?>