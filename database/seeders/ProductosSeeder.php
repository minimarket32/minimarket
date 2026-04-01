<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        $productos = [

            [1,'Arroz Roa',2000,10,2,'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTTFyM9YRURT3abNa6lQADx7jjGwLe9juz4OuMzhQMM_iPMBdQB7tY__kKTIpdWxd7s5v5nok4VQGEqV_g3pKoqh9Ud6R5m-CJc8yWYbz2XCQtMrTh4nV9j'],

            [2,'Arroz Diana',2100,25,2,'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSwPMUK1mnWe0W8vCgfF3AxLgJpmqPE3nQKPnK8em7oVIU9Er_0krc9qozNMqtYj9MaWXj1J_ezEiXxzETuMyv6jyWvy7uW'],

            [3,'Frijol Diana',9200,68,2,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSOWclRo5cSqsmH22E6JxEdlzfiAcPxlBJPz5hXFGaGnN-gystmmu0BZxBC7lnYULt2J4922f7nLykMtKk_kmjkQUcTQq0LS6f0A3YabT6jUx1rySF--Wnc8g'],

            [4,'Jabon Carey',15000,11,2,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSXpeERQwAnQ7ZLQOlFoAAiWK2zBX_bOSnCqtbLTeSjc35kLHjXfcgGHYalcZtCG4Iz8fI0xcFE77969iDQKKntKXKOIdExHjOHyChqYqms1vwA8-2JSr1K'],

            [5,'Lentejas Diana',3200,68,2,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTK1iB2hDlzGmzdAnmEh7wp584CvlA7VKssLgpUbjYXPDMYR9jLVrurvdjqsPNxvY4ajrV5ROGO2lkfakuC6w1u1vhNKPAq-tViml_fgieYVkOuVFFgQl92AQ'],

            [6,'Jabon rey',3400,30,1,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTjNhJp-leFpiQ_xE-mo_Q4q2UFP4vEFKO5T-EDii7LlWYFxGEJWdptAJw-NPK6xJ5pIsmUsrpVkG0R9hClDDmg1yCIm7jK'],

            [7,'Colgate',4700,12,1,'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcQi_9BnpsG2a-RHiLg10avboHSt_mkGO8j5dLbwDcA5eaC9Yxi2CCFXoMK7Y3oPkuOu2lUs8hSX2hiWxi3qVZOSPr3efd-g_0BSg8XKWy5HuL6pLdkinqBN'],

            [8,'Suavitel',13000,11,1,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcRAs0LrkMK4eNZDmQSKgz_6GjPMkT0GEa7OFMbeSQGx8HONt4SPREqX_U0qPMus3xVxoHn2aETOw04BXsQ3LWMbgk7OCtvfvx6K-A9dL2E0PuCKfCgZpAGchw'],

            [9,'Jabón Protex',13000,11,1,'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTwpyAWjUhSwcWccd78Djt9_nvZvOuoQ0iqehXdxckDcZ8Nkajj7pUrJljmcGPEV4o6xog9AKA_oyD6dGYGuZ7ffPxcgtkv'],

            [10,'Detergente Fab',13000,37,1,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQ0L9WZN__c38TAMSSkYImKWrPZZsA4NJLLRFLcryKAaA7SmxSQueHiK1N5zJYaz-WiDpcLOvkwzMRVEzl1HvPb0UcX63nmodhsc3dUznds'],

            [11,'Lavaloza King',2700,24,1,'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcSiC7NzOv9B5WOxNMXcHwmvMquLL7Cf9lf86eE07Dyzt2hHv-82UabjX9zttCCI603nHDPQDVSj2hdxingi4NcJl7W6WONkcNuHK5SDDy6w3k0Vm844nmIn'],

            [12,'Pavo en Carne Molida',15000,20,6,'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcT4blSi_EggVypu_uZMS0VHxbtN-ICe1Au4djEwbgLv7nN9LAfVtXAbJA1OwhdJs0SmEBdwKId5owWnUsto5ENfzEHjaBIZP1pMRWlT6vNox0Bxd1M45aSx8g'],

            [13,'Lomo',37000,35,6,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcR4bgLyq4zHvwzxfvvnrfzyZo8aKY4sSeAKLj-fxoDcpHKM-PExCyKnOFBD5Z0Zp623yv2_sliTKbns3mgEduLENkcSYHaqYaKprplIXSql'],

            [14,'Chuleta Cerdo',15000,7,6,'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTfgGFS6Y5UFf2mrJ_1r4J_khc3hUi6k0Zz8Hl5CTZEwZPEfemD9CG3ajuRavM775viAU-Dvd7wlD7OxahPSbAmL848tJUCa519s5YAvv0'],

            [15,'Carne Res',21000,72,6,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTu2gFvrnfdSY51AkKSZTYd766Z4yrDC45AMu81O7Iu6nHSSDe5OKNhiAJPGqk7oN1OJugPDmbjIk3c76wRVqZ39LKqnyMuOtqn4JYSggepm2TlKNDNcsSARg'],

            [16,'Pechuga de Pollo',9000,20,6,'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQNB7eM1Gc1NpvRganRNJv1kgSML6wiKRVfWePSoEZtLYupjoPv7sQaVmdg9EIzkYvt8Qu8rJvfGTSk3MfdsBZgfTO-VmDr4aWlXftxHkGPgdCq5yxMsgSB'],

            [17,'Quesito Colanta',5500,94,5,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQW4D-9aChWyt2BnWNea1QNVzanptbMJO9C0clMq0MXYi9aXyqA62BEvqF3gJjX9iCXR0tPD3XH2fyWl5y_hDQsjfqAmzjJ6wwFDkNx6s0XV6_rXJIbkea8yw'],

            [18,'Leche Alquería Grande',6500,100,5,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSCHimtzlxt_Bp6W5abXidDivA0wYLWBzh_hTc4V2vLOWAHvstfQAIju_yg3fIw8R6fP-L4PW-AbPgme57d2Mmrqdx_KUkq39lyIortEVPfAh5ygCFWr1MI'],

            [19,'Quesito Colanta Campesino',7800,91,5,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSRu6wgo-ZPdVH0o8HjpCmQjMtTbqjveJmm4J8p-1D1I2Rw0FqKAXARMQ2JZlrDn1h6OqNk0CwEtEjPPlF8jM1JeR0RSgaP5GncYy38gJM9CUno0U9ad50T'],

            [20,'Leche Colanta',4000,15,5,'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSWhWWF17cquufIl3Zx3OnOMGN6YJIX_Kzl1LyKaqY9B7CqF0thJzho8esBWYBRZ5_USqcGG744ZhsVRIpL1bB5FvqFQ95cF7QKNunOzZUna5gApyDkbMUDCA'],

            [21,'Pony Malta 1.5',6000,57,4,'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRRSQMyHN-KkWanRAo0p-HfALRT4DGhJhqWH1us6fXY04p-Pm4WN31q38kV7tPwBY2xt4NA52gvKAOgjKpj8iRVscg'],

            [22,'Postobón Manzana',7800,7,4,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTJwkV0IeFzHZE9l-W0mtQ6MzYQTLL2sc8leqQBAX69P9y-2IJYEjz1LMp-DDT6rBmeJCOn49rxr9ro_9fIkFct-PC2dfl5aRazROHrWQddAIxmeblIpiyvGg'],

            [23,'Manzana mini',2500,30,4,'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSw_VCXEAKJs3cPTXaw_mHhPIOuYTk--NA4TYwmprKpvqJgoZREGRKyVffM1zgAwExVUw4xpUHjojbezRRdC9KD4x0z0nH-QTt8C0cOciZN3XAgMWpA2yB6LNg'],

            [24,'Coca Cola',6000,13,4,'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQf798R3yK7ICO4z3yBuO8D2tATr6Z5QeE1TuafiWbMfUizyjwmgxorxIjq34waXiL1KSzI1fwZR5DiYyy5HxvRT5Kd3v0QiR5Zyd3kumrgEWYha5CK-0Y0'],

            [25,'Frutiño',1000,29,4,'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcStBNnzfmkqBMMCfEuKWwHFbrrp-qSFqasWj2gOKUj64fDf7z0w81N_ARvkVPA4tm8Fco3ehWX-ka1naX1enNefkMGbtdJFn23Od8cwwDaRQY-cR5gWCWJO']

        ];

        foreach ($productos as $p) {

            Producto::updateOrCreate(
                ['id'=>$p[0]],
                [
                    'nombre'=>$p[1],
                    'descripcion'=>'Producto de alta calidad',
                    'precio'=>$p[2],
                    'stock'=>$p[3],
                    'categoria_id'=>$p[4],
                    'imagen'=>$p[5]
                ]
            );
        }
    }
}