# Anomaly Detection System
web applications anomaly detection.<br/>
run:<br/>
 docker-compose up -d<br/>
shutdown:<br/>
 docker-compose down<br/>
 
 # Alogorithm requirements
  A Proxy System that stands between the server and web sites, listens to HTTP requests.<br/>
   takes each HTTP request as a string decodes it and search for injection pattern in real-time.
   if injection found we send an email alert to the user with the injection details.
   (http request, type(xss,sqli), time, date)
   <br/>
    - the system only detects injections it don't prevent.<br/>
    - the system detects 70% of injections.<br/>
    - the system detects injection in time close to real-time of the attack.<br/>
    
 
 # UI 
 - user and admin registration
 - reports about injections
 - admin and dashboard 
 
 # DB 
   includes tables of injections 
   
 # website
 HTTPS
  
 
