<?php
session_start();
require '../../recursos/fpdf/fpdf.php';
require '../../config/conexion.php';

$pdf = new FPDF('L', 'mm', 'letter');
$pdf->AddPage();



class pdf extends FPDF
{


        
    function Header(){

        //$this->Cell(210, 6, utf8_decode('Soporte Prestación Servicio de Transporte'), 1, '', 'C', true);
        $this->Image('../../intranet/uploads/header.png', 0,0, 280, 190, 'PNG');
        $this->Image('../../intranet/uploads/footer.png', 0,26, 280, 190, 'PNG');
        
        //Borde de hace constar
        $this->Image('../../intranet/uploads/bordeHace.png', 101,42, 78, 7, 'PNG');
        
        require '../../config/conexion.php';
        
        $buscar = $_GET['id_certificado'];
        
        $consulta = "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
        INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA
        WHERE ID_CER=:id_cer";
        
        $registro=$conexion->prepare($consulta);

        $registro->execute(array(":id_cer"=>$buscar));
        
        
        while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){    
        
        //Datos firma docente
        $this->SetY(198);
        $this->Ln();
        $this->AddFont('RobotoCondensed-Bold');
        $this->SetFont('RobotoCondensed-Bold', '', 12);
        $this->SetTextColor('31','77', '131');
        $this->SetFillColor('31','77','131');
        $this->Cell(75,1,'',0, '', 'C', true);
        $this->Ln();
        $this->Cell(110,5,utf8_decode(ucwords(strtolower($fila['NOM_INST'])).' '.ucwords(strtolower($fila['APE_INST']))),0, '');
        
        $this->Ln();
        $this->AddFont('RobotoCondensed-Light');
        $this->SetFont('RobotoCondensed-Light', '', 8);
        $this->Cell(75,3,utf8_decode(ucwords(strtolower($fila['PROFESION']))),0, '');
        $this->Ln();
        $this->Cell(75,3,utf8_decode(ucwords(strtolower($fila['MATRICULA']))),0, '');
        $this->Ln();
        $this->Cell(75,3,utf8_decode(ucwords(strtolower($fila['ESPECIALIDAD']))),0, '');
        }
    }// CIEERRE DEL HEADER
    
    function Footer() {
        
        require '../../config/conexion.php';
        
        $buscar = $_GET['id_certificado'];
        
        $consulta = "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
        INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA
        WHERE ID_CER=:id_cer";
        
        $registro=$conexion->prepare($consulta);

        $registro->execute(array(":id_cer"=>$buscar));
        
        
        while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){    
        // Firma Docente   
        $this->Image('../../intranet/uploads/'.utf8_decode($fila['FIRMA']) , 10,185, 60, 20, 'PNG');

        
        // texdo del lado de la firma docente 
        $this->SetY(188);
        $this->Setx(145);
        $this->AddFont('RobotoCondensed-Light');
        $this->SetFont('RobotoCondensed-Light', '', 10);
        $this->SetTextColor('255','255', '255');
        $this->Cell(128,4,utf8_decode('Verifique la auntenticidad de este certificado digitando el número de certificado'),0, '', 'C', false);
        $this->Ln();
        $this->Setx(150);
        $this->Cell(10,4,utf8_decode('el'),0, '', 'R', false);
        $this->SetTextColor('253','195', '0'); 
        $this->Cell(38,4,utf8_decode(strtolower($fila['WEB'])),0, '', 'L', false);
        $this->SetTextColor('255','255', '255');
        $this->Cell(60,4,utf8_decode('para evitar fraudes y dar confiabilidad al trabajo de'),0, '', 'R', false);
        $this->Ln();
        $this->Setx(145);
        $this->Cell(65,4,utf8_decode('los intructores. Mayor información:'),0, '', 'R', false);
        $this->SetTextColor('253','195', '0'); 
        $this->Cell(60,4,utf8_decode($fila['TEL_UNO'].'-'.$fila['TEL_DOS']),0, '', 'L', false);
        
        }// cIERRE DEL WHILE
    }// CIERRE DEL FOOTER
    
}

$pdf = new pdf('L', 'mm', 'letter');
$buscar = $_GET['id_certificado'];
$pdf->AddPage();

$consulta = "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
FROM certificado_curso 
INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA
WHERE ID_CER=:id_cer";  

$registro=$conexion->prepare($consulta);

$registro->execute(array(":id_cer"=>$buscar));

