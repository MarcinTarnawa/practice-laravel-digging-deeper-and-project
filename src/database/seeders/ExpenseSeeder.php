<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expenses;
// use App\Models\Category; // Zakładam, że masz taki model 
use App\Models\User;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        $user = User::first() ?? User::factory()->create();
        
        // Pobierz id kategorii (upewnij się, że masz jakieś w bazie)
        // Jeśli nie masz, odkomentuj poniższe tworzenie przykładowych:
        // $categories = ['Jedzenie', 'Transport', 'Rozrywka', 'Czynsz'];
        // foreach($categories as $cat) { \App\Models\Category::firstOrCreate(['name' => $cat]); }
        
        $categoryIds = \App\Models\Category::pluck('id')->toArray();

        // Generujemy dane dla każdego miesiąca roku 2026
        for ($month = 1; $month <= 12; $month++) {
            // Losowa liczba wydatków na miesiąc (3-6)
            $expensesCount = rand(3, 6);

            for ($i = 0; $i < $expensesCount; $i++) {
                Expenses::create([
                    'user_id' => $user->id,
                    'category_id' => $categoryIds[array_rand($categoryIds)],
                    'amount' => rand(20, 500) + (rand(0, 99) / 100), // np. 150.50
                    'date' => Carbon::create(2026, $month, rand(1, 28)),
                    'description' => 'Testowy wydatek ' . $month,
                ]);
            }
        }
        
        $this->command->info('Baza została zasilona wydatkami na cały rok 2026!');
    }
}