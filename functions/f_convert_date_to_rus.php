<?php
function convert_date_rus (&$date_input) {
	$dt = $date_input; // ���������� ���������� $dt �������� ���� datetime �� ���� blogg
	$yy = substr($dt,0,4); // ���
	$mm = substr($dt,5,2); // �����
	$dd = substr($dt,8,2); // ���� 
	if ($mm == "01") $mm1="������";
	if ($mm == "02") $mm1="�������";
	if ($mm == "03") $mm1="�����";
	if ($mm == "04") $mm1="������";
	if ($mm == "05") $mm1="���";
	if ($mm == "06") $mm1="����";
	if ($mm == "07") $mm1="����";
	if ($mm == "08") $mm1="�������";
	if ($mm == "09") $mm1="��������";
	if ($mm == "10") $mm1="�������";
	if ($mm == "11") $mm1="������";
	if ($mm == "12") $mm1="�������";
	if (!empty($dd) and !empty($mm1) and !empty($yy))
	{ $ddtt = $dd." ".$mm1." ".$yy." �."; return $ddtt;} // �������� ��� ������
}
?>