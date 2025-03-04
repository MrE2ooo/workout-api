<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        h2 {
            margin-top: 30px;
        }
        h3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Workout API Documentation</h1>
        

        <!-- User Routes Section -->
        <h2>User Routes</h2>

        <h3>Authentication Routes</h3>

        <h4>Register a New User</h4>
        <p><strong>Endpoint:</strong> <code>POST /api/register</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code></p>
        <p><strong>Request Body:</strong></p>
        <pre>
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
        </pre>
        <p><strong>Response:</strong></p>
        <pre>
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "is_admin": false,
        "created_at": "2023-10-10T12:00:00.000000Z",
        "updated_at": "2023-10-10T12:00:00.000000Z"
    },
    "token": "1|randomTokenString"
}
        </pre>

        <h4>Log in a User</h4>
        <p><strong>Endpoint:</strong> <code>POST /api/login</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code></p>
        <p><strong>Request Body:</strong></p>
        <pre>
{
    "email": "john@example.com",
    "password": "password123"
}
        </pre>
        <p><strong>Response:</strong></p>
        <pre>
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "is_admin": false,
        "created_at": "2023-10-10T12:00:00.000000Z",
        "updated_at": "2023-10-10T12:00:00.000000Z"
    },
    "token": "1|randomTokenString"
}
        </pre>

        <h4>Log out a User</h4>
        <p><strong>Endpoint:</strong> <code>POST /api/logout</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;token&gt;</code></p>
        <p><strong>Request Body:</strong> None</p>
        <p><strong>Response:</strong></p>
        <pre>
{
    "message": "Logged out successfully"
}
        </pre>

        <h3>Workout Routes</h3>

        <h4>Get All Workouts (Authenticated User Only)</h4>
        <p><strong>Endpoint:</strong> <code>GET /api/workouts</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
[
    {
        "id": 1,
        "name": "Leg Day",
        "user_id": 1,
        "created_at": "2023-10-10T12:00:00.000000Z",
        "updated_at": "2023-10-10T12:00:00.000000Z",
        "exercises": [
            {
                "id": 1,
                "name": "Squats",
                "weight": "100kg",
                "reps": "10",
                "sets": "3",
                "is_completed": false,
                "workout_id": 1,
                "created_at": "2023-10-10T12:00:00.000000Z",
                "updated_at": "2023-10-10T12:00:00.000000Z"
            },
            {
                "id": 2,
                "name": "Lunges",
                "weight": "50kg",
                "reps": "12",
                "sets": "3",
                "is_completed": false,
                "workout_id": 1,
                "created_at": "2023-10-10T12:00:00.000000Z",
                "updated_at": "2023-10-10T12:00:00.000000Z"
            }
        ]
    }
]
        </pre>

        <h4>Get a Single Workout</h4>
        <p><strong>Endpoint:</strong> <code>GET /api/workouts/{workout_id}</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
{
    "id": 1,
    "name": "Leg Day",
    "user_id": 1,
    "created_at": "2023-10-10T12:00:00.000000Z",
    "updated_at": "2023-10-10T12:00:00.000000Z",
    "exercises": [
        {
            "id": 1,
            "name": "Squats",
            "weight": "100kg",
            "reps": "10",
            "sets": "3",
            "is_completed": false,
            "workout_id": 1,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "Lunges",
            "weight": "50kg",
            "reps": "12",
            "sets": "3",
            "is_completed": false,
            "workout_id": 1,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        }
    ]
}
        </pre>

        <h4>Create a New Workout</h4>
        <p><strong>Endpoint:</strong> <code>POST /api/workouts</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;token&gt;</code></p>
        <p><strong>Request Body:</strong></p>
        <pre>
{
    "name": "Arm Day",
    "exercises": [
        {
            "name": "Bicep Curls",
            "weight": "20kg",
            "reps": "12",
            "sets": "3"
        },
        {
            "name": "Tricep Extensions",
            "weight": "15kg",
            "reps": "10",
            "sets": "3"
        }
    ]
}
        </pre>
        <p><strong>Response:</strong></p>
        <pre>
{
    "id": 2,
    "name": "Arm Day",
    "user_id": 1,
    "created_at": "2023-10-10T12:00:00.000000Z",
    "updated_at": "2023-10-10T12:00:00.000000Z",
    "exercises": [
        {
            "id": 3,
            "name": "Bicep Curls",
            "weight": "20kg",
            "reps": "12",
            "sets": "3",
            "is_completed": false,
            "workout_id": 2,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        },
        {
            "id": 4,
            "name": "Tricep Extensions",
            "weight": "15kg",
            "reps": "10",
            "sets": "3",
            "is_completed": false,
            "workout_id": 2,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        }
    ]
}
        </pre>

        <h4>Update a Workout</h4>
        <p><strong>Endpoint:</strong> <code>PUT /api/workouts/{workout_id}</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;token&gt;</code></p>
        <p><strong>Request Body:</strong></p>
        <pre>
{
    "name": "Updated Leg Day"
}
        </pre>
        <p><strong>Response:</strong></p>
        <pre>
{
    "id": 1,
    "name": "Updated Leg Day",
    "user_id": 1,
    "created_at": "2023-10-10T12:00:00.000000Z",
    "updated_at": "2023-10-10T12:00:00.000000Z",
    "exercises": [
        {
            "id": 1,
            "name": "Squats",
            "weight": "100kg",
            "reps": "10",
            "sets": "3",
            "is_completed": false,
            "workout_id": 1,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "Lunges",
            "weight": "50kg",
            "reps": "12",
            "sets": "3",
            "is_completed": false,
            "workout_id": 1,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        }
    ]
}
        </pre>

        <h4>Delete a Workout</h4>
        <p><strong>Endpoint:</strong> <code>DELETE /api/workouts/{workout_id}</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
{
    "message": "the workout was deleted"
}
        </pre>

        <!-- Admin Routes Section -->
        <h2>Admin Routes</h2>

        <h3>Admin User Management</h3>

        <h4>Get All Users (Admin Only)</h4>
        <p><strong>Endpoint:</strong> <code>GET /api/admin/users</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;admin_token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "is_admin": false,
        "created_at": "2023-10-10T12:00:00.000000Z",
        "updated_at": "2023-10-10T12:00:00.000000Z"
    },
    {
        "id": 2,
        "name": "Admin User",
        "email": "admin@example.com",
        "is_admin": true,
        "created_at": "2023-10-10T12:00:00.000000Z",
        "updated_at": "2023-10-10T12:00:00.000000Z"
    }
]
        </pre>

        <h4>Get a Single User (Admin Only)</h4>
        <p><strong>Endpoint:</strong> <code>GET /api/admin/users/{user_id}</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;admin_token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "is_admin": false,
    "created_at": "2023-10-10T12:00:00.000000Z",
    "updated_at": "2023-10-10T12:00:00.000000Z"
}
        </pre>

        <h4>Delete a User (Admin Only)</h4>
        <p><strong>Endpoint:</strong> <code>DELETE /api/admin/users/{user_id}</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;admin_token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
{
    "message": "User deleted successfully"
}
        </pre>

        <h3>Admin Workout Management</h3>

        <h4>Get All Workouts for a Specific User (Admin Only)</h4>
        <p><strong>Endpoint:</strong> <code>GET /api/admin/users/{user_id}/workouts</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;admin_token&gt;</code></p>
        <p><strong>Response:</strong></p>
        <pre>
