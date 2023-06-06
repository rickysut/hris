select DATE_FORMAT(tanggal, "%d/%m") AS tgl, COUNT(DISTINCT karyawan_id) AS WORK 
from `attendance` 
where `tanggal` between '2023-04-26' and '2023-05-25' 
and `in` is not null and `attendance`.`deleted_at` is NULL 
group by `tanggal`