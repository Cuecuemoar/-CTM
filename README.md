## CTM API usage
Note: I didn't write this in Markdown but the raw-text version is formatted pretty well

This is a REST API for creating users and updating their opt-in status. 
A user can be created by issuing a POST to /users with a payload containing first_name, last_name, email, and opt_in.
A user can be updated by issuing a PATCH to /users/{userId}

host: root of Lumen deployment
basePath: 
schemes:
  - http

paths:
  /users:
    get:
      summary: Returns a list of users.
      description: Returns JSON of all users currently registered, with their first and last names, email address, and opt-in status
      produces:
        - application/json
      responses:
        200:
            description: OK
    post:
      summary: Creates a new user
      description: Creates a new user in the database
      payload:
      {
        "first_name": "Daniel",
        "last_name": "Scott",
        "email": "test@email.com",
        "opt_in": 1
      }
      produces:
        - application/json
      responses:
        201:
            description: Created
        422: 
            description: Unprocessable request, payload is likely missing a required value
    /users/{userId}:
        patch:
            summary: Updates a user record
            description: Updates provided value(s) for user specified by userId
              produces:
                - application/json
        responses:
            200:
                description: OK
            422:
                description: Unprocessable request, returned if no value was updated
