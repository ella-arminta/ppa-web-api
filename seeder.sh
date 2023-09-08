myArray=("Kronologis" "Alamats" "Kelurahans" "Kecamatans" "Pendidikans" "Statuses" "User" "Roles" "Laporans" "ProgressReports" "Kategoris")

for str in ${myArray[@]}; do
  php artisan make:custom $str
done