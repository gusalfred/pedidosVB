# pedidosVB
job assignment of an app for tracking packages of an importer company.

Really old project I made a while ago (around 2018) when i was working with a small agency, made with pure "spagetti" PHP and MySQL, and some Jquery/ajax for asyncronous requests.

As far as I remeber:

- bd.txt: includes the commands for creating the main tables for the project in MySql in case the backup was lost
- pedidosvb.sql: backup of the database at the time, it mainly contains a list of countries/states and cities

To run it just copy the folder in the htdocs folder of the xampp directory and import the BD from pedidosvb.sql in phpmyadmin

main routes:
- /usersVB: user register form
- /calcVB: unit conversion for packaging
- /adminVB: CRUD of packages
- /: default access for users to track their packages
- /login: login
