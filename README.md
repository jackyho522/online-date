# Year 3 project

This project aims to develop an online dating system with some security measures. Users are allowed to register and login the system. They can view other users’ profile and send private message to other users. Pfsense firewall is implemented to prevent attacks, such as DDOS and bots etc. 

PS: the message cannot be sent instantly. 
It is fully upgraded in the next project (by learning how to use web socket)

Security functions:
1. Cookies
2. htaccess security(all traffic from http will be redirected to 404 page). Users are only allowed to access from HTTPS.
3. Bcrypt password
4. CSRF token

Library used:
ramsey/uuid: 4.2
hackzilla/password-generator: 1.6
gilbitron/easycsrf: 1.5


