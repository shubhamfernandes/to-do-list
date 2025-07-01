<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase,WithFaker;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_user_can_create_a_task()
    {
        $response = $this->post('/tasks', [
            'name' => 'Buy groceries',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('tasks', ['name' => 'Buy groceries']);
    }

    public function test_user_can_delete_a_task()
    {
        $task = Task::create(['name' => 'Clean room']);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_user_can_toggle_task_completion()
    {
        $task = Task::create(['name' => 'Write test']);

        $this->patch("/tasks/{$task->id}/toggle");

    // dump($task->toArray());

        $this->assertTrue($task->fresh()->is_completed);
    }

 public function task_name_is_required_when_creating()
    {
        $response = $this->post('/tasks', [
            'name' => '', // Empty name
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('tasks', 0);
    }

    /** @test */
    public function tasks_list_page_loads_successfully()
    {
        Task::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Add'); // Checks for the Add button/form
    }

    /** @test */
    public function flash_message_is_shown_after_creating_a_task()
    {
        $response = $this->post('/tasks', [
            'name' => 'New Task',
        ]);

        $response->assertRedirect('/');
        $response = $this->get('/');

        $response->assertSee('Task added successfully');
    }

    public function test_task_name_must_not_exceed_max_length()
    {
        $response = $this->post('/tasks', [
            'name' => str_repeat('A', 256), // exceeds 255
        ]);

        $response->assertSessionHasErrors('name');
    }


        public function test_flash_message_after_deleting_task()
    {
        $task = Task::create(['name' => 'Task to delete']);

        $this->delete("/tasks/{$task->id}");
        $response = $this->get('/');

        $response->assertSee('Task deleted');
    }

    public function test_incomplete_task_does_not_have_completed_class()
    {
        Task::create(['name' => 'Plain Task', 'is_completed' => false]);

        $response = $this->get('/');
        $response->assertDontSee('class="completed"');
    }

    public function test_completed_task_has_completed_class()
    {
        Task::create(['name' => 'Finished Task', 'is_completed' => true]);

        $response = $this->get('/');
        $this->assertStringContainsString('class="text-start completed"', $response->getContent());

    }

    public function test_flash_message_is_shown_after_deleting_task()
    {
        $task = Task::create(['name' => 'Task to be deleted']);

        $this->delete("/tasks/{$task->id}");

        $response = $this->get('/');

        $response->assertSee('Task deleted');
    }

    public function test_validation_error_shown_in_ui_when_name_missing()
    {
        // Submit empty task name
        $this->post('/tasks', ['name' => '']);

        $response = $this->get('/');

        $response->assertSee('The name field is required');
    }

    public function test_user_can_create_multiple_tasks()
    {
        $tasks = ['Buy milk', 'Write code', 'Read book'];

        foreach ($tasks as $taskName) {
            $response = $this->post('/tasks', ['name' => $taskName]);
            $response->assertRedirect('/'); // or your tasks.index route
        }

        // Now check if all tasks appear on the page
        $response = $this->get('/');
        foreach ($tasks as $taskName) {
            $response->assertSeeText($taskName);
        }

        // Optional: assert they exist in the database
        foreach ($tasks as $taskName) {
            $this->assertDatabaseHas('tasks', ['name' => $taskName]);
        }
    }

    public function test_it_can_create_and_display_multiple_tasks_using_factory()
    {
        // Create 30 tasks using factory (assuming pagination is 10 per page)
        Task::factory()->count(30)->create();

        // Get first page
        $responsePage1 = $this->get('/');
        $responsePage1->assertStatus(200);
        $responsePage1->assertSeeTextInOrder(
            Task::latest()->take(10)->pluck('name')->toArray()
        );

        // Get second page
        $responsePage2 = $this->get('/?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSeeTextInOrder(
           Task::latest()->skip(10)->take(10)->pluck('name')->toArray()
        );

        // Check DB contains 30 tasks
        $this->assertDatabaseCount('tasks', 30);
    }

        public function test_it_creates_10_tasks_and_marks_3_as_completed()
    {
        // Create 7 incomplete tasks
        Task::factory()->count(7)->create(['is_completed' => false]);

        // Create 3 completed tasks
        Task::factory()->count(3)->create(['is_completed' => true]);

        // Check total count in DB
        $this->assertDatabaseCount('tasks', 10);

        // Check completed tasks in DB
        $this->assertEquals(3, Task::where('is_completed', true)->count());

        // Check response contains 3 "completed" class usages in HTML
        $response = $this->get('/');
        $response->assertStatus(200);

        // Count how many times 'class="completed"' appears in the response
        $completedClassCount = substr_count($response->getContent(), 'class="text-start completed"');

        $this->assertEquals(3, $completedClassCount);
    }

    public function test_it_creates_10_tasks_and_deletes_3_randomly()
{
    // Create 10 tasks
    $tasks = Task::factory()->count(10)->create();

    // Pick 3 random tasks to delete
    $tasksToDelete = $tasks->random(3);

    foreach ($tasksToDelete as $task) {
        $this->delete(route('tasks.destroy', $task));
    }

    // Assert 7 tasks remain in DB
    $this->assertDatabaseCount('tasks', 7);

    // Assert the deleted tasks are no longer present
    foreach ($tasksToDelete as $deletedTask) {
        $this->assertDatabaseMissing('tasks', ['id' => $deletedTask->id]);
    }
}


    public function test_it_creates_10_tasks_marks_3_complete_and_deletes_2_of_them()
{
    // Create 7 incomplete tasks
    Task::factory()->count(7)->create(['is_completed' => false]);

    // Create 3 completed tasks and store their models
    $completedTasks = Task::factory()->count(3)->create(['is_completed' => true]);

    // Delete 2 of the completed tasks
    $this->delete(route('tasks.destroy', $completedTasks[0]));
    $this->delete(route('tasks.destroy', $completedTasks[1]));

    // Assert only 8 tasks remain in DB
    $this->assertDatabaseCount('tasks', 8);

    // Assert only 1 completed task remains
    $this->assertEquals(1, Task::where('is_completed', true)->count());

    // Optional: confirm deleted records are no longer present
    $this->assertDatabaseMissing('tasks', ['id' => $completedTasks[0]->id]);
    $this->assertDatabaseMissing('tasks', ['id' => $completedTasks[1]->id]);
}

public function test_task_name_is_escaped_to_prevent_xss()
{
    $maliciousInput = "<script>alert('XSS')</script>";

    // Create task with XSS input
    $this->post(route('tasks.store'), [
        'name' => $maliciousInput
    ]);

    // Fetch the rendered page
    $response = $this->get('/');

    // Ensure raw script tag is not in the output
    $response->assertDontSee($maliciousInput, false);

    // Ensure escaped version is displayed
    $escaped = e($maliciousInput);
    $response->assertSee($escaped, false);
}





}
