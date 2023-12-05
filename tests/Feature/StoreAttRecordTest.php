<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class StoreAttRecordTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; // This trait resets the database after each test

    /** @test */
    public function it_stores_attendance_with_time_in()
    {
        $controller = new AdminController();

        $request = new Request([
            'ows_id' => 1,
            'event_id' => 1,
            'in_out' => 'in',
        ]);

        $response = $controller->storeAttendance($request);

        // Add your assertions here, for example:
        $response->assertRedirect(route('admin_event_scanner', ['event_id' => 1]));
        $this->assertDatabaseHas('attendance_records', [
            'student_osasid' => 1,
            'event_id' => 1,
            'time_in' => now(),
            'time_out' => null,
        ]);
    }

}
