# URL Shortening Service


# Important links
Git Repository: https://github.com/mcgettrm/url_shortening_service
Lucid Chart UML: https://lucid.app/lucidchart/invitations/accept/inv_64e3405f-7bcd-4445-b17b-a7b491e9b343?viewport_loc=-11%2C-11%2C2219%2C1065%2C0_0

## Constraints / Acceptance Criteria
### Encode
- Should generate string with a CONFIG_IDENTIFIER_LENGTH IDENTIFIER at the end.
- Should confirm that LONG_URL is a valid URL (or return status code 400).
- Identifier should be unique.
- Should return a string CONFIG_DOMAIN_NAME at the beginning to the caller.
- IDENTIFIER should be a valid HTTP URL.

### Decode
- Should accept an IDENTIFIER.
- Should validate that IDENTIFIER is 6 characters (or return status code 400).
- Should validate that IDENTIFIER is made of valid HTTP URL characters (or return status code 400).
- Should accept the IDENTIFIER with or without the CONFIG_URL
- Should return the original LONG_URL on success (or return status code 404).
- Should only accept SHORT_URL from the CONFIG_DOMAIN_NAME
- If a short URL is passed that has an incorrect CONFIG_DOMAIN_NAME, fail and return status code 400 

- A URL encoded by the Encode endpoint should be a valid input for the Decode method.

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
   
4. Navigate to classes/config.php and edit the private variable `$base_url` to suit your needs.

# Dependencies
The host system will need composer installed in order to facilitation installation of the software.
PHP 7.4.x

# Technical Notes
- Runs using slim framework.
- Developed using Apache / WAMP on Windows 10 System.

## Development Approach
- Read some framework docs
- Research problem domain (google google google to get an idea of Acceptance Criteria)
- Define classmap in LucidChart
- Get some basic JSON endpoints up and running
- Configure composer autoloader
- Implement LucidChart classmap in framework
- Document API endpoints and expected results
- Define constraints / Acceptance Criteria 
- Get PHPUnit up and running
- TDD Domain / Business layer throughout implementation of business logic according to Acceptance Criteria
- Run final tests using Postman
- Skip code review and QA (wouldn't be much of a test otherwise!)
- Search for any "TODO::" in code
- Place final copy of classmap in "misc" folder as documentation
- Review and update documentation
- Tag a release, change git remote to Ampersand repo and push

- Update and Maintain classmap and readme throughout