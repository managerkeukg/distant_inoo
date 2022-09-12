<style>

</style>
<!-- 
	version 1.0.0  2019_07_19
-->
<?php
class SelectHtml5
{ 
	public $id="id_select";
	public $name="select_name";
	
	public $autofocus;
	public $disabled;
	public $form;
	public $multiple;
	public $option_default="Выбрать";
	public $required;
	public $return_text="";
	public $selected_value;
	public $size;
	
	private $text_onchange;
	
	public $array_options=array();
	public $array_options_table=array();
	public $array_options_table_value="id";
	public $array_options_table_label="name";
	
	
	public function onchange ($text)
	{
		$this->text_onchange=$text;
	}
	
	public function display ()
	{
		$this->return_text=$this->return_text."<SELECT id=\"".$this->id."\"  name=\"".$this->name."\" ";
			if(isset($this->autofocus) AND !empty($this->autofocus)) {$this->return_text=$this->return_text. " autofocus ";}
			if(isset($this->disabled) AND !empty($this->disabled)) {$this->return_text=$this->return_text." disabled ";}
			if(isset($this->form) AND !empty($this->form)) {$this->return_text=$this->return_text. " form=\"".$this -> form."\" ";}
			if(isset($this->multiple) AND !empty($this->multiple)) {$this->return_text=$this->return_text. " multiple ";}
			if(isset($this->required) AND !empty($this->required)) {$this->return_text=$this->return_text. " required ";}
			if(isset($this->size) AND !empty($this->size)) {$this->return_text=$this->return_text. " size=\"".$this -> size."\" ";}
			
			if(isset($this->text_onchange) AND !empty($this->text_onchange)) {$this->return_text=$this->return_text. " onchange=\"".$this->text_onchange."\" ";}
		$this->return_text=$this->return_text.">";
		if (isset($this->array_options_table) AND !empty($this->array_options_table) AND is_array($this->array_options_table))
		{
			///*
			$this->return_text=$this->return_text. "<option value=\"\"> ".$this->option_default." </option>";
			foreach ($this->array_options_table as $key => $value)
			{
				$this->return_text=$this->return_text. "<option value=\"".$value[$this -> array_options_table_value]."\"";
				if (isset($_POST[$this->name]) AND !empty($_POST[$this->name]))
				{
					if($_POST[$this->name] == $value[$this -> array_options_table_value])   { 
						$this->return_text=$this->return_text. " selected ";
					}  else {  }
				}
				if (!empty($this->selected_value) AND ($value[$this -> array_options_table_value] == $this->selected_value))
				{
					$this->return_text=$this->return_text. " selected ";
				}
				$this->return_text=$this->return_text. ">".$value[$this -> array_options_table_label]."</option>";
			}
			//*/			
		}
		else {
			if(isset($this->array_options) AND !empty($this->array_options))
			{
				$this->return_text=$this->return_text. "<option value=\"\"> ".$this->option_default." </option>";
				foreach ($this->array_options as $key => $value)
				{
					$this->return_text=$this->return_text. "<option value=\"".$key."\"";
					if (isset($_POST[$this->name]) AND !empty($_POST[$this->name]))
					{
						if($_POST[$this->name] == $key)   { $this->return_text=$this->return_text. " selected ";}  else {  }
					}
					if (!empty($this->selected_value) AND ($key == $this->selected_value))
					{
						$this->return_text=$this->return_text. " selected ";
					}
					$this->return_text=$this->return_text. ">".$value."</option>";
				}
			}
		}
		
		$this->return_text=$this->return_text. "</SELECT>";
		return $this->return_text;
	}
}
?>