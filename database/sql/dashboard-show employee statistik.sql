SELECT DATE_FORMAT(tanggal, "%d/%m/%Y") AS tgl, COUNT(DISTINCT karyawan_id) AS work 
FROM attendance WHERE tanggal >= DATE_FORMAT(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), "%Y-%m-26") 
AND tanggal <= DATE_FORMAT(LAST_DAY(DATE_SUB(NOW(), INTERVAL 1 MONTH)), "%Y-%m-25") 
AND `in` IS NOT null 
attendance
group by `tanggal`