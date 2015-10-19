# Weather_api_php-MVC-
The respository contains Weather detail api access from worldweatheronline.com using PHP MVC and Android
Weather details using api access to © world weather online
https://developer.worldweatheronline.com/  *Generate your api here


Test Cases- Steps to do(PHP)
============================================
1)Install xampp server
2)Setup the Xampp server through - Xampp Control Panel
 -2](a)After Installation, To test & verify the installation go in your browser and type "localhost/phpmyadmin" 
     (b)If phpmyadmin loads up in your browser then the installation was successfull, if not do check if you have a port number           assigned in your xampp control panel apache server which would be 80 or 8080.
     (c)If port number assigned looks like 80 or 8080 do change your address on the browser i.e(localhost:8080/weather)
3)Create Database and Table using the steps & code mentioned in mysqlcreate.sql
2)Copy the Weather folder in your local machine's xampp/htdocs folder.
3)Now go ahead on your browser and enter "localhost/weather" in your addressbar.
4)You are good to go.

Weather details are retrieved using api key. and displayed on the browser.


Test Cases- Steps to do(Android)
============================================
1)Go ahead and open the project in android studio on package 21.
2)replace the api key in Home.java file located in package. with your own api key.
  2](a)to Generate your owm api key go to https://developer.worldweatheronline.com/   and follow steps.
3)Ui elements can be edited in activity_home.xml accordingly
4)Run project and you are good to go.

You have a App ready to show weather and weather details right on your phone.
