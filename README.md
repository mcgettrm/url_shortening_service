# URL Shortening Service


# Important links
Git Repository: https://github.com/mcgettrm/url_shortening_service
Lucid Chart UML: https://lucid.app/lucidchart/invitations/accept/inv_64e3405f-7bcd-4445-b17b-a7b491e9b343?viewport_loc=-11%2C-11%2C2219%2C1065%2C0_0

## Constraints
### Encode
- Should generate a 6-character IDENTIFIER from an input LONG_URL.
- Should confirm that LONG_URL is a valid URL (or return status code 400).
- Identifier should be unique.
- Should return a string <CONFIG_DOMAIN_NAME>/<IDENTIFIER> to the caller.
- IDENTIFIER should be a valid HTTP URL.

### Decode
- Should accept an IDENTIFIER.
- Should validate that IDENTIFIER is 6 characters (or return status code 400).
- Should validate that IDENTIFIER is made of valid HTTP URL characters (or return status code 400).
- Should accept the IDENTIFIER with or without the CONFIG_URL
- Should return the original LONG_URL on success (or return status code 404).
- Should only accept SHORT_URL from the CONFIG_DOMAIN_NAME

# Installation Instructions
1. Copy the source code from the git repository into the desired installation folder.
2. Run:
   ``` 
   composer install
   ``` 
   (see dependencies section for more details).
3. Configure your webserver and point the web root to: 
   ```
   <YOUR BASE PATH>/public/
   ``` 

# Dependencies
The host system will need composer installed in order to facilitation installation of the software.
PHP 7.4.x

# Technical Notes
- Runs using slim framework.
- Developed using Apache.
