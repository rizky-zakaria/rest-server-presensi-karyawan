<?php
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Daftar Produk');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$i = 0;
$html = '<h3>Laporan Penyewaan Yang Di Batalkan</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                        <tr bgcolor="#ffffff">
                            <th width="5%" align="center">No</th>
                            <th width="20%" align="center">Nama</th>
                            <th width="25%" align="center">Barang</th>
                            <th width="15%" align="center">Tanggal Sewa</th>
                            <th width="20%" align="center">Homor HP</th>
                            <th width="15%" align="center">Alasan</th>
                        </tr>';
foreach ($data as $row) {
    $i++;
    $html .= '<tr bgcolor="#ffffff">
                            <td align="center">' . $i . '</td>
                            <td>' . $row['nama'] . '</td>
                            <td>' . $row['nama_barang'] . '</td>
                            <td>' . $row['tgl_sewa'] . '</td>
                            <td>' . $row['no_hp'] . '</td>
                            <td>' . $row['keterangan'] . '</td>
                        </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('laporan_penyewaan.pdf', 'I');
