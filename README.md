live https://simple-comment-system.000webhostapp.com/

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL
);


CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    feedback_id INT,
    user_name VARCHAR(255),
    date DATE,
    content TEXT,
    FOREIGN KEY (feedback_id) REFERENCES feedback(id)
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);


Technical Requirements:

User Authentication:

1.  Implement user authentication. (Sanctum or Passport when implementing vue.js or react.js on the frontend)

2.  Users should be able to register, log in, and log out.
Feedback Submission:

1.  Create a user-friendly form for submitting feedback.
2.  Feedback should include a title, description, and a category (e.g., bug report, feature request, improvement, etc.).

3.  Implement validation to ensure required fields are filled out.

Feedback Listing:

1. Display feedback items in a paginated list.

2.  Each feedback item should display its title, category, and the user who submitted it.

Commenting System:

1.  Enable users to leave comments on feedback items.

2.  Comments should include the user's name, date, and content.

3.  Implement basic formatting options (e.g., bold, italic, code blocks) for comments.
