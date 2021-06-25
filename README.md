### Objective

Your assignment is to implement a URL shortening service using PHP and any framework.

### Brief

ShortLink is a URL shortening service where you enter a URL such as https://ampersandcommerce.com/careers/ and it returns a short URL such as http://short.est/GeAi9K.

### Tasks

-   Implement assignment using:
    -   Language: **PHP**
    -   Framework: **any framework** - we ssuggest you use something lightweight like [Slim Framework](https://www.slimframework.com/)
    -   Two endpoints are required:
        -   /encode - Encodes a URL to a shortened URL
        -   /decode - Decodes a shortened URL to its original URL.
    -   Both endpoints should return JSON
-   There is no restriction on how your encode/decode algorithm should work. You just need to make sure that a URL can be encoded to a short URL and the short URL can be decoded to the original URL. **You do not need to persist short URLs to a database. Keep them in memory.**
-   Provide detailed instructions on how to run your assignment in a separate markdown file
-   Provide API tests for both endpoints

### Evaluation Criteria

-   **PHP** best practices. 
    -   Show off about design patterns and principles as much as you can.
    -   Use of coding standards (PSR-1 / PSR-2 or PSR-12)
-   API implemented featuring a /encode and /decode endpoint
-   Tests and documentation

### Additional notes

Please organize, design, test and document your code as if it were going into production - then push your changes to the master branch. After you have pushed your code, you may submit the assignment on the assignment page.

All the best and happy coding,

The Ampersand Team