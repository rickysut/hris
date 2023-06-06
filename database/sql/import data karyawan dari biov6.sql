INSERT into hris.employee (
pin,
nik,
NAME,
start_date,
end_date,
ACTIVE, 
company_id, 
branch_id, 
dept_id, 
position_id, 
subdept_id, 
shift_id,
st_departemen,
st_sub,
st_jabatan) 

SELECT 
biov6.karyawan.PIN,
biov6.karyawan.nik,
biov6.karyawan.NAMA,
biov6.karyawan.alokasiawal,
biov6.karyawan.alokasiakhir,
biov6.karyawan.ISAKTIF,1,1,1,1,1,1,
biov6.karyawan.DEPARTEMEN,
biov6.karyawan.SUB,
biov6.karyawan.Jabatan
FROM biov6.karyawan;



 