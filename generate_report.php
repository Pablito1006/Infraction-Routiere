<?php
require_once 'includes/init.php';
require_once 'includes/db.php';
require_once 'tcpdf/tcpdf.php'; // Assurez-vous d'avoir installé TCPDF

// Récupérer les données pour le rapport
function getRapportData($pdo) {
    $stmt = $pdo->query("SELECT * FROM rapports ORDER BY date_rapport DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$rapports = getRapportData($pdo);

// Créer un nouveau PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Yollo');
$pdf->SetTitle('Rapports');
$pdf->SetHeaderData('', 0, 'Rapports', 'Liste des rapports générés');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 30, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// Contenu du PDF
$html = '<h1>Liste des Rapports</h1>';
$html .= '<table border="1" cellpadding="5">';
$html .= '<tr><th>Date</th><th>Titre</th><th>Description</th></tr>';

foreach ($rapports as $rapport) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($rapport['date_rapport']) . '</td>';
    $html .= '<td>' . htmlspecialchars($rapport['titre']) . '</td>';
    $html .= '<td>' . htmlspecialchars($rapport['description']) . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');

// Sortie du PDF
$pdf->Output('rapports.pdf', 'D'); // 'D' pour télécharger le fichier
exit();
