# herakles
MVC PHP Application

This is a **from scratch**, very simple PHP application in PHP5 based on the MVC pattern. This was a project in IPSSI school. The goal was to learn OO PHP and MVC pattern in a concrete application.

The App allows the admin to add clients, products, and to follow their order history , to generate PDF bills and to export data in CSV.

The front uses bootstrap 3, Jquery and HTML5. The app is responsive.

To run it in your host : 

Import herakles.sql to your database

Run the triggers (you will find them in init.php root files) in you phpMyAdmin

**Folder explanation :** 

**Init.php** runs the application. 

**Controllers** contains all the specific controllers for each things.

**Core** folder contains the router (App.php) and the main Controller (controller.php). 

**Models** contains all the models classes. 

**Views** contains the HTML5 templates.

**Library** contains the PDF library and the specific bill class

**Front** is about CSS, images and JavaScript jQuery files





