

<?php
session_start();
require('fpdf.php');
//connessione al database inserendo come parametri
//l'indirizzo del server, l'utente e la password del DBMS
$db = new mysqli('localhost','root','', 'googlemaps')
or die ("Non riesco a creare la connessione");
//selezione database supermercato
//mysql_select_db("articoli") or die ("Non trovo il DB");
//Creo nuovo file pdf
$pdf = new FPDF();
//Disabilito fine pagina automatico
$pdf->SetAutoPageBreak(false);
//Aggiunta prima pagina
$pdf->AddPage();
//Determino la posizione iniziale della prima riga come coordinata y
$y_inizio = 50;
//Determino l'altezza delle righe in pixel
$h = 6;
//$pdf->Image('logo_babe1e92d5f6fb5977abdfe18f2d91fd.png',26);
//Stampa dei titoli delle colonne. Colore riempimento
$pdf->SetFillColor(0,162,231);
//Settaggio del font
$pdf->SetFont('Arial','B',12);
//posizione dall'alto in pixel
$pdf->SetY($y_inizio);
//Posizione dal margine sinistro in pixel
$pdf->SetX(25);
//Inserisco titoli nelle celle della prima riga
//parametri (larghezza,altezza,titolo,direzione,bordo,allineamento,sfondo)
$pdf->Cell(50,6,'Nome',1,0,'L',1);
$pdf->Cell(50,6,'Latitudine',1,0,'L',1);
$pdf->Cell(50,6,'Longitudine',1,0,'L',1);

$y=$y_inizio;
$pdf->SetFillColor(232,232,232);
//ci spostiamo in basso di una riga
$y = $y + $h;
//creazione stringa di SQL
$email = $_SESSION['email'];
$result=$db->query("SELECT * FROM markers WHERE EmaiUtente = '$email'"); 
//Contatore righe
$i = 0;
//Massimo righe per pagina
$max = 25;
$tmp=0;
//ciclo di lettura dalla resutl query
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
{
   //Se la riga attuale è l'ultima effettuo salto pagina
   //E creo la nuova pagina stampando di nuovo le intestazioni della colonne
   if ($i == $max)
   {
      $pdf->AddPage();
      //Posiziono riga a coordinata y iniziale
      $pdf->SetY($y_inizio);
      //Stampa riga intestazione
      $pdf->SetX(25);
      $pdf->Cell(50,6,'Nome',1,0,'L',1);
      $pdf->Cell(50,6,'Latitudine',1,0,'L',1);
      $pdf->Cell(50,6,'Longitudine',1,0,'L',1);
      
      //Vado a riga successiva
      $y = $y + $h;
      //Inizializzo contatore a zero (prima riga)
      $i = 0;
   }
   //Salvataggio campi letti dal database
   $nome = $row['titolo'];
   $latitudine = $row['Latitudine'];
   $longitudine = $row['Longitudine'];
   //Settaggio riga a nuova riga
   $pdf->SetY($y);
   //Settaggio colonna
   $pdf->SetX(25);
   
   if ($i % 2 == 0)
      $pdf->setFillColor(255,255,255); 
   else
      $pdf->setFillColor(214,214,214); 
   //Stampa riga con i campi letti dal database
   $pdf->Cell(50,6,$nome,1,0,'L',1);
   $pdf->Cell(50,6,$latitudine,1,0,'L',1);
   $pdf->Cell(50,6,$longitudine,1,0,'L',1);
  
   //Vado a riga successiva
   $y = $y + $h;
   //Incremento contatore di righe
   $i = $i + 1;
}
//Chiudo conessione

mysqli_close($db);

//Invio file pdf al client
$pdf->Output();
?>