while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){

  
$pdf->SetFillColor(217,219,217); 
$pdf->Image('../../intranet/uploads/'.utf8_decode($fila['LOGO']) , 83,4, 105, 45, 'PNG');
$pdf->AddFont('RobotoCondensed-Bold');
$pdf->SetFont('RobotoCondensed-Bold', '', 13);
$pdf->SetY(46); 
//$pdf->SetX(115);
//$pdf->Image('../../intranet/uploads/bordeHace.png', 10,100, 100, 30, 'PNG');
$pdf->SetTextColor('255','255', '255');
$pdf->Cell(0, 0, utf8_decode('HACE CONSTAR QUÉ'), 0, '', 'C', false);

$pdf->AddFont('amazon');
$pdf->SetFont('amazon', '', 50);
$pdf->SetTextColor('31','77', '131');
$pdf->SetY(60);    
$pdf->Cell(0, 0, utf8_decode(ucwords(strtolower($fila['NOM_EST'])).' '.ucwords(strtolower($fila['APE_EST']))), 0, '', 'C', false);

$pdf->SetFont('RobotoCondensed-Bold', '', 13);
$pdf->SetTextColor('77','77', '77');
$pdf->SetY(75); 
$pdf->Cell(0, 6, utf8_decode('Identificado con Cédula de Ciudadanía número:'.' '. number_format($fila['DOCUMENTO'],0,'','.')), 0, '0', 'C', false);

$pdf->Ln();
$pdf->SetFont('RobotoCondensed-Bold', '', 13);
$pdf->Cell(0, 6, utf8_decode('Cursó, demostró y aprobó la formación en:'), 0, '', 'C', false);

$pdf->SetY(95); 
$pdf->SetFont('RobotoCondensed-Bold', '', 25);
$pdf->SetTextColor('31','77', '131');
$pdf->Cell(0, 0, utf8_decode(strtoupper($fila['NOMBRE_CURSO'])), 0, '', 'C', false);

$pdf->SetY(105); 
$pdf->SetFont('RobotoCondensed-Bold', '', 18);
$pdf->SetTextColor('253','195', '0');
$pdf->Cell(0, 0, 'Intensidad Horaria:'.' '. utf8_decode($fila['HORAS']).' '.'HORAS', 0, '', 'C', false);

$f_aprobacion = date_create($fila['F_APROBACION']);

$f_vencimieto = date_create($fila['F_VENCIMIENTO']);

$pdf->SetFont('RobotoCondensed-Bold', '', 12);
$pdf->SetTextColor('77','77', '77');
$pdf->SetY(115); 
$pdf->Cell(0, 6, utf8_decode('La presente certificación electrónica tiene validez jurídica y legal en Colombia conforme a la ley 597 de 1999 y el Decreto reglamentario'), 0, '0', 'C', false);
$pdf->Ln();
$pdf->Cell(0, 6, utf8_decode('1747 del 2000. En testimonio de lo anterior se firma digitalmente el presente en Barrancabermeja el '. date_format($f_aprobacion, 'd/m/y').'.'), 0, '0', 'C', false);
//printf("[%010s]\n",   $s);
$pdf->SetY(145);
$pdf->SetX(15);
$pdf->SetFont('RobotoCondensed-Bold', '', 16);
$pdf->SetTextColor('31','77', '131');
$pdf->Cell(50,6, utf8_decode('N° CERTIFICADO'), 0, '', 'R');
$pdf->SetTextColor('253','195', '0');
$pdf->Cell(40,6, utf8_decode('SLCAP'.$fila['SIGLA'].sprintf("%1$04d",$fila['CODIGO'])),0,'','C');

$pdf->SetTextColor('31','77', '131');
$pdf->Cell(50,6, utf8_decode('FECHA APROBACIÓN:'), 0, '', 'C');
$pdf->SetTextColor('253','195', '0');        
$pdf->Cell(26,6, utf8_decode(date_format($f_aprobacion, 'd/m/y')), 0, '', 'C');
$pdf->SetTextColor('31','77', '131');
$pdf->Cell(50,6, utf8_decode('FECHA VENCIMIENTO:'), 0, '', 'C');
$pdf->SetTextColor('253','195', '0'); 
$pdf->Cell(26,6, utf8_decode(date_format($f_vencimieto, 'd/m/y')), 0, '', 'C');


}

$pdf->Output('I', 'Certificado.pdf');