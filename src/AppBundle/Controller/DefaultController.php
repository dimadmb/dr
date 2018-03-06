<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Liuggio\ExcelBundle;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
	 * @Template()
     */
    public function indexAction()
    {
        return [];
    }
	
    /**
     * @Route("/blank", name="blank")
	 * @Template()
     */
    public function blankAction()
    {
        if ( isset($_FILES['file'])){
			$file =  $_FILES['file']['tmp_name'];
			$phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($file);
			
			$sheet = $phpExcelObject->getSheet(0);
			
			$array = [];
			
			for ($i = 2; $i <= $sheet->getHighestRow(); $i++) 
			{
				$name =   $sheet->getCellByColumnAndRow(0, $i)->getValue();
				$place =  $sheet->getCellByColumnAndRow(1, $i)->getValue();
				$dolg =   $sheet->getCellByColumnAndRow(2, $i)->getValue();
				$date =   $sheet->getCellByColumnAndRow(3, $i)->getValue();
				$age =    $sheet->getCellByColumnAndRow(4, $i)->getValue();
				
				$array[] = ['name' => $name, 'place'=>$place, 'dolg'=> $dolg, 'date'=>$date, 'age'=>$age];
			}			
			
		}
		
		
		return ['array' => $array];
    }	
	
}