[
    {
        "id": 1,
        "name": "Leg Day",
        "user_id": 1,
        "created_at": "2023-10-10T12:00:00.000000Z",
        "updated_at": "2023-10-10T12:00:00.000000Z",
        "exercises": [
            {
                "id": 1,
                "name": "Squats",
                "weight": "100kg",
                "reps": "10",
                "sets": "3",
                "is_completed": false,
                "workout_id": 1,
                "created_at": "2023-10-10T12:00:00.000000Z",
                "updated_at": "2023-10-10T12:00:00.000000Z"
            },
            {
                "id": 2,
                "name": "Lunges",
                "weight": "50kg",
                "reps": "12",
                "sets": "3",
                "is_completed": false,
                "workout_id": 1,
                "created_at": "2023-10-10T12:00:00.000000Z",
                "updated_at": "2023-10-10T12:00:00.000000Z"
            }
        ]
    }
]
        </pre>

        <h4>Create a Workout for a Specific User (Admin Only)</h4>
        <p><strong>Endpoint:</strong> <code>POST /api/admin/users/{user_id}/workouts</code></p>
        <p><strong>Headers:</strong> <code>Content-Type: application/json</code>, <code>Authorization: Bearer &lt;admin_token&gt;</code></p>
        <p><strong>Request Body:</strong></p>
        <pre>
{
    "name": "Arm Day",
    "exercises": [
        {
            "name": "Bicep Curls",
            "weight": "20kg",
            "reps": "12",
            "sets": "3"
        },
        {
            "name": "Tricep Extensions",
            "weight": "15kg",
            "reps": "10",
            "sets": "3"
        }
    ]
}
        </pre>
        <p><strong>Response:</strong></p>
        <pre>
{
    "id": 2,
    "name": "Arm Day",
    "user_id": 1,
    "created_at": "2023-10-10T12:00:00.000000Z",
    "updated_at": "2023-10-10T12:00:00.000000Z",
    "exercises": [
        {
            "id": 3,
            "name": "Bicep Curls",
            "weight": "20kg",
            "reps": "12",
            "sets": "3",
            "is_completed": false,
            "workout_id": 2,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        },
        {
            "id": 4,
            "name": "Tricep Extensions",
            "weight": "15kg",
            "reps": "10",
            "sets": "3",
            "is_completed": false,
            "workout_id": 2,
            "created_at": "2023-10-10T12:00:00.000000Z",
            "updated_at": "2023-10-10T12:00:00.000000Z"
        }
    ]
}
        </pre>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>