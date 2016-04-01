<?php
class excel{
private $kolone=array();
private $vrednosti=array();
private $putanja;
private $i;
public function setI($i)
{
	$this->i=$i;
}
public function setPutanja($putanja)
{
	$this->putanja=$putanja;
}
public function kreirajXLS($kolone,$vrednosti)
{
	
	if (file_exists($this->putanja))
	{
		//ako fajl vec postoji obrisi ga
		@unlink($this->putanja);
	}
	
	
		$this->kolone=$kolone;
		$this->vrednosti=$vrednosti;
		$excel_aplikacija=new COM("Excel.application") or Die ("Konekcija sa Excelom nije bila uspesna!");
		$Workbook=$excel_aplikacija->Workbooks->Add();
		$Worksheet=$Workbook->Worksheets("Sheet1");
		$this->setI(0);

		foreach($kolone as $kolona)
		{
		$polje= $Worksheet->Range($this->kolone[$this->i]);
		$polje->activate;
		$polje->Value=$this->vrednosti[$this->i];
		$polje->Font->Bold = True;
		
		$this->i=$this->i+1;
		}

		$Workbook->_SaveAs($this->putanja,-4143);
		$Workbook->Save();
		$Workbook->Saved=true;
		$Workbook->Close;

		unset($Workbook);
		$excel_aplikacija->Workbooks->Close();
		$excel_aplikacija->Quit();
		unset($excel_aplikacija);
	
}
public function dodajXLS($kolone,$vrednosti)
{
	


		$this->kolone=$kolone;
		$this->vrednosti=$vrednosti;
		$excel_aplikacija=new COM("Excel.application") or Die ("Konekcija sa Excelom nije bila uspesna!");
		$Workbook=$excel_aplikacija->Workbooks->Open($this->putanja) or die("Nisam mogao da otvorim excel fajl.".$this->putanja);
		$Worksheet=$Workbook->Worksheets("Sheet1");
		$this->setI(0);
		foreach($kolone as $kolona)
		{
		$polje= $Worksheet->Range($this->kolone[$this->i]);
		$polje->activate;
		$polje->Value=$this->vrednosti[$this->i];
		
		$this->i=$this->i+1;
		}

		//$Workbook->_SaveAs("d:\\izvestaj.xls",-4143);
		$Workbook->Save();
		$Workbook->Saved=true;
		$Workbook->Close;
		unset($Worksheet);
		unset($Workbook);
		$excel_aplikacija->Workbooks->Close();
		$excel_aplikacija->Quit();
		unset($excel_aplikacija);
	
}
public function setColumnWidth($range,$width)
{
		$excel_aplikacija=new COM("Excel.application") or Die ("Konekcija sa Excelom nije bila uspesna!");
		$Workbook=$excel_aplikacija->Workbooks->Open($this->putanja) or die("Nisam mogao da otvorim excel fajl.".$this->putanja);
		$Worksheet=$Workbook->Worksheets("Sheet1");
$excel_aplikacija->ActiveSheet->Range($range)->ColumnWidth = $width;
$Workbook->Save();
		$Workbook->Saved=true;
		$Workbook->Close;
		unset($Worksheet);
		unset($Workbook);
		$excel_aplikacija->Workbooks->Close();
		$excel_aplikacija->Quit();
		unset($excel_aplikacija);
}
public function setColumnFormat($range,$format)
{
		$excel_aplikacija=new COM("Excel.application") or Die ("Konekcija sa Excelom nije bila uspesna!");
		$Workbook=$excel_aplikacija->Workbooks->Open($this->putanja) or die("Nisam mogao da otvorim excel fajl.".$this->putanja);
		$Worksheet=$Workbook->Worksheets("Sheet1");
		$Worksheet->Range($range)->NumberFormat = $format ;
		$Workbook->Save();
		$Workbook->Saved=true;
		$Workbook->Close;
		unset($Worksheet);
		unset($Workbook);
		$excel_aplikacija->Workbooks->Close();
		$excel_aplikacija->Quit();
		unset($excel_aplikacija);
}
}
//$ex1=new excel();
//$ex1->setPutanja("d:\\izvestaj.xls");
//$ex1->kreirajXLS(array("a1","b1","c1","d1"),array("ime","prezime","kurac","palac"));
//$ex1->dodajXLS(array("a2","b2","c2","d2"),array("ime","prezime","kurac","palac"));


?>