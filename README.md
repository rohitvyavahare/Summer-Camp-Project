# Summer Camp Project

The Project:

For this assignment, you will create a web site that lets users sign their children up for programs with the fictitious Happy Days Summer Camp. The project will be split into two parts. First you will create the client side code, using html and javascript (and jQuery). For the second part, you will write the server side code which will include php for scripts and the MySQL database system. In part 2 you will also add AJAX to the project.

You should feel free to make up any additional details that may be needed.

Your project will consist of the following:

A main html landing page, index.html, with information on the camp programs and a link to enroll a child.
A signup page. This page has the following fields:
Program selected
Basketball Camp
Baseball Camp
Physical Training
Band Camp
Swimming
Nature Discovery
Parent Info:
Parent or primary guardian: First, Middle, and Last Name
Relationship to child: Father, Mother, Guardian.
Address: two lines for address, plus City, State, and Zipcode
Home phone, and Cell phone
Email address
Child Info:
First, Middle, and Last Name
Name the child goes by
Photo of child (upload an image of the child)
Gender
Date of Birth
Medical Conditions (use a textarea)
Special Dietary Requirements
Secondary emergency contact (name, and phone number)


For this assignment, you will create the server-side portion of the application, and also add AJAX. Since AJAX involves both the client and the server, you will need to change your client-side code. Your project #3 will add the following features:

AJAX to verify that the form to be submitted is not a duplicate. Since children may enroll in more than one camp, you should reject any form that would result in a duplicate record. i.e. Johnny is enrolled in Band Camp. Johnny's parent tries to enroll him in Baseball Camp and Band Camp. This form is rejected because Johnny is already enrolled in Band Camp. You should (but do not need to) report the camps that he is already enrolled in. "Johnny is already enrolled in Band Camp".
A php script that reads the parameters from the form and stores them in your MySQL database on opatija.sdsu.edu. We will discuss database design and a sample DB schema will be provided.
You must also upload and store the child's image on the server. Do not store the actual image in the MySQL database, store only the name and use a folder on the server for the image file.
A report that gives the roster of each camp session. These should be grouped by camp. The report should contain the following information:
Child's last name, first name, preferred name
The Child's image
Child's age at the time the report is generated
Parent/Guardian's last name, first name, primary phone
Emergency contact's last name, first name, primary phone
A confirmation page
