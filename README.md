# Wordpress Custom Form Template 

Wordpress custom form template to acquire basic user details followed by OTP verification via email.

----------------------------------------------------------------------------------------------------------------------
TECHNOLOGIES USED :-
-----------------------------------------------------------------------------------------------------------------------

FRONTEND :- HTML, CSS, Javascript, Bootstrap
BACKEND  :- PHP, MySQL

---------------------------------------------------------------------------------------------------------------------
SOFTWARE/ TOOLS USED :-
----------------------------------------------------------------------------------------------------------------------

Text Editor - Visual Studio code
Browser - Google Chrome
Version Control - Github
Database file :- custom-form-response.sql

------------------------------------------------------------------------------------------------------------------------
LOCAL ENVIRONMENT SETUP :-
-------------------------------------------------------------------------------------------------------------------------

To run this application on your local environment follow the below steps :-

-------------------------------------------------------------------------------------------------------------------------
PREREQUISITES :-
--------------------------------------------------------------------------------------------------------------------------

Be sure you have the following installed on your development machine:

    XAMPP Server, Wordpress installed in C:/xampp/wordpress

---------------------------------------------------------------------------------------------------------------------------
STEPS TO MAKE IT RUN LOCALLY :-
---------------------------------------------------------------------------------------------------------------------------

1. Go to Appearance->Themes in wordpress admin panel and install the theme 'Twenty Sixteen' by searching for it. Activate the theme once installed.

2. a) Inittialize a git repo in root folder of your wordpress installation (For ex- C:/xampp/wordpress in my case) via 'git init'

   b) Add a new origin say named 'customform' with remote url being that of shared repo 'https://github.com/lakshay3697/Wordpress-Custom-Template.git' via 'git remote add customform https://github.com/lakshay3697/Wordpress-Custom-Template.git'

   c) Pull changes from the remote - git pull customform master

3. Add a new page to theme via wordpress admin panel and make sure the following two things :- 
    
    a) Template is set to 'CustomForm' in Page Attributes->Template setting.
    b) Url Slug is set to 'custom-form' in Permalink setting.

4. Add another page to theme via wordpress admin panel and make sure the following two things :- 
    
    a) Template is set to 'CustomFormRedirect' in Page Attributes->Template setting.
    b) Url Slug is set to 'custom-form-redirect' in Permalink setting.

5. Import 'custom-form-response.sql' in wordpress database.

Now browse to localhost/wordpress/custom-form to see the custom template in action!

--------------------------------------------------------------------------------------------------------------------------------
