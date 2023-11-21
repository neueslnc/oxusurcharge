<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        \App\Models\Criteria::create(['name' => "Professor-o'qituvchining dars jarayonidagi mas'uliyati", "percent" => 5, "increase" => "positive", "rules" => [
             "rules" => [
                 "checkbox" => [
                     "included" => true,
                     "limit" => 1
                    ]
                ]
            ]
        ]);
        \App\Models\Criteria::create(['name' => "AKT dan foydalanish darajasi va sifati (%)", "percent" => 5, "increase" => "positive", "rules" => [
            "rules" => [
                "checkbox" => [
                    "included" => true,
                    "limit" => 1
                   ]
               ]
           ]
       ]);

       \App\Models\Criteria::create(['name' => "Hemis axborot tizimi yurutilmasligi", "percent" => 5, "increase" => "negative", "rules" => [
        "rules" => [
            "checkbox" => [
                "included" => true,
                "limit" => 1
               ]
           ]
       ]
   ]);

   \App\Models\Criteria::create(['name' => "Fanga doir tuzilgan testlar sifati", "percent" => 5, "increase" => "positive", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);
\App\Models\Criteria::create(['name' => "Professor o'qituvchining darsga kechikib kirishi yoki vaqtli tark etishi", "percent" => 5, "increase" => "negative", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);

// \App\Models\Criteria::create(['name' => "Ochiq dars", "percent" => 5, "increase" => "positive", "rules" => [
//     "rules" => [
//         "checkbox" => [
//             "included" => true,
//             "limit" => 1
//            ]
//        ]
//    ]
// ]);
\App\Models\Criteria::create(['name' =>  " Ochiq dars , Sayyor dars , Tadbirlar  ", "percent" => 5, "increase" => "positive", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "all_checkbox" => false,
            "limit" => 3
           ]
       ]
   ]
]);

// \App\Models\Criteria::create(['name' => "Tadbirlar ", "percent" => 5, "increase" => "positive", "rules" => [
//     "rules" => [
//         "checkbox" => [
//             "included" => true,
//             "limit" => 1
//            ]
//        ]
//    ]
// ]);




\App\Models\Criteria::create(['name' => "Dars mashg'ulotini asossiz olib borilmaganligi (Sriv)", "percent" => 5, "increase" => "negative", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);

\App\Models\Criteria::create(['name' => "Maqola, monografiya, o‘quv qo'llanma, darsliklar  ", "percent" => 5, "increase" => "positive", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);

\App\Models\Criteria::create(['name' => "So'rovnoma natijalari 90 % dan past bo'lganligi", "percent" => 5, "increase" => "negative", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);


\App\Models\Criteria::create(['name' => "Xorijiy OTMlarda qo'llaniladigan zamonaviy dars o'tish metodlaridan foydalanib OXU da joriy etish va ijtimoiy tarmoqlarga joylashtirish  ", "percent" => 5, "increase" => "positive", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);


\App\Models\Criteria::create(['name' => "Yakuniy nazorat natijalari (65% dan past)", "percent" => 5, "increase" => "negative", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);

\App\Models\Criteria::create(['name' => "Mahorat darslarini tashkil etish ", "percent" => 5, "increase" => "positive", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);


\App\Models\Criteria::create(['name' => "Test savollari sifati pastligi", "percent" => 5, "increase" => "negative", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);



\App\Models\Criteria::create(['name' => "OXU masofaviy o'quv platformasi uchun sifatli kontent tayyorlash ", "percent" => 5, "increase" => "positive", "rules" => [
    "rules" => [
        "checkbox" => [
            "included" => true,
            "limit" => 1
           ]
       ]
   ]
]);


// \App\Models\Criteria::create(['name' => "Rektor Ustamasi ", "percent" => 5, "increase" => "positive", "rules" => [
//     "rules" => [
//         "checkbox" => [
//             "included" => true,
//             "limit" => 1
//            ]
//        ]
//    ]
// ]);
    }
}
