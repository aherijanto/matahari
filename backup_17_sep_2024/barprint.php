<?php
		$printColOne='^XA';
		$printColOne.='^FWR';
		$printColOne.='^FO80,20';
		$printColOne.='^ADN18,10';
		$printColOne.='^FDCARDINAL CLN PJ^FS';
		$printColOne.='^FO30,50^A0,32,25^FDUTAMA^FS';
		$printColOne.='^ADN18,10';
		$printColOne.='^FO80,40';
		$printColOne.='^FDRp. 179,000^FS';
		$printColOne.='^FO80,70';
		$printColOne.='^BY1,1,8';
		$printColOne.='^BCN,50,N,N,N';
		$printColOne.='^FD103CA0001TS33^FS';
		$printColOne.='^XZ';


	copy($prinColOne, "//192.168.1.110/zebra");
?>
