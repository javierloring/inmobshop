@echo off
Copy "inmobshop.sql" "C:\xampp\mysql\bin\inmobshop.sql"
cd C:\xampp\mysql\bin
mysql -u root -p < inmobshop.sql
exit
