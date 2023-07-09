# Multi-Web-Projects
A curated compilation of web projects showcasing diverse functionalities and implementations. Explore interactive applications, elegant portfolios, and more. Contribute, collaborate, and stay updated.

## 1-Automated Incident Management System (helpdesk)
The Automated Incident Management System is a workflow automation solution designed to streamline the management of bugs and anomalies within an organization. This system provides a convenient platform for users, technicians, and the Helpdesk Manager to collaborate effectively in resolving and tracking incidents.

*Features
User Ticket Creation: Users can create tickets to report system anomalies. By logging into the application, users can select the "Create Ticket" option and fill out a form with relevant details.

*Ticket Management: Each ticket created by the user is assigned a unique incremental number by the system and marked as a "New Ticket." On the homepage, users can view their tickets categorized by their current state, including "New Ticket," "In Progress," "Resolved," and "Closed."

*Ticket Assignment: The Helpdesk Manager is notified via email when a new ticket is created. They can assign the ticket to a technician by specifying the responsible person in the designated field. The ticket's status is then changed from "New Ticket" to "In Progress."

*Technician Workflow: Technicians are notified via email when they have a new ticket assigned to them. They can access the application, review the anomaly's description, and examine any attachments provided by the user. Technicians can proceed with resolving the problem.

*Ticket Resolution: Once a technician confirms that the anomaly is resolved, they mark the ticket as "Resolved."

*Closure by Helpdesk Manager: The Helpdesk Manager is notified of the resolution and performs a final check to ensure the problem is resolved. They then mark the ticket as "Closed." Only the Helpdesk Manager has the authority to close a ticket.

*Statistics Page: Optionally, the system can include a statistics page displaying performance indicators such as the number of tickets processed in a semester, the number of tickets by type, priority, and status.

NB: Before executing the code, please make sure to execute the file database/tables_helpdesk.sql which contains the SQL clauses to create the tables.

## 2-Assignment Quiz Generator (quiz-generator)
The Assignment Quiz Generator empowers educators and mentors by providing an efficient and effective way to assess students' programming assignments. By automating the quiz generation process and facilitating seamless communication, this package enables instructors to provide timely feedback and promote continuous learning and improvement.

The Assignment Quiz Generator streamlines the assessment workflow by automating the quiz generation process. It takes an input file, which is expected to contain a programming assignment solution written in Python, PHP, or C++. Leveraging sophisticated algorithms, the package intelligently analyzes the content of the file and extracts crucial information to create a tailored set of quiz questions.

The generated quiz is then presented to the student who submitted the assignment, offering them an opportunity to demonstrate their comprehension of the programming concepts covered in their solution. The questions are carefully crafted to evaluate various aspects such as code understanding, problem-solving skills, algorithmic thinking, and language-specific features.

Once the student completes the quiz, their answers are collected by the Assignment Quiz Generator. To ensure seamless communication, the package integrates with email functionality, allowing the quiz answers to be automatically sent to the student's advisor or instructor via email. This ensures timely feedback and enables mentors to evaluate and provide constructive suggestions for improvement.


Key Features:

*Automated quiz generation: Automatically generates a quiz based on the content of a programming assignment solution file.

*Multi-language support: Supports code written in Python, PHP, and C++.

*Tailored question set: Creates a set of questions that assess the student's understanding of the programming concepts in their assignment.

*Comprehensive assessment: Evaluates code comprehension, problem-solving skills, algorithmic thinking, and language-specific features.

*Seamless communication: Integrates with email functionality to send quiz answers to the student's advisor or instructor.

*Time-saving tool: Simplifies the assessment workflow, reducing manual effort for instructors and mentors.

NB: Before executing the code, please make sure to execute the file quiz-generator/tables_plagiarism_tester.sql which contains the SQL clauses to create the tables.
