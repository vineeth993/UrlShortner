1. Pull the code to homedirectory of the server

2. Go through the file config.php for changing paramenters of mysql.

3. Import the mysql file

4. Enable rewrite engine of apache by executing the command sudo a2enmod rewrite.

5. Add the line         
	<Directory /var/www/website>
        Options Indexes FollowSymLinks MultiViews
    	AllowOverride All
        Require all granted
    </Directory>
   with indentation in the file 000-default.conf  located at /etc/apache/sites-enabled
 
