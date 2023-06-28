# Multi-Web-Projects
A curated compilation of web projects showcasing diverse functionalities and implementations. Explore interactive applications, elegant portfolios, and more. Contribute, collaborate, and stay updated.

## 1-Automated Incident Management System
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
