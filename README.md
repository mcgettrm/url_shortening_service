# URL Shortening Service
Hello Ampersand, I've really enjoyed working on your test. However, I haven't finished it! 

I've decided to submit what I have as I suspect I have spent more time now than you would have originally intended that I spend.
So, it's worth noting that the repository is not implemented (which I think is okay because your brief steered me away from
using any persistence data) and also I'd have liked to have implemented a validation class (but this really feels like a nice-to-have).

I'm attaching the Lucid Chart pdf UML that I drew up so that you have an idea of what I was trying to achieve. 

I hope you enjoy reviewing this as much as I enjoyed tinkering with it. 

# Terminology
Throughout the code comments and the documentation, several phrases are used repeatedly. For clarity, the meaning of those phrases is covered here:

**LONG URL:** This is the unencoded URL that the consumer would hope to have shortened.

**SHORT URL:** This is the resulting shortened URL after the encoding operation has taken place. It is made of the configuration
BASE URL and the IDENTIFIER.

**IDENTIFIER:** This is the part of the resulting SHORT URL that is used to identify the original LONG URL that generated it. 


# DOCUMENTATION
Please find supporting documentation in the `misc` folder for your perusal.
### API_DOCUMENTATION.md (For Service Consumers)
Contains information relevant for consumers of the API.
### REQUIREMENTS.md (For Maintenance and QA)
The original brief for this task
### URL Shortening Classmap UML.pdf (For Maintenance)
This contains the original application plan. It was modified and updated throughout development. It includes classes and methods that haven't been implemented yet. 

# Important links
Git Repository (currently private): https://github.com/mcgettrm/url_shortening_service

Lucid Chart Classmap UML (currently private): https://lucid.app/lucidchart/invitations/accept/inv_64e3405f-7bcd-4445-b17b-a7b491e9b343?viewport_loc=-11%2C-11%2C2219%2C1065%2C0_0

## Constraints / Acceptance Criteria
The acceptance criteria below have been inferred from the project breif rather than being discussed or set and are therefor subject to change.

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
5. There are two optional values that can be set in the config. `$identifierLength` determines how long the PATH of the SHORT URL
will be. `$allowDuplicateLongUrls` determines whether the resubmission of a LONG URL should return the same SHORT URL as previously or generate a new one.

# Dependencies
The host system will need composer installed in order to facilitation installation of the software.
PHP 7.4.x

# Technical Notes
Technologies and Tooling:
- Developed using Apache / WAMP on Windows 10 System.
- Git/Github version control.
- Git bash.
- PHP Storm.
- Postman.
- XDebug.
- PHPUnit.


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


## Other Considerations
- More collisions are imminent as the service grows more popular. The UrlShortenerService class will need to be updated to
ensure that duplicate identifiers are not generated too often in the future. 
- Short URLs should expire using a TTL and a server cron job/scheduled task. This would assist in the consideration above.
- Potential for user authentication. 
- Improvements to prevent overuse of the URL (e.g. limiting calls from certain IPs).
- Implementation of a redirect service for short URLs.