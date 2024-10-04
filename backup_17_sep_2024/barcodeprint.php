<?php
(for i=1;i<=$wantPrint;i++){
	switch ($colPos){
	case 1:
		
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
		break;
	case 2:
		$printColTwo='^XA';
		$printColTwo.='^FWR';
		$printColTwo.='^FO80,20';
		$printColTwo.='^ADN18,10';
		$printColTwo.='^FDCARDINAL CLN PJ^FS';
		$printColTwo.='^FO30,50^A0,32,25^FDUTAMA^FS';
		$printColTwo.='^ADN18,10';
		$printColTwo.='^FO80,40';
		$printColTwo.='^FDRp. 179,000^FS';
		$printColTwo.='^FO80,70';
		$printColTwo.='^BY1,1,8';
		$printColTwo.='^BCN,50,N,N,N';
		$printColTwo.='^FD103CA0001TS33^FS';
		$printColTwo.='^XZ';
		break;
	}
}
?>