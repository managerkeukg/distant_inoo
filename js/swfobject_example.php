<script type="text/javascript" src="swfobject.js"></script>
<div id="player">
	Здесь можно написать что то, если вдруг не будет грузится плеер. Возможно не включен flash в браузере.
</div>
<script type="text/javascript">
	var so = new SWFObject('player.swf','mpl','320','240','8');
	so.addParam('allowfullscreen','true');
	so.addParam('flashvars','file=1.flv');
	so.write('player');
</script>