<?php

/**
 * The Event model represents an event entity within the CVIK Laravel application.
 * This model interacts with the application's MySQL database to manage event data.
 *
 * It supports mass assignment for fields like title, start, repeat status,
 * completion status, and an associated user ID.
 *
 * The model includes a scope to filter events based on user ID.
 *
 * @property string $title       The title of the event.
 * @property string $start       The start datetime of the event.
 * @property string $repeat      The repeat status of the event.
 * @property bool $completed   Indicates if the event is completed.
 * @property int $user_id     The ID of the user associated with the event.
 *
 * @method static \Illuminate\Database\Eloquent\Builder forUser(int $userId)
 *         Scope to filter events for a specific user by user ID.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

namespace App\Models;

use /**
 * Class represents an Eloquent model in the Laravel framework.
 *
 * The base model class provides functionalities such as querying
 * the database, relationships, attribute casting, and model events.
 *
 * Laravel Version: v11.40.0
 *
 * Application Name: CVIK
 * Database Connection: MySQL
 * Queue Connection: Database
 */
    Illuminate\Database\Eloquent\Model;
use /**
 * Trait HasFactory
 *
 * Provides factory-related functionality to Eloquent models in the CVIK Laravel application.
 * This trait allows model classes to utilize Laravel's factory capability for database seeding
 * and testing using the MySQL database connection.
 *
 * The CVIK application leverages the HasFactory trait for efficient data creation and manipulation.
 * The trait is essential in maintaining model factories for automated data generation,
 * particularly useful in testing, seeding, and queuing processes.
 *
 * Note: Application queues utilize the 'database' connection for managing jobs effectively.
 *
 * @package Illuminate\Database\Eloquent\Factories
 */
    Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Represents an Event model in the application.
 * Uses Eloquent's HasFactory trait to enable factory creation.
 * Defines the fillable attributes and a query scope for filtering by user ID.
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'repeat',
        'completed',
        'user_id',
    ];

    /**
     * Vrátí pouze události uživatele.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }



}
