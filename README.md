# LightReader
A WebApp to bookmark only the useful content of pages on several websites of news.

Developped to be able to read articles on my old smartphone which dies from the terabyte of crap surrounding the few kilobyte of text which really interest me on nowadays news website.

How to use it:

1) Download this repo, unzip it.
2) Configure your databse connection information in PHP/WebBuilderDBConf.php .
3) Configure your email and the url you'll upload LightReader in PHP/WebBuilderConf.php .
4) Upload LightReader on your server.
5) Ensure the permission to write on the file Load/page.html is set.
6) Access your.server.net/LightReader/index.php?setupdb=1 to setup the database
7) Add an account in the WBLogin table (cf my repo WebBuilder).
8) Access your.server.net/LightReader/index.php and login.
9) Bookmark link by copy pasting the url in the top input box and clicking the 'plus' icon.
10) Select the link to read using the select box, delete the current link by clicking on the 'minus' icon.
11) Set the filters using the table editor at the bottom. 'Filter' is the keyword to match the url and the filter. 'DivTgt' is the argument given to the load() jquery function to extract only the essential content from the bookmarked url. 'UrlSrc' is a prefix added to relative path of images if necessary.
