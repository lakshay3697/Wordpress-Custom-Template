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

    XAMPP Server, Wordpress installed

---------------------------------------------------------------------------------------------------------------------------
STEPS TO MAKE IT RUN LOCALLY :-
---------------------------------------------------------------------------------------------------------------------------

// Theme and Code+DB Setup

Procedure 1 :- (Via Github)

1. Go to Appearance->Themes in wordpress admin panel and install the theme 'Twenty Sixteen' by searching for it. Activate the theme once installed.

2. a) Initialize a git repo in root folder of your wordpress installation (For ex- C:/xampp/htdocs/wordpress in my case) via 'git init' 
   if it's not so and if it's so then make sure that wp-content/themes/twentysixteen/ theme is not ignored in .gitignore. 

   b) Add a new remote say named 'customform' with remote url being that of shared repo 'https://github.com/lakshay3697/Wordpress-Custom-Template.git' via 'git remote add customform https://github.com/lakshay3697/Wordpress-Custom-Template.git' 

   c) Pull changes from the remote - 'git pull customform master' (Resolve merge conflicts with functions.php file :-

   	  i) *) If wp-content/themes/twentysixteen/functions.php is untracked then simply delete it to resolve conflict and take a pull again

   	  ii) If anyhow it's tracked then checkout your local version of file to resolve conflict and take a pull again.

    )

    d) Import the 'custom-form-response.sql' either pulled via github with the changes or one shared in compressed 'Twentysixteen' theme folder in your wordpress database.

Procedure 2 :- (Via Theme Folder Upload)

1. Unzip the shared compressed 'Twentysixteen' theme folder inside 'wp-content/themes' directory of your wordpress installation and activate this 'Twenty Sixteen' theme via wordpress admin panel.

2. Import the 'custom-form-response.sql' shared in compressed 'Twentysixteen' theme folder in your wordpress database.


// Permalink settings and wordpress template creation


1. Make sure your Permalink settings in wordpress are such that the two pages/templates specified below have specified urls when these pages are created. (For ex :- Making sure that wordpress permalink settings (Settings->Permalinks) are set to 'Day and name' option works for me.)

2. Add a new page to theme via wordpress admin panel and make sure the following two things :- 
    
    a) Template is set to 'CustomForm' in Page Attributes->Template setting.
    b) Url Slug is set to 'custom-form' in Permalink setting for this page so that the page url becomes 'http://localhost/wordpress/custom-form/'

3. Add another page to theme via wordpress admin panel and make sure the following two things :- 
    
    a) Template is set to 'CustomFormRedirect' in Page Attributes->Template setting.
    b) Url Slug is set to 'custom-form-redirect' in Permalink setting for this page so that the page url becomes 'http://localhost/wordpress/custom-form-redirect/'


Now browse to localhost/wordpress/custom-form to see the custom template in action!

--------------------------------------------------------------------------------------------------------------------------------
