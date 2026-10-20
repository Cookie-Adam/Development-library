<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Client;
use App\Models\Computer;
use App\Models\ComputerSession;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::factory(15)->create();
        $staff = Staff::factory(4)->create();
        $books = Book::factory(30)->create();

        // PC-01 .. PC-08
        $computers = collect(range(1, 8))->map(fn ($i) => Computer::create([
            'name' => sprintf('PC-%02d', $i),
            'status' => 'available',
        ]));

        // Borrowings: 20 returned, 10 still active (each from a distinct book)
        foreach ($books->random(10) as $book) {
            Borrowing::factory()->create([
                'client_id' => $clients->random()->id,
                'book_id' => $book->id,
                'staff_id' => $staff->random()->id,
            ]);
            $book->decrement('available_copies'); // keep stock consistent
        }

        Borrowing::factory(20)->returned()->create([
            'client_id' => fn () => $clients->random()->id,
            'book_id' => fn () => $books->random()->id,
            'staff_id' => fn () => $staff->random()->id,
        ]);

        // Finished sessions on random computers
        ComputerSession::factory(15)->create([
            'client_id' => fn () => $clients->random()->id,
            'computer_id' => fn () => $computers->random()->id,
            'staff_id' => fn () => $staff->random()->id,
        ]);

        // Active sessions on 3 distinct computers, which are marked in use
        foreach ($computers->random(3) as $computer) {
            ComputerSession::factory()->active()->create([
                'client_id' => $clients->random()->id,
                'computer_id' => $computer->id,
                'staff_id' => $staff->random()->id,
            ]);
            $computer->update(['status' => 'in_use']);
        }

        // One machine under maintenance
        $computers->first(fn ($c) => $c->fresh()->status === 'available')?->update(['status' => 'maintenance']);
    }
}
