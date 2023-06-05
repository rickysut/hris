INSERT INTO hris.company (
NAME,
zipcode,
address,
phone,
fax,
link
)

SELECT 
biov6.company.Perusahaan,
biov6.company.kodearea,
biov6.company.Alamat,
biov6.company.Telpon,
biov6.company.Faksimili,
biov6.company.web
FROM biov6.company