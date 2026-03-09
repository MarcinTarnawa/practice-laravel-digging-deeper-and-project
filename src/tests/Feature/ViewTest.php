<?php

namespace Tests\Feature;

use App\Models\Expenses;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Expenses $expense;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->expense = Expenses::factory()->create(['user_id' => $this->user->id]);
    }

    public function test_first_page_works(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_expenses_index_has_pagination()
    {
        //Arange
        // $user = User::factory()->create();
        Expenses::factory()->count(5)->create(['user_id' => $this->user->id]);

        //Act
        $response = $this->actingAs($this->user)->get('/expenses');
        $response->assertStatus(200);

        //Assert
        $this->assertCount(3, $response->viewData('expenses'));
        $response->assertSee('Next');
    }

    public function test_expense_requires_a_name_and_amount()
    {
        $response = $this->actingAs($this->user)->post('/expenses', []);

        $response->assertSessionHasErrors(['description', 'amount']);
    }

    public function test_amount_must_be_positive()
    {     
        $response = $this->actingAs($this->user)->post('/expenses', [
            'amount' => -10,
        ]);

        $response->assertSessionHasErrors('amount');
    }

    public function test_amount_must_be_at_least_one_cent()
    {
        $response = $this->actingAs($this->user)->post('/expenses', [
            'description' => 'test',
            'amount'      => 0, 
            'date'        => now()->format('Y-m-d'),
            'category'    => 'expenses'
        ]);

        $response->assertSessionHasErrors('amount');
    }
    public function test_user_can_delete_their_own_expense()
    {
        $this->actingAs($this->user)->delete("/expenses/{$this->expense->id}");

        $this->assertDatabaseMissing('expenses', [
            'id' => $this->expense->id
        ]);
    }

    public function test_user_cannot_delete_someone_else_expense()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $expense = Expenses::factory()->create(['user_id' => $userB->id]);
        
        $response = $this->actingAs($userA)->delete("/expenses/{$expense->id}");

        $response->assertStatus(403); 
        $this->assertDatabaseHas('expenses', ['id' => $expense->id]);
    }

    public function test_user_can_update_their_own_expense()
    {
        $updatedData = [
            'description' => 'test',
            'amount'      => 99.99,
            'date'        => '2024-02-01',
            'category'    => 'income'
        ];

        $response = $this->actingAs($this->user)
                        ->patch("/expenses/{$this->expense->id}", $updatedData);

        $response->assertRedirect('/expenses');
        
        $this->assertDatabaseHas('expenses', [
            'id'          => $this->expense->id,
            'description' => 'test',
            'amount'      => 99.99
        ]);
    }


    private function createExpense(User $user): Expenses
    {
        return Expenses::factory()->create(['user_id' => $user->id]);
    }

    private function createUser(): User
    {
        return User::factory()->create();
    }
}
